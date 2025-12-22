<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;



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

        // // ▼ DeepL翻訳機能 ▼
        // // A. サービスコンテナに DeepLTranslationService を登録
        // // これにより、アプリケーション全体でサービスのインスタンスを共有できます。
        $this->app->singleton(\App\Services\DeepLTranslationService::class, function ($app) {
            return new \App\Services\DeepLTranslationService();
        });

        // B. カスタムディレクティブ `@translate` を登録
        Blade::directive('translate', function ($expression) {
            
            // Session::get() の代わりに session() ヘルパーを使用
            return "<?php 
                // ★ 修正箇所： session() ヘルパーを使用 ★
                \$currentLocale = session('locale', 'en'); 
                \$lowerLocale = strtolower(\$currentLocale);

                // 英語の場合は翻訳せず元のテキストを返す
                if (\$lowerLocale === 'en' || \$lowerLocale === 'en-us' || \$lowerLocale === 'en-gb') {
                    echo {$expression};
                } else {
                    try {
                        \$service = app(\App\Services\DeepLTranslationService::class);
                        echo \$service->translateText({$expression}, \$currentLocale);
                    } catch (\Exception \$e) {
                        echo {$expression};
                    }
                }
            ?>";
        });

        // すべてのビューに未読カウントを渡す
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $unreadCount = Message::where('receiver_id', Auth::id())
                    ->where('is_read', false)
                    ->count();
                $view->with('global_unread_count', $unreadCount);
            }
        });
    }
}
