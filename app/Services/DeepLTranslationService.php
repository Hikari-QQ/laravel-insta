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
        // DeepLの言語コードは通常大文字
        $targetLanguage = strtoupper($targetLanguage); 
        
        // 翻訳元の言語を自動検出させるため 'null' を使用
        $sourceLanguage = null; 

        try {
            // 翻訳を実行
            $result = $this->translator->translateText($text, $sourceLanguage, $targetLanguage); 
            
            return $result->text;
            
        } catch (DeepLException $e) {
            // エラー時（APIキー無効、文字数制限超過など）
            Log::error('DeepL Translation Error: ' . $e->getMessage() . ' for text: ' . $text);
            
            // 元のテキストをそのまま返してサイトの動作を維持
            return $text;
        }
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