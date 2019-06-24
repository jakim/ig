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
    protected $text5;
    protected $text6;
    protected $text7;

    public function testGetUsernames()
    {
        $this->assertEquals(['instagram'], Text::getUsernames($this->text1));
        $this->assertEquals(['instagram', 'instagram1', 'juba'], Text::getUsernames($this->text2));
        $this->assertEquals(['on', 'olnud', '1500_'], Text::getUsernames($this->text3));
        $this->assertNull(Text::getUsernames('@'));
        $this->assertEquals(['ju_ba'], Text::getUsernames($this->text5));
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

    // https://github.com/jakim/ig/issues/4
    public function testGetTagsCyrillic()
    {
        $this->assertEquals(count((array)Text::getTags($this->text6)), 5);
        $this->assertEquals(['ипсум', 'долор', 'рецтеяуе', 'цонсецтетуер', 'еффициантур'], Text::getTags($this->text6));
    }

    public function testGetTagsGreek()
    {
        $this->assertEquals(count((array)Text::getTags($this->text7)), 5);
        $this->assertEquals(['λορεμ', 'ιπσθμ', 'σιγνιφερθμqθε', 'εροσ', 'ορατιο'], Text::getTags($this->text7));
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
        $this->text5 = 'on lihtsalt proovitekst, 
        proovitekst (@ju_ba) alates 1500.';
        $this->text6 = 'Лорем #ипсум#долор амет, еррор путент не усу. Ут нец ипсум латине #рецтеяуе. Ерат симул сенсерит еу про, витае сцрипта #цонсецтетуер хис не. Сед латине ехпетенда ин, еа мел цоррумпит витуперата сцрибентур. Еа муциус граеци нумяуам яуи, мовет сцрипта #еффициантур нец ид, пер ан тантас цонцептам.';
        $this->text7 = '#Λορεμ #ιπσθμ δολορ σιτ αμετ, ιν μθcιθσ #σιγνιφερθμqθε σεα, σιτ δθισ φθγιτ cθ, εοσ εα #εροσ#ορατιο. Λεγιμθσ cετεροσ cθ ηασ. Δολορεμ επιcθρει προ αδ, μθνδι λεγερε εφφιcιαντθρ ατ ιθσ. Προ ωισι λαβορεσ φθισσετ εθ, ιδ qθοδ ορατιο ρεφερρεντθρ vιξ. Σεδ μοvετ vολθπταρια αν, νιηιλ εξπλιcαρι νο ηισ.';
    }
}
