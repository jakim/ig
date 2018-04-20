<?php
/**
 * User: jakim <pawel@jakimowski.info>
 * Date: 15.10.2017
 */

namespace jakim\ig;


class Endpoint
{
    public static $baseUrl = 'https://www.instagram.com';
    public static $accountMediaQueryHash = '472f257a40c653c64c666ce877d59d2b';
    public static $tagMediaQueryHash = '298b92c8d7cad703f7565aa892ede943';

    public static function accountInfo($accountId, array $params = []): string
    {
        $params['id'] = $accountId;

        return static::createUrl('https://i.instagram.com/api/v1/users/{id}/info', $params);
    }

    public static function accountDetails($username, array $params = []): string
    {
        $params['username'] = $username;
        $params['__a'] = 1;

        return static::createUrl('/{username}/', $params);
    }

    public static function accountMedia($accountId, int $first = 12, array $params = []): string
    {
        $params['query_hash'] = static::$accountMediaQueryHash;
        $params['variables']['id'] = $accountId;
        $params['variables']['first'] = $first;

        return static::createUrl('/graphql/query/', $params);
    }

    public static function mediaDetails($code, array $params = []): string
    {
        $params['code'] = $code;
        $params['__a'] = 1;

        return static::createUrl('/p/{code}/', $params);
    }

    public static function exploreLocations($id, array $params = []): string
    {
        $params['id'] = $id;
        $params['__a'] = 1;

        return static::createUrl('/explore/locations/{id}/', $params);
    }

    public static function exploreTags($tag, array $params = []): string
    {
        $params['tag'] = $tag;
        $params['__a'] = 1;

        return static::createUrl('/explore/tags/{tag}/', $params);
    }

    public static function tagMedia($tag, int $first = 8, array $params = [])
    {
        $params['query_hash'] = static::$tagMediaQueryHash;
        $params['variables']['tag_name'] = $tag;
        $params['variables']['first'] = $first;

        return static::createUrl('/graphql/query/', $params);
    }

    public static function createUrl($endpoint, array $params = []): string
    {
        preg_match_all('/{(.+?)}/', $endpoint, $matches);
        $placeholders = array_combine($matches['0'], $matches['1']);

        array_walk($params, function ($value, $key) use (&$params) {
            $params[$key] = is_array($value) ? json_encode($value) : $value;
        });

        foreach ($placeholders as $placeholder => $key) {
            if (array_key_exists($key, $params)) {
                $value = $params[$key];
                unset($params[$key]);
                $endpoint = str_replace($placeholder, $value, $endpoint);
            }
        }

        $query = http_build_query($params);
        $query = $query ? "?{$query}" : '';
        $baseUrl = substr($endpoint, 0, 4) !== 'http' ? static::$baseUrl : '';

        return $baseUrl . $endpoint . $query;
    }
}