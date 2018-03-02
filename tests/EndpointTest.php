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

    public function testAccountMedia()
    {
        $url1 = 'https://www.instagram.com/graphql/query/?query_id=17888483320059182&variables=%7B%22id%22%3A%2225025320%22%2C%22first%22%3A12%2C%22after%22%3A%22AQAaIX_jP4RxEgBcvan8A_WUpfLxTl1mU7pfYlvqnqjlZunDgkjf5knStKlf96juxQiGX_BXJm1WF-MsmlrCIrukbmoHmPGZCjSbE3gR1I3_Ow%22%7D';
        $url2 = Endpoint::accountMedia('25025320', 12, [
            'variables' => [
                'after' => 'AQAaIX_jP4RxEgBcvan8A_WUpfLxTl1mU7pfYlvqnqjlZunDgkjf5knStKlf96juxQiGX_BXJm1WF-MsmlrCIrukbmoHmPGZCjSbE3gR1I3_Ow',
            ],
        ]);

        $url1 = parse_url($url1);
        $url1['query'] = json_decode($url1['query'] ?? '{}', true);

        $url2 = parse_url($url2);
        $url2['query'] = json_decode($url2['query'] ?? '{}', true);


        $this->assertEquals($url1, $url2);
    }

    public function testMediaDetails()
    {
        $url1 = 'https://www.instagram.com/p/BfwI37DBbjf/?__a=1';
        $url2 = Endpoint::mediaDetails('BfwI37DBbjf');
        $this->assertEquals($url1, $url2);
    }

    public function testAccountDetails()
    {
        $url1 = 'https://www.instagram.com/instagram/?__a=1';
        $url2 = Endpoint::accountDetails('instagram');
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
}
