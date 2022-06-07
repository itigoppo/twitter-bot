<?php

declare(strict_types=1);

namespace TwitterBot\Command;

use Cake\Console\Arguments;
use Cake\Command\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Core\Configure;
use Cake\Database\Expression\QueryExpression;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\I18n\FrozenTime;
use Cake\ORM\Query;
use Cake\Utility\Hash;
use Cake\Utility\Text;
use DateTimeZone;
use Itigoppo\TwitterApi\Connector\Connector;
use Itigoppo\TwitterApi\Twitter\Twitter;
use TwitterBot\Model\Enum\PostType;

/**
 * TwitterBotGodo command.
 */
class TwitterBotGodoCommand extends Command
{
    /** @var \TwitterBot\Model\Table\TwitterBotGodoSayingsTable $TwitterBotGodoSayings */
    public $TwitterBotGodoSayings;

    /** @var \TwitterBot\Model\Table\TwitterBotGodoBirthdaysTable $TwitterBotGodoBirthdays */
    public $TwitterBotGodoBirthdays;

    /** @var \TwitterBot\Model\Table\TwitterBotGodoRepliesTable $TwitterBotGodoReplies */
    public $TwitterBotGodoReplies;

    /** @var \TwitterBot\Model\Table\TwitterBotReplyContinuousTable $TwitterBotReplyContinuous */
    public $TwitterBotReplyContinuous;

    /** @var \TwitterBot\Model\Table\TwitterBotRestrictionsTable $TwitterBotRestrictions */
    public $TwitterBotRestrictions;

    /** @var Twitter $twitter */
    public $twitter;

    /** @var \Cake\Chronos\ChronosInterface|FrozenTime */
    private $today;

    /** @var string */
    private $myScreenName = '11510_';

