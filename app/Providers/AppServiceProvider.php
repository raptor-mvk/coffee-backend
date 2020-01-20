<?php

namespace App\Providers;

use App\Model\Good;
use App\Repository\GoodsRepository;
use App\Repository\GoodsRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GoodsRepositoryInterface::class, function() {
            $repository = new GoodsRepository();
            $repository->store(new Good(1, 'Cappuccino', 100));
            $repository->store(new Good(2, 'Espresso', 80));
            $repository->store(new Good(3, 'Americano', 50));
            $repository->store(new Good(4, 'Ice-cream', 120));
            return $repository;
        });
    }
}
