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

    public function testTagMedia()
    {
        $url1 = 'https://www.instagram.com/graphql/query/?query_hash=298b92c8d7cad703f7565aa892ede943&variables=%7B%22tag_name%22%3A%22whpblackandwhite%22%2C%22first%22%3A5%2C%22after%22%3A%22AQCTYt9bsojVi8Ok__BJRYDhxz4nNplfgqYvRjhkxvtecTbz97cCLkfiAIioGZ0W5qtO56sQzsov-NK0xW6tZxBCEHnuAT2d1BfveE52lnWyDw%22%7D';
        $url2 = Endpoint::tagMedia('whpblackandwhite', 5, [
            'variables' => [
                'after' => 'AQCTYt9bsojVi8Ok__BJRYDhxz4nNplfgqYvRjhkxvtecTbz97cCLkfiAIioGZ0W5qtO56sQzsov-NK0xW6tZxBCEHnuAT2d1BfveE52lnWyDw',
            ],
        ]);

        $url1 = $this->parseGraphqlQueryUrl($url1);
        $url2 = $this->parseGraphqlQueryUrl($url2);

        $this->assertEquals($url1, $url2);
    }

    public function testAccountMedia()
    {
        $url1 = 'https://www.instagram.com/graphql/query/?query_hash=472f257a40c653c64c666ce877d59d2b&variables=%7B%22id%22%3A%2225025320%22%2C%22first%22%3A12%2C%22after%22%3A%22AQAaIX_jP4RxEgBcvan8A_WUpfLxTl1mU7pfYlvqnqjlZunDgkjf5knStKlf96juxQiGX_BXJm1WF-MsmlrCIrukbmoHmPGZCjSbE3gR1I3_Ow%22%7D';
        $url2 = Endpoint::accountMedia('25025320', 12, [
            'variables' => [
                'after' => 'AQAaIX_jP4RxEgBcvan8A_WUpfLxTl1mU7pfYlvqnqjlZunDgkjf5knStKlf96juxQiGX_BXJm1WF-MsmlrCIrukbmoHmPGZCjSbE3gR1I3_Ow',
            ],
        ]);

        $url1 = $this->parseGraphqlQueryUrl($url1);
        $url2 = $this->parseGraphqlQueryUrl($url2);


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

    protected function parseGraphqlQueryUrl($url)
    {
        $url = parse_url($url);
        parse_str($url['query'], $query1);
        $url['query'] = $query1;
        $url['query']['variables'] = json_decode($url['query']['variables'] ?? '{}', true);

        return $url;
    }
}
