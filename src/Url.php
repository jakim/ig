<?php
/**
 * Created for IG Monitoring.
 * User: jakim <pawel@jakimowski.info>
 * Date: 19.02.2018
 */

namespace jakim\ig;


class Url
{
    public static $baseUrl = 'https://www.instagram.com';

    public static function account($username)
    {
        return static::$baseUrl . str_replace('{username}', $username, '/{username}/');
    }

    public static function post($shortCode)
    {
        return static::$baseUrl . str_replace('{shortcode}', $shortCode, '/p/{shortcode}/');
    }

    public static function location($id, $slug = null)
    {
        $url = static::$baseUrl . str_replace('{id}', $id, '/explore/locations/{id}/');
        if ($slug) {
            $url .= "{$slug}/";
        }

        return $url;
    }

    public static function tag($tag)
    {
        return static::$baseUrl . str_replace('{tag}', $tag, '/explore/tags/{tag}/');
    }
}