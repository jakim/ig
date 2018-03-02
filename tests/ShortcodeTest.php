<?php
/**
 * Created for ig.
 * User: jakim <pawel@jakimowski.info>
 * Date: 01.03.2018
 */

namespace tests;

use jakim\ig\Shortcode;
use PHPUnit\Framework\TestCase;

class ShortcodeTest extends TestCase
{

    public function testToID()
    {
        $id = '1724051029560332352';
        $shortCode = 'BftD0bnlxBA';
        $this->assertEquals($id, Shortcode::toID($shortCode));;
    }

    public function testFromID()
    {
        $id = '1724051029560332352';
        $shortCode = 'BftD0bnlxBA';
        $this->assertEquals($shortCode, Shortcode::fromID($id));
    }
}
