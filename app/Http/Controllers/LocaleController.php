<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect; 
use App\Services\DeepLTranslationService;

class LocaleController extends Controller
{
    protected $translationService;

    /**
     * DeepLTranslationServiceをコンストラクタインジェクションで受け取ります。
     * これにより、サービス内のメソッド（getTargetLanguages）を使用できます。
     */
    public function __construct(DeepLTranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    /**
     * ユーザーが選択したロケールをセッションに保存します。
     * @param string $locale URLから渡された言語コード（例: 'ja', 'en'）
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setLocale($locale)
    {
        // DeepLTranslationServiceから動的に取得した、許可される言語リストのキーを取得
        // 例: ['JA', 'EN', 'FR', ...]
        $availableLocales = array_keys($this->translationService->getTargetLanguages());

        // URLから受け取った$localeを大文字に変換してチェック
        $upperLocale = strtoupper($locale);

        // 動的なリストにあるかチェック
        if (in_array($upperLocale, $availableLocales)) {
            // セッションには小文字で保存
            Session::put('locale', strtolower($locale));
        }

        // 元のページにリダイレクトして戻る
        return Redirect::back();
    }
}