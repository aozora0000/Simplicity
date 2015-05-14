<?php
namespace SimplicityTest\Library\AnnotationValidator\ConditionTraits;
use \Simplicity\Library\AnnotationValidator\ConditionTraits;

class WebTest extends \PHPUnit_Framework_TestCase
{
    use ConditionTraits\Common;
    use ConditionTraits\Web;

    /**
     * @test
     */
    public function MailCaseSuccess()
    {
        $this->assertTrue(self::mail("test@example.com"));
        $this->assertTrue(self::mail("da.me..@docomo.ne.jp")); //Docomo
    }

    /**
     * @test
     */
    public function MailCaseFailed()
    {
        // Not RF2822
        $this->assertNotTrue(self::mail("Abc\@def@example.com"));
        $this->assertNotTrue(self::mail("customer/department=shipping@example.com"));
        $this->assertNotTrue(self::mail("!def!xyz%abc@example.com"));
    }

    /**
     * @test
     */
    public function UrlCaseSuccess()
    {
        $this->assertTrue(self::url("https://github.com/aozora0000/Simplicity"));
        $this->assertTrue(self::url("http://github.com/aozora0000/Simplicity/"));
        $this->assertTrue(self::url("file://User/Desktop"));
    }

    /**
     * @test
     */
    public function UrlCaseFailed()
    {
        $this->assertNotTrue(self::url("git@github.com:aozora0000/Simplicity.git"));
        $this->assertNotTrue(self::url("ssh:aozora0000@github.com"));
        $this->assertNotTrue(self::url("ftps://root/"));
    }

    /**
     * @test
     */
    public function DomainCaseSuccess()
    {
        $this->assertTrue(self::domain("github.com"));
        $this->assertTrue(self::domain("google.com"));

    }

    /**
     * @test
     */
    public function DomainCaseFailed()
    {
        $this->assertNotTrue(self::domain("192.168.0.1"));
    }

    /**
     * @test
     */
    public function Ipv4CaseSuccess()
    {
        $this->assertTrue(self::ipv4("192.168.1.1"));
        $this->assertTrue(self::ipv4("127.0.0.1:8080"));
        $this->assertTrue(self::ipv4("255.255.255.1"));
    }

    /**
     * @test
     */
    public function Ipv4CaseFailed()
    {
        $this->assertNotTrue(self::ipv4("0.0.0.1"));
        $this->assertNotTrue(self::ipv4("127.0.0.1.xip.io"));
        $this->assertNotTrue(self::ipv4("127.0.0.1:1"));
    }

    /**
     * @test
     */
    public function Ipv6CaseSuccess()
    {
        $this->assertTrue(self::ipv6("fe80::6a5b:35ff:fec5:7186"));
    }

    /**
     * @test
     */
    public function Ipv6CaseFailed()
    {
        $this->assertNotTrue(self::ipv6("3e:15:c2:ab:e7:00")); //MacAddress
    }
}
