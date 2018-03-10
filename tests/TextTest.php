<?php
/**
 * Created for ig.
 * User: jakim <pawel@jakimowski.info>
 * Date: 01.03.2018
 */

namespace tests;

use jakim\ig\Text;
use PHPUnit\Framework\TestCase;

class TextTest extends TestCase
{
    protected $text1;
    protected $text2;
    protected $text3;
    protected $text4;

    public function testGetUsernames()
    {
        $this->assertEquals(['instagram'], Text::getUsernames($this->text1));
        $this->assertEquals(['instagram', 'instagram1', 'juba'], Text::getUsernames($this->text2));
        $this->assertEquals(['on', 'olnud', '1500_'], Text::getUsernames($this->text3));
        $this->assertNull(Text::getUsernames('@'));
    }

    public function testGetTags()
    {
        $this->assertEquals(['natgeo'], Text::getTags($this->text1));
        $this->assertEquals(['natgeo', 'printimis', 'printimis1'], Text::getTags($this->text2));
        $this->assertEquals(['see', 'põhi'], Text::getTags($this->text3));
        $this->assertEquals(['põhi'], Text::getTags($this->text3, 4));
        $this->assertNull(Text::getTags($this->text3, 6));
        $this->assertNull(Text::getTags('#'));
        $this->assertEquals(count((array)Text::getTags($this->text4)), 30);
    }

    protected function setUp()
    {
        $this->text1 = 'on lihtsalt proovitekst, @insTagram @instagram #natgeo #natgeo printimis- ja ladumistööstuses. 
        See on olnud tööstuse põhiline proovitekst juba alates 1500.';
        $this->text2 = 'on lihtsalt proovitekst, @@instagram (@instagram1) #natgeo#natgeo #printimis(#printimis1) ja ladumistööstuses. 
        See on olnud tööstuse põhiline proovitekst @juba. alates 1500.';
        $this->text3 = '@#See!$  @on{@olnud:asd tööstuse ##põhi:line proovitekst juba alates @1500_';
        $this->text4 = 'Granne. Rzeka Bug /  Bug - the last wild river? ❤😍💎👍
#blogger
#białystoksubiektywnie #przewodnikpodlasie #przyroda #przewodnikpodlaskie #naturephotography #river #wild #landscapelovers #landscape #countryside #polishnature #poland #summer #igerspoland #igerspodlasie #igersbialystok #guide #podlaskieklimaty #podlasie #water #polskajestpiękna #polskawieś #visitpodlasie #naturegram #view #rzeka #easternpoland #nadbugiem #rural';
    }
}
