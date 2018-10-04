<?php
/**
 * Created for ig.
 * User: jakim <pawel@jakimowski.info>
 * Date: 01.03.2018
 */

namespace tests;

use jakim\ig\Endpoint;
use PHPUnit\Framework\TestCase;

class EndpointTest extends TestCase
{
    public function testAccountInfo()
    {
        $url1 = 'https://i.instagram.com/api/v1/users/198945880/info';
        $url2 = Endpoint::accountInfo('198945880');

        $this->assertEquals($url1, $url2);
    }

    public function testMediaDetails()
    {
        $url1 = 'https://www.instagram.com/p/BfwI37DBbjf/?__a=1';
        $url2 = Endpoint::mediaDetails('BfwI37DBbjf');
        $this->assertEquals($url1, $url2);
    }

    public function testExploreTags()
    {
        $url1 = 'https://www.instagram.com/explore/tags/aktywnemazury/?__a=1';
        $url2 = Endpoint::exploreTags('aktywnemazury');

        $this->assertEquals($url1, $url2);
    }

    public function testExploreLocations()
    {
        $url1 = 'https://www.instagram.com/explore/locations/300983197/?__a=1';
        $url2 = Endpoint::exploreLocations('300983197');

        $this->assertEquals($url1, $url2);
    }

    public function testCreateUrl()
    {
        $url1 = 'https://www.instagram.com/foo/bar';
        $url2 = Endpoint::createUrl('/{param1}/{param2}', [
            'param1' => 'foo',
            'param2' => 'bar',
        ]);

        $this->assertEquals($url1, $url2);
    }

    protected function parseGraphqlQueryUrl($url)
    {
        $url = parse_url($url);
        parse_str($url['query'], $query1);
        $url['query'] = $query1;
        $url['query']['variables'] = json_decode($url['query']['variables'] ?? '{}', true);

        return $url;
    }
}
