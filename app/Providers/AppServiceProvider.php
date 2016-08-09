<?php

namespace App\Providers;

use App\Post;
use App\Elastic\Elastic;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $elastic = $this->app->make(Elastic::class);
     
        Post::saved(function ($post) use ($elastic) {
            $elastic->index([
                'index' => 'blog',
                'type' => 'post',
                'id' => $post->id,
                'body' => $post->toArray()
            ]);
        });
     
        Post::deleted(function ($post) use ($elastic) {
            $elastic->delete([
                'index' => 'blog',
                'type' => 'post',
                'id' => $post->id,
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Elastic::class, function ($app) {
            return new Elastic(
                ClientBuilder::create()
                    ->setLogger(ClientBuilder::defaultLogger(storage_path('logs/elastic.log')))
                    ->build()
            );
        });

    }
}
