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
        $url1 = 'https://i.instagram.com/api/v1/users/198945880/info/';
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

    public function testTagQraphqlQuery()
    {
        $url1 = 'https://www.instagram.com/graphql/query/?query_hash=query_hash_test&variables=%7B%22tag_name%22%3A%22instagram%22%2C%22first%22%3A4%2C%22after%22%3A%22QVFBa2kzTXZVYXRtbEJoaXh5REloNVYzbFRhcXhKRE1QcExnZFUtOXlQUVRTbHlqY0JjcVdhcmZJS1BrV1BLSUxvb2xhQlNQWHRiZU8zXzdpamFBenVZag%3D%3D%22%7D';
        $url2 = Endpoint::tagGraphqlQuery('query_hash_test', 'instagram', 'QVFBa2kzTXZVYXRtbEJoaXh5REloNVYzbFRhcXhKRE1QcExnZFUtOXlQUVRTbHlqY0JjcVdhcmZJS1BrV1BLSUxvb2xhQlNQWHRiZU8zXzdpamFBenVZag==', 4);

        $this->assertEquals($url1, $url2);
    }

    public function testFollowersGraphqlQuery()
    {
        $url1 = 'https://www.instagram.com/graphql/query/?query_hash=query_hash_test&variables=%7B%22id%22%3A%22123%22%2C%22include_reel%22%3Atrue%2C%22fetch_mutual%22%3Afalse%2C%22first%22%3A24%7D';
        $url2 = Endpoint::followersGraphqlQuery('query_hash_test', '123', null, 24);

        $this->assertEquals($url1, $url2);

        $url1 = 'https://www.instagram.com/graphql/query/?query_hash=query_hash_test&variables=%7B%22id%22%3A%22123%22%2C%22include_reel%22%3Atrue%2C%22fetch_mutual%22%3Afalse%2C%22first%22%3A19%2C%22after%22%3A%22after_1%22%7D';
        $url2 = Endpoint::followersGraphqlQuery('query_hash_test', '123', 'after_1', 19);

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
}
