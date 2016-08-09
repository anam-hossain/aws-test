<?php

namespace App\Console\Commands;

use App\Post;
use Faker\Generator;
use App\Elastic\Elastic;
use Illuminate\Console\Command;

class IndexPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:index {total}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create posts and index via ElasticSearch';

    protected $elastic;

    protected $faker;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Elastic $elastic, Generator $faker)
    {
        $this->elastic = $elastic;
        $this->faker = $faker;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $total = $this->argument('total');

        for ($i = 1; $i <= $total; $i++) {
            
            $post = Post::create([
                'title'   => $this->faker->sentence(),
                'content' => $this->faker->text
            ]);

            // $this->elastic->index([
            //     'index' => 'blog',
            //     'type' => 'post',
            //     'id' => 1,
            //     'body' => [
            //         'title' => $this->faker->sentence()
            //         'content' => 
            //     ]
            // ]);
        }
    }
}
