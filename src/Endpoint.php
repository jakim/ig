<?php
/**
 * User: jakim <pawel@jakimowski.info>
 * Date: 15.10.2017
 */

namespace jakim\ig;


class Endpoint
{
    public static $baseUrl = 'https://www.instagram.com';

    public static function accountInfo($accountId, array $params = []): string
    {
        $params['id'] = $accountId;

        return static::createUrl('https://i.instagram.com/api/v1/users/{id}/info/', $params);
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

    public static function tagGraphqlQuery($queryHash, $tagName, $after, $first = null)
    {
        return static::createUrl('/graphql/query/', [
            'query_hash' => $queryHash,
            'variables' => [
                'tag_name' => $tagName,
                'first' => $first ?: rand(2, 11),
                'after' => $after,
            ],
        ]);
    }

    public static function followersGraphqlQuery($queryHash, $accountId, $after = null, $first = null)
    {
        $variables = [
            'id' => $accountId,
            'include_reel' => true,
            'fetch_mutual' => false,
            'first' => $first ?: rand(12, 24),
        ];

        if ($after) {
            $variables['after'] = $after;
        }

        return static::createUrl('/graphql/query/', [
            'query_hash' => $queryHash,
            'variables' => $variables,
        ]);
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