<?php
/**
 * Created by PhpStorm.
 * User: swpi
 * Date: 18.07.19
 * Time: 11:04
 */

namespace Test;

use PHPUnit\Framework\TestCase;

use Logger\Logger;

class LoggerTest extends TestCase
{

    public function testSendData():void
    {
        (new Logger('127.0.0.1','81'))->Send(0, 0,1, '', __FUNCTION__);
    }
    public function testSetUrlConstruct() :void
    {
        $this->assertStringContainsString(
            (new Logger('127.0.0.1'))->GetUrl(),
            "127.0.0.1"
        );
    }
    public function testSetPortConstruct() :void
    {
        $this->assertStringContainsString(
            (new Logger('', '81'))->GetPort(),
            "81"
        );
    }
    public function testSetUrl() :void
    {
        $logger = new Logger();
        $logger->SetUrl('127.0.0.1');
        $this->assertStringContainsString(
            $logger->GetUrl(),
            "127.0.0.1"
        );
    }
    public function testSetPort() :void
    {
        $logger = new Logger();
        $logger->SetPort('81');
        $this->assertStringContainsString(
            $logger->GetPort(),
            "81"
        );
    }
}