    /**
     * Initialize method
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('TwitterBotGodoSayings');
        $this->loadModel('TwitterBotGodoBirthdays');
        $this->loadModel('TwitterBotGodoReplies');
        $this->loadModel('TwitterBotReplyContinuous');
        $this->loadModel('TwitterBotRestrictions');

        $configs = Configure::read('Twitter.godo');
        $this->twitter = new Twitter(
            new Connector(
                $configs['consumerKey'],
                $configs['consumerSecret'],
                $configs['token'],
                $configs['tokenSecret']
            )
        );

        $this->today = FrozenTime::now();
    }

    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/3.0/en/console-and-shells/commands.html#defining-arguments-and-options
     *
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);

        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return null|void|int The exit code or null for success
     * @throws \Exception
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        // リプライ保存
        $this->saveReplies();

        $isMidnight = ($this->today->format('Hi') >= '0230' && $this->today->format('Hi') < '0515') ? true : false;

        // 平日の2:30〜5：15は停止
        if (!$this->today->isWeekend() && $isMidnight) {
            return;
        }

        $sayings = [];

        // 誕生日のお祝い
        $sayings = array_merge($sayings, $this->setBirthdaySayings());

        // リプライ
        $sayings = array_merge($sayings, $this->setReplySayings());

        // 時間イベント
        if (empty($sayings)) {
            $timeSaying = $this->setTimeSaying($this->today);
            if (!empty($timeSaying)) {
                $sayings = array_merge(
                    $sayings,
                    [
                        [
                            'text' => $timeSaying->text,
                        ],
                    ]
                );
            }
        }

        // TLに反応ただし土日の深夜は除く
        if (empty($sayings) && (!$this->today->isWeekend() || ($this->today->isWeekend() && !$isMidnight))) {
            $sayings = $this->setTimelineMatchSayings();
        }

        // ランダム発言
        if (empty($sayings)) {
            $saying = $this->setSaying($this->today);
            $sayings = array_merge(
                $sayings,
                [
                    [
                        'text' => $saying->text,
                    ],
                ]
            );
        }

        foreach ($sayings as $saying) {
            $options = [];
            // 反応したリプライのフラグ更新
            if (!empty($saying['reply_id'])) {
                /** @var \TwitterBot\Model\Entity\TwitterBotGodoReply $reply */
                $reply = $this->TwitterBotGodoReplies->get($saying['reply_id']);
                $reply = $this->TwitterBotGodoReplies->patchEntity(
                    $reply,
                    [
                        'is_reply' => true,
                    ]
                );
                if (!$this->TwitterBotGodoReplies->save($reply)) {
                    $this->log('リプライ済みフラグの更新に失敗しました');
                }
            }

            // botへの反応を記録
            if (!empty($saying['is_bot'])) {
                /** @var \TwitterBot\Model\Entity\TwitterBotReplyContinuous $replyContinuous */
                $replyContinuous = $this->TwitterBotReplyContinuous->find()->where(
                    [
                        $this->TwitterBotReplyContinuous->aliasField('screen_name') => $this->myScreenName,
                        $this->TwitterBotReplyContinuous->aliasField('target_screen_name') => $saying['screen_name'],
                    ]
                )->first();

                if (empty($replyContinuous)) {
                    $data = [
                        'count' => 1,
                        'screen_name' => $this->myScreenName,
                        'target_screen_name' => $saying['screen_name'],
                    ];
                    $replyContinuous = $this->TwitterBotReplyContinuous->patchEntity(
                        $this->TwitterBotReplyContinuous->newEntity($data),
                        $data
                    );
                } else {
                    $replyContinuous = $this->TwitterBotReplyContinuous->patchEntity(
                        $replyContinuous,
                        [
                            'count' => $replyContinuous->modified->isToday() ? $replyContinuous->count + 1 : 1,
                        ]
                    );
                }
                if (!$this->TwitterBotReplyContinuous->save($replyContinuous)) {
                    $this->log('botの会話カウント更新できませんでした');
                }
            }

            if (!empty($saying['in_reply_to_status_id'])) {
                $options['in_reply_to_status_id'] = $saying['in_reply_to_status_id'];
            }

            if (!empty($saying['text'])) {
                try {
                    $this->twitter->statuses->update(
                        $saying['text'],
                        $options
                    );
                } catch (\Exception $e) {
                    $this->log($e->getMessage());
                }
            }
        }
    }

    /**
     * リプライを保存する
     *
     * @return void
     * @throws \Exception
     */
    private function saveReplies(): void
    {
        /** @var \TwitterBot\Model\Entity\TwitterBotGodoReply $lastReply */
        $lastReply = $this->TwitterBotGodoReplies->find()->order(
            [
                $this->TwitterBotGodoReplies->aliasField('posted') => 'DESC',
            ]
        )->first();

        // 旧バージョンのときに受け取ってたラストのリプライID
        $since = '1200410487550119937';
        if (!empty($lastReply)) {
            $since = $lastReply->status_id;
        }

        $mentions = $this->twitter->timelines->mentions(
            [
                'trim_user' => false,
                'contributor_details' => false,
                'include_entities' => false,
                'since_id' => $since,
            ]
        );

        foreach ($mentions as $mention) {
            $check = $this->TwitterBotGodoReplies->find()->where(
                [
                    $this->TwitterBotGodoReplies->aliasField('status_id') => $mention->id_str
                ]
            )->count();
            if ($check !== 0) {
                continue;
            }

            $reply = $this->TwitterBotGodoReplies->newEntity([]);
            $reply->id = Text::uuid();
            $reply->status_id = $mention->id_str;
            $reply->text = $mention->text;
            $reply->user_id = $mention->user->id_str;
            $reply->screen_name = $mention->user->screen_name;
            $reply->name = $mention->user->name;
            $reply->posted = FrozenTime::createFromFormat('D F d H:i:s P Y', $mention->created_at)->setTimezone(
                new DateTimeZone('Asia/Tokyo')
            );
            $this->TwitterBotGodoReplies->saveOrFail($reply);
        }
    }

    /**
     *  誕生日用の発言リストから1つセット
     *
     * @param FrozenTime $day
     * @return null|\Cake\Datasource\EntityInterface|\TwitterBot\Model\Entity\TwitterBotGodoSaying
     */
    private function setBirthdaySaying(FrozenTime $day)
    {
        return $this->TwitterBotGodoSayings->find()->where(
            [
                $this->TwitterBotGodoSayings->aliasField('post_type') => PostType::BIRTHDAY,
                $this->TwitterBotGodoSayings->aliasField('is_available') => true,
            ]
        )
            ->order('rand()')
            ->first();
    }

    /**
     * 誕生日のお祝い
     *
     * @return array
     */
    private function setBirthdaySayings(): array
    {
        $sayings = [];
        if ($this->today->format('Hi') === '0000') {
            $birthdays = $this->getBirthdays($this->today);
            if (!$birthdays->isEmpty()) {
                foreach ($birthdays as $birthday) {
                    $birthdaySaying = $this->setBirthdaySaying($this->today);
                    $sayings[] = [
                        'text' => $this->formatSaying($birthdaySaying->text, $birthday->screen_name, $birthday->name),
                    ];
                }
            }
        }

        return $sayings;
    }

    /**
     *  返信用の発言リストから1つセット
     *
     * @param null|string $regexp
     * @return array|\Cake\Datasource\EntityInterface|\TwitterBot\Model\Entity\TwitterBotGodoSaying
     */
    private function setReplySaying($regexp = null): EntityInterface
    {
        $query = $this->TwitterBotGodoSayings->find()->where(
            [
                $this->TwitterBotGodoSayings->aliasField('post_type') => PostType::REPLY,
                $this->TwitterBotGodoSayings->aliasField('is_available') => true,
            ]
        );

        if (empty($regexp)) {
            $query->andWhere(
                function (QueryExpression $exp, Query $q) {
                    return $exp->isNull($this->TwitterBotGodoSayings->aliasField('regexp'));
                }
            );
        } else {
            $query->andWhere(
                [
                    $this->TwitterBotGodoSayings->aliasField('regexp') => $regexp,
                ]
            );
        }

        return $query->order('rand()')->first();
    }

    /**
     *  時間イベントの発言リストから1つセット
     *
     * @param FrozenTime $day
     * @return null|\Cake\Datasource\EntityInterface|\TwitterBot\Model\Entity\TwitterBotGodoSaying
     */
    private function setTimeSaying(FrozenTime $day)
    {
        return $this->TwitterBotGodoSayings->find()->where(
            [
                $this->TwitterBotGodoSayings->aliasField('post_type') => PostType::TIME,
                $this->TwitterBotGodoSayings->aliasField('event_time') => $day->format('H:i:00'),
                $this->TwitterBotGodoSayings->aliasField('is_available') => true,
            ]
        )
            ->order('rand()')
            ->first();
    }

    /**
     * リプライに反応
     *
     * @return array
     */
    private function setReplySayings(): array
    {
        $sayings = [];

        // 今日のコーヒー数
        $countCoffees = $this->countTodayCoffees($this->today);

        // 未返信のリプライ
        $notReplies = $this->getNotReplies();

        // 正規表現リスト
        $replayRegexps = $this->getReplayRegexps();

        // botのIDリスト
        $restrictions = $this->getRestrictions();

        foreach ($notReplies as $reply) {
            $isSaying = false;
            foreach ($replayRegexps as $regexp) {
                if (preg_match('/' . $regexp . '/', $reply->text)) {
                    $todayCount = null;
                    if ($regexp === '(っ|つ).*(珈琲|コーヒー|こーひー)') {
                        $countCoffees++;
                    }
                    $replySaying = $this->setReplySaying($regexp);
                    $sayings[] = [
                        'reply_id' => $reply->id,
                        'reply' => $reply->text,
                        'text' => $this->formatSaying(
                            $replySaying->text,
                            $reply->screen_name,
                            $reply->name,
                            $countCoffees
                        ),
                        'in_reply_to_status_id' => $reply->status_id,
                    ];
                    $isSaying = true;
                }
            }

            // 文言にヒットしなかったらランダム返信
            if (!$isSaying) {
                $isSkip = false;
                $isBot = false;
                // 対bot連続規制
                if (in_array($reply->screen_name, $restrictions) || preg_match("/bot$|\_bot/i", $reply->screen_name)) {
                    $isSkip = !$this->canReply($this->myScreenName, $reply->screen_name, $this->today);
                    $isBot = true;
                }
                // 挨拶は基本返しだから無視
                if (preg_match('/おやすみ|オヤスミ|おやす|おはよう|おは|オハヨウ|ただいま|タダイマ/', $reply->text)) {
                    $isSkip = true;
                }

                // 挨拶返しまとめてくることあるからそれも無視
                $multiple = preg_match_all('/@/', $reply->text, $matches);
                if (preg_match('/あり|ありがとう/', $reply->text) && $multiple !== 0) {
                    $isSkip = true;
                }

                if ($isSkip) {
                    // 無視してもフラグ更新したいので返却はする/対botでも別にスルーで良い
                    $sayings[] = [
                        'reply_id' => $reply->id,
                        'reply' => $reply->text,
                    ];
                } else {
                    $replySaying = $this->setReplySaying();
                    $sayings[] = [
                        'reply_id' => $reply->id,
                        'reply' => $reply->text,
                        'text' => $this->formatSaying($replySaying->text, $reply->screen_name, $reply->name),
                        'in_reply_to_status_id' => $reply->status_id,
                        'is_bot' => $isBot,
                        'screen_name' => $reply->screen_name,
                    ];
                }
            }
        }

        return $sayings;
    }

    /**
     *  TL反応用の発言リストから1つセット
     *
     * @param null|string $regexp
     * @return array|\Cake\Datasource\EntityInterface|\TwitterBot\Model\Entity\TwitterBotGodoSaying
     */
    private function setTimelineMatchSaying($regexp = null): EntityInterface
    {
        $query = $this->TwitterBotGodoSayings->find()->where(
            [
                $this->TwitterBotGodoSayings->aliasField('post_type') => PostType::MATCH,
                $this->TwitterBotGodoSayings->aliasField('is_available') => true,
            ]
        );

        if (empty($regexp)) {
            $query->andWhere(
                function (QueryExpression $exp, Query $q) {
                    return $exp->isNull($this->TwitterBotGodoSayings->aliasField('regexp'));
                }
            );
        } else {
            $query->andWhere(
                [
                    $this->TwitterBotGodoSayings->aliasField('regexp') => $regexp,
                ]
            );
        }

        return $query->order('rand()')->first();
    }

    /**
     * TLに反応
     *
     * @return array
     * @throws \Exception
     */
    private function setTimelineMatchSayings()
    {
        $sayings = [];

        // 昨日のリプライ王
        $lover = $this->getLover($this->today);

        // 正規表現リスト
        $matchRegexps = $this->getMatchRegexps();

        // 正規表現の愛人置き換え
        $vars = [
            'LOVE_ID' => $lover['screen_name'],
            'LOVE_NAME' => $lover['name'],
        ];

        foreach ($matchRegexps as $key => $regexp) {
            $matchRegexps[$key] = Text::insert($regexp, $vars, ['before' => '%', 'after' => '%']);
        }

        $timelines = $this->twitter->timelines->home(
            [
                'exclude_replies' => true,
            ]
        );

        foreach ($timelines as $timeline) {
            // RTは無視
            if (!empty($timeline->retweeted_status)) {
                continue;
            }
            // 本人は無視
            if ($timeline->user->screen_name === $this->myScreenName) {
                continue;
            }

            foreach ($matchRegexps as $regexp) {
                if (preg_match('/' . $regexp . '/', $timeline->text)) {
                    $saying = $this->setTimelineMatchSaying($regexp);
                    $sayings[] = [
                        'reply' => $timeline->text,
                        'text' => $this->formatSaying(
                            $saying->text,
                            $timeline->user->screen_name,
                            $timeline->user->name
                        ),
                        'in_reply_to_status_id' => $timeline->id,
                    ];
                }
            }
        }

        return $sayings;
    }

    /**
     *  ランダム発言
     *
     * @param FrozenTime $day
     * @return array|\Cake\Datasource\EntityInterface|\TwitterBot\Model\Entity\TwitterBotGodoSaying
     */
    private function setSaying($day): EntityInterface
    {
        $targets = [];
        $cursor = -1;
        do {
            try {
                $followers = $this->twitter->followers->lists(
                    [
                        'skip_status' => true,
                        'include_user_entities' => false,
                        'cursor' => $cursor,
                    ]
                );
            } catch (\Exception $e) {
                $this->log($e->getMessage());
                break;
            }

            $cursor = $followers->next_cursor;

            $targets = array_merge($targets, $followers->users);
        } while ($cursor !== 0);

        $target = null;
        if (count($targets) > 0) {
            $target = $targets[rand(0, (count($targets) - 1))];
        }

        $query = $this->TwitterBotGodoSayings->find()->where(
            function (QueryExpression $exp, Query $q) use ($day) {
                return $exp->or(
                    [
                        $exp->and(
                            [
                                $this->TwitterBotGodoSayings->aliasField('post_type') => PostType::DAY,
                                $this->TwitterBotGodoSayings->aliasField('event_day') => $day->format('2020-m-d'),
                                $this->TwitterBotGodoSayings->aliasField('is_available') => true,
                            ]
                        ),
                        $exp->and(
                            [
                                $this->TwitterBotGodoSayings->aliasField('post_type') => PostType::NORMAL,
                                $this->TwitterBotGodoSayings->aliasField('is_available') => true,
                            ]
                        ),
                    ]
                );
            }
        );

        return $query->order('rand()')
            ->map(
                function ($row) use ($target) {
                    $row->text = $this->formatSaying(
                        $row->text,
                        empty($target) ? '' : $target->screen_name,
                        empty($target) ? '' : $target->name
                    );
                    return $row;
                }
            )->first();
    }

    /**
     * 文字置き換え
     *
     * @param string $text
     * @param string $screenName
     * @param string $name
     * @param int $count
     * @return string
     */
    private function formatSaying($text, $screenName, $name, $count = null): string
    {
        $vars = [
            'ID' => $screenName,
            'NAME' => $name,
            'COUNT' => $count,
        ];

        return Text::insert($text, $vars, ['before' => '%', 'after' => '%']);
    }

    /**
     * 今日もらったコーヒー数
     *
     * @param FrozenTime $day
     * @return int
     */
    private function countTodayCoffees(FrozenTime $day)
    {
        /** @var \TwitterBot\Model\Entity\TwitterBotGodoReply[] $replies */
        $replies = $this->TwitterBotGodoReplies->find()->where(
            function (QueryExpression $exp) use ($day) {
                return $exp->between(
                    $this->TwitterBotGodoReplies->aliasField('posted'),
                    $day->startOfDay(),
                    $day->endOfDay()
                );
            }
        )->andWhere(
            [
                $this->TwitterBotGodoReplies->aliasField('is_reply') => false,
            ]
        )->all();

        $count = 0;
        foreach ($replies as $reply) {
            if (preg_match('/(っ|つ).*(珈琲|コーヒー|こーひー)/', $reply->text)) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * 昨日のリプライ数トップ
     *
     * @param FrozenTime $day
     * @return array
     */
    private function getLover(FrozenTime $day)
    {
        $query = $this->TwitterBotGodoReplies->find();
        /** @var \TwitterBot\Model\Entity\TwitterBotGodoReply $reply */
        $reply = $query->select(
            [
                'count' => $query->func()->count('*'),
                $this->TwitterBotGodoReplies->aliasField('user_id'),
            ]
        )->where(
            function (QueryExpression $exp) use ($day) {
                return $exp->between(
                    $this->TwitterBotGodoReplies->aliasField('posted'),
                    $day->subDay()->startOfDay(),
                    $day->subDay()->endOfDay()
                );
            }
        )->group(
            [
                $this->TwitterBotGodoReplies->aliasField('user_id'),
            ]
        )->order(
            [
                'count' => 'DESC'
            ]
        )->first();

        if (!empty($reply)) {
            try {
                $user = $this->twitter->users->show((int)$reply->user_id, '');
                return [
                    'screen_name' => $user->screen_name,
                    'name' => $user->name,
                ];
            } catch (\Exception $e) {
                \Cake\Log\Log::error($e->getMessage());
            }
        }

        // memo: 相手先垢消えてる、、、ｗ
        return [
            'screen_name' => '_naruhodou_bot',
            'name' => 'まるほどう',
        ];
    }

    /**
     *  誕生日リスト取得
     *
     * @param FrozenTime $day
     * @return \Cake\Datasource\ResultSetInterface|\TwitterBot\Model\Entity\TwitterBotGodoBirthday[]
     */
    private function getBirthdays(FrozenTime $day)
    {
        return $this->TwitterBotGodoBirthdays->find()->where(
            [
                $this->TwitterBotGodoBirthdays->aliasField('birthday') => $day->format('2020-m-d'),
            ]
        )
            ->all();
    }

    /**
     *  botリスト
     *
     * @return array
     */
    private function getRestrictions(): array
    {
        $restrictions = $this->TwitterBotRestrictions->find()->toList();

        return array_values(array_unique(Hash::extract($restrictions, '{n}.screen_name')));
    }

    /**
     *  返信用の正規表現リストを取得
     *
     * @return array
     */
    private function getReplayRegexps(): array
    {
        $replayRegexps = $this->TwitterBotGodoSayings->find()->where(
            [
                $this->TwitterBotGodoSayings->aliasField('post_type') => PostType::REPLY,
                $this->TwitterBotGodoSayings->aliasField('is_available') => true,
            ]
        )->andWhere(
            function (QueryExpression $exp, Query $q) {
                return $exp->isNotNull($this->TwitterBotGodoSayings->aliasField('regexp'));
            }
        )
            ->toList();

        return array_values(array_unique(Hash::extract($replayRegexps, '{n}.regexp')));
    }

    /**
     *  未返信のリプライリスト
     *
     * @return \Cake\Datasource\ResultSetInterface|\TwitterBot\Model\Entity\TwitterBotGodoReply[]
     */
    private function getNotReplies(): ResultSetInterface
    {
        return $this->TwitterBotGodoReplies->find()->where(
            [
                $this->TwitterBotGodoReplies->aliasField('is_reply') => false,
            ]
        )
            ->order(
                [
                    $this->TwitterBotGodoReplies->aliasField('posted') => 'ASC',
                ]
            )
            ->limit(5)
            ->all();
    }

    /**
     *  リプライ可能か(bot同士で続けさせないようにするあれ
     *
     * @param string $screenName
     * @param string $targetScreenName
     * @param FrozenTime $day
     * @return bool
     */
    private function canReply($screenName, $targetScreenName, FrozenTime $day)
    {
        /** @var \TwitterBot\Model\Entity\TwitterBotReplyContinuous $replyContinuous */
        $replyContinuous = $this->TwitterBotReplyContinuous->find()->where(
            [
                $this->TwitterBotReplyContinuous->aliasField('screen_name') => $screenName,
                $this->TwitterBotReplyContinuous->aliasField('target_screen_name') => $targetScreenName,
            ]
        )
            ->first();

        if (empty($replyContinuous)) {
            return true;
        }

        // 最後に返してから1時間以上たってるなら返していい
        if ($day->diffInHours($replyContinuous->modified) < 1) {
            return true;
        }

        // 3回までは許す
        return ($replyContinuous->count <= 3);
    }

    /**
     *  TLツッコミの正規表現リストを取得
     *
     * @return array
     */
    private function getMatchRegexps(): array
    {
        $replayRegexps = $this->TwitterBotGodoSayings->find()->where(
            [
                $this->TwitterBotGodoSayings->aliasField('post_type') => PostType::MATCH,
                $this->TwitterBotGodoSayings->aliasField('is_available') => true,
            ]
        )->andWhere(
            function (QueryExpression $exp, Query $q) {
                return $exp->isNotNull($this->TwitterBotGodoSayings->aliasField('regexp'));
            }
        )
            ->toList();

        return array_values(array_unique(Hash::extract($replayRegexps, '{n}.regexp')));
    }
}
