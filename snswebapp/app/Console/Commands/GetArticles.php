<?php

namespace App\Console\Commands;

use App\Models\Roles;
use App\Models\Articles;
use App\Libs\Status;
use App\Services\UsersService;
use App\Services\ArticlesService;
use App\Services\LabelsService;
use App\Services\ArticleLabelsService;
use Illuminate\Console\Command;

class GetArticles extends Command
{
    private $usersService;
    private $articlesService;
    private $labelsService;
    private $articleLabelsService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:get-articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $apis = <<<__JSON__
[
    {
        "lang": "ja",
        "module": "GNews",
        "weight": 2,
        "force_update": false
    }
]
__JSON__;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        UsersService $usersService,
        ArticlesService $articlesService,
        LabelsService $labelsService,
        ArticleLabelsService $articleLabelsService
    ) {
        parent::__construct();
        $this->usersService = $usersService;
        $this->articlesService = $articlesService;
        $this->labelsService = $labelsService;
        $this->articleLabelsService = $articleLabelsService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info(get_class($this) . " - start.");
        $this->main();
        $this->info(get_class($this) . " - end.");

        return 0;
    }

    public function main()
    {
        $apis = json_decode($this->apis, true);

        $labels = $this->labelsService->all();
        //dump($labels);

        foreach ($apis as $api) {
            $class = "App\\Console\\Commands\\SubModules\\{$api['module']}";
            $articles = $class::get($this);

            foreach ($articles as $article) {
                // 提供元情報の登録
                $user = $this->usersService->getUserByUrl($article['user']['url']);
                if (is_null($user)) {
                    $userId = $this->usersService->insertUser([
                        'email' => null,
                        'url' => $article['user']['url'],
                        'name' => $article['user']['name'],
                        'role_id' => Roles::API,
                        'birthdate' => null,
                        'group_code' => '0',
                    ]);
                    $this->info("Create users. ({$article['user']['url']})");
                } else {
                    $userId = $user['id'];
                }

                // 記事情報の登録
                $row = $this->articlesService->getByKey($article['key']);
                //dump($article['key']);
                if (is_null($row)) {
                    $articleId = $this->articlesService->insertArticles([
                        'user_id' => $userId,
                        'key' => $article['key'],
                        'type' => Articles::TYPE_MEMBER_ARTICLE,
                        'title' => $article['title'],
                        'body' => $article['body'],
                        'link' => $article['link'],
                        'status' => Status::ENABLED,
                    ]);
                    $this->info("Create articles. ({$article['title']})");
                    //$this->info("[{$article['key']}]");
                    //$this->info(strlen($article['key']));
                }

                // ラベル情報の登録
                if (isset($articleId)) {
                    foreach ($labels as $label) {
                        $text = $article['title'] . $article['body'];
                        $similar = $this->searchSimilarText($label['value'], $text);
                        if ($similar > 90.00) {
                            $this->articleLabelsService->insertArticleLabels([
                                'article_id' => $articleId,
                                'label_id' => $label['id'],
                            ]);
                            $this->info("Create article_labels. ({$label['value']})");
                        }
                    }
                }
            }

            //dump($articles);
            //$this->info($json);
        }
    }

    private function searchSimilarText($search, $text)
    {
        $result = 0.0;

        $search = trim(strtolower($search));
        $text = trim(strtolower($text));

        for ($i = 0; $i < strlen($text) - strlen($search); $i++) {
            similar_text($search, substr($text, $i, strlen($search)), $perc);
            if ($result < $perc) {
                $result = $perc;
            }
        }

        return $result;
    }
}
