<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Item\ItemRepository;
use League\CommonMark\CommonMarkConverter;
use App\Repositories\Item\ItemRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ItemRepositoryInterface::class, ItemRepository::class);
        $this->app->bind(CommonMarkConverter::class, fn () => new CommonMarkConverter([
            'html_input' => 'escape',
            'allow_unsafe_links' => false
        ]));
    }
}
