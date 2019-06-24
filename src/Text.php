<?php
/**
 * Created for IG Monitoring.
 * User: jakim <pawel@jakimowski.info>
 * Date: 12.01.2018
 */

namespace jakim\ig;


class Text
{

    public static $usernamesPattern = '/(?:@)([A-Za-z0-9_](?:(?:[A-Za-z0-9_]|(?:\.(?!\.))){0,28}(?:[A-Za-z0-9_]))?)/i';
    public static $tagsPattern = '/(?:#)([\p{L}0-9_](?:(?:[\p{L}0-9_]){0,28}(?:[\p{L}0-9_]))?)/ui';

    /**
     * @param string $text
     * @param int $minLength
     * @return array|null
     *
     * @see http://blog.jstassen.com/2016/03/code-regex-for-instagram-username-and-hashtags/
     */
    public static function getTags(string $text, $minLength = 2): ?array
    {
        if (preg_match_all(static::$tagsPattern, mb_strtolower($text), $matches)) {

            $tags = array_filter($matches['1'], function ($tag) use ($minLength) {
                if ($minLength === false || is_int($minLength) && mb_strlen($tag) >= $minLength) {
                    return true;
                }
            });

            return array_values(array_unique($tags))?:null;
        }

        return null;

    }

    /**
     * @param string $text
     * @return array|null
     *
     * @see http://blog.jstassen.com/2016/03/code-regex-for-instagram-username-and-hashtags/
     */
    public static function getUsernames(string $text): ?array
    {
        if (preg_match_all(static::$usernamesPattern, mb_strtolower($text), $matches)) {
            return array_values(array_unique($matches['1']));
        }

        return null;
    }
}