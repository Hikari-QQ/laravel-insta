<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        Gate::define('admin', function($user) {
            //function($user) - a closure, automatically passed by Larvale, represents authenticated user
            return $user->role_id === User::ADMIN_ROLE_ID;
        });

        // ▼ DeepL翻訳機能 ▼
        // A. サービスコンテナに DeepLTranslationService を登録
        // これにより、アプリケーション全体でサービスのインスタンスを共有できます。
        $this->app->singleton(\App\Services\DeepLTranslationService::class, function ($app) {
            return new \App\Services\DeepLTranslationService();
        });

        // B. カスタムディレクティブ `@translate` を登録
        Blade::directive('translate', function ($expression) {
            
            // 現在のロケールを取得。セッションになければ 'en' をデフォルトとする。
            $locale = Session::get('locale', 'en'); 

            // DeepLの翻訳サービスを呼び出すPHPコードを生成して返す
            return "<?php 
                echo app(\App\Services\DeepLTranslationService::class)->translateText($expression, '$locale'); 
            ?>";
        });
    }
}
