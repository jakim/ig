<?php
/**
 * Created for ig.
 * User: jakim <pawel@jakimowski.info>
 * Date: 01.03.2018
 */

namespace tests;

use jakim\ig\Url;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{

    public function testAccount()
    {
        $url1 = 'https://www.instagram.com/instagram/';
        $url2 = Url::account('instagram');
        $this->assertEquals($url1, $url2);
    }

    public function testPost()
    {
        $url1 = 'https://www.instagram.com/p/BgAFMnaj7Tq/';
        $irl2 = Url::post('BgAFMnaj7Tq');
        $this->assertEquals($url1, $irl2);
    }

    public function testLocation()
    {
        $url1 = 'https://www.instagram.com/explore/locations/216978098/mumbai-maharashtra/';
        $url2 = Url::location('216978098', 'mumbai-maharashtra');
        $this->assertEquals($url1, $url2);

        $url1 = 'https://www.instagram.com/explore/locations/216978098/';
        $url2 = Url::location('216978098');
        $this->assertEquals($url1, $url2);
    }

    public function testTag()
    {
        $url1 = 'https://www.instagram.com/explore/tags/whphidden/';
        $url2 = Url::tag('whphidden');
        $this->assertEquals($url1, $url2);
    }
}
