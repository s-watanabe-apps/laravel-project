<?php
namespace App\Libs;

/**
 * ユーザー入力HTMLクラス.
 */
class UserHtml
{
    // ユーザー入力のHTMLを処理する正規表現
    const PATTERN = '|<[\s\.\/]*script[\s\.\/]*>|is';

    /**
     * ユーザー入力のHTMLにスクリプトが含まれるかチェックする.
     *
     * @param string $value
     * @return bool
     */
    public static function isScript($value)
    {
        preg_match_all(self::PATTERN, $value, $matches, PREG_PATTERN_ORDER);

        return count($matches[0]) > 0;
    }

    /**
     * ユーザー入力のHTMLに含まれるスクリプトをエスケープする.
     *
     * @param string $value
     * @return string
     */
    public static function escapeScript($value)
    {
        preg_match_all(self::PATTERN, $value, $matches, PREG_PATTERN_ORDER);

        foreach ($matches[0] as $script) {
          $encode = htmlspecialchars($script);
          $value = str_replace($script, $encode, $value);
        }

        return $value;
    }
}