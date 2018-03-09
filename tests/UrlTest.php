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
}
