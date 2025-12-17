<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // セッションに 'locale' があれば、それをLaravelのロケールとして設定
        // なければ、デフォルトの 'en' を使用（DeepLの基準言語に合わせる）
        $locale = Session::get('locale', 'en'); 

        App::setLocale($locale);

        return $next($request);
    }
}