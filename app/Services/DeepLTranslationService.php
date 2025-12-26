<?php

namespace App\Services;

use DeepL\Translator;
use DeepL\DeepLException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class DeepLTranslationService
{
    protected $translator;

    /**
     * DeepLクライアントを初期化します。
     */
    public function __construct()
    {
        // DeepL API Freeプラン用のホストURLを指定
        $this->translator = new Translator(env('DEEPL_API_KEY'), [
            'host_url' => 'https://api-free.deepl.com'
        ]);
    }

    /**
     * テキストをリアルタイムで翻訳します。
     * @param string $text 翻訳する元のテキスト
     * @param string $targetLanguage 翻訳先の言語コード（例: 'FR', 'JA'）
     * @return string 翻訳後のテキスト、またはエラー時に元のテキスト
     */
    public function translateText(string $text, string $targetLanguage): string
    {
        if (empty($text)) {
            return '';
        }

        // 1. DeepLの言語コードは通常大文字に
        $targetLanguage = strtoupper($targetLanguage);

        // 2. キャッシュ用の名前（キー）を作る
        // 「deepl_JA_文章のハッシュ値」という名前にして、重複を防ぐ
        $cacheKey = 'deepl_' . $targetLanguage . '_' . md5($text);

        // 3. キャッシュがあればそれを返す。なければ {} の中を実行して保存する。
        return Cache::rememberForever($cacheKey, function () use ($text, $targetLanguage) {
            try {
                // 翻訳元の言語を自動検出させるため 'null' を使用
                $sourceLanguage = null;

                // 翻訳を実行
                $result = $this->translator->translateText($text, $sourceLanguage, $targetLanguage);

                return $result->text;

            } catch (DeepLException $e) {
                // エラー時（APIキー無効、文字数制限超過など）
                Log::error('DeepL Translation Error: ' . $e->getMessage() . ' for text: ' . $text);

                // エラー時はキャッシュせず、元のテキストをそのまま返す
                return $text;
            }
        });
    }

    /**
     * DeepLが翻訳可能な全てのターゲット言語をAPIから取得します。
     * 結果はキャッシュされ、24時間再利用されます。
     * @return array 言語コード（大文字） => 表示名 の連想配列
     */
    public function getTargetLanguages(): array
    {
        // 24時間キャッシュを使用
        return Cache::remember('deepl_target_languages', now()->addHours(24), function () {
            try {
                // DeepL APIからターゲット言語リストを取得
                $languages = $this->translator->getTargetLanguages();

                $list = [];
                foreach ($languages as $lang) {
                    // 言語コードをキー (例: 'JA')、言語名を値 (例: 'Japanese') として格納
                    $list[strtoupper($lang->code)] = $lang->name;
                }

                return $list;
            } catch (DeepLException $e) {
                Log::error('DeepL API Language Fetch Error: ' . $e->getMessage());
                // エラー時は、最低限の言語リストを返すことでサイトの障害を避ける
                return ['EN' => 'English', 'JA' => '日本語'];
            }
        });
    }
}