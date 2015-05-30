<?php
/**
 * Created by PhpStorm.
 * User: said
 * Date: 30.05.2015
 * Time: 15:44
 */

namespace MehrAlsNix\Notifier\Tests;


use PHPUnit_Framework_AssertionFailedError;

class ListenerBaseTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider getExceptionAsserted
     */
    public function testNotifyIsCalledByAddError($method, $title, $content)
    {
        $partialMock = $this->getMockBuilder('MehrAlsNix\Notifier\ListenerBase')
            ->setMethods(['notify'])
            ->getMockForAbstractClass()

            ;

        $partialMock->expects($this->once())
            ->method('notify')
            ->with($title, $content)
            ;
        $mockTest = $this->getMockObjectGenerator()->getMock('PHPUnit_Framework_Test')
            ;
        $partialMock->$method($mockTest, new \Exception($content), time());

    }

    public function testNotifyIsCalledByAddFailure()
    {
        $partialMock = $this->getMockBuilder('MehrAlsNix\Notifier\ListenerBase')
            ->setMethods(['notify'])
            ->getMockForAbstractClass()

        ;

        $title = 'Failure';
        $content = '';
        $partialMock->expects($this->once())
            ->method('notify')
            ->with($title, $content)
        ;

        $mockTest = $this->getMockObjectGenerator()->getMock('PHPUnit_Framework_Test');
        $partialMock->addFailure($mockTest, new PHPUnit_Framework_AssertionFailedError($content), time());

    }

    public function getExceptionAsserted()
    {
        return [
            ['addError', 'Error', 'error message'],
            ['addRiskyTest', 'Risky Test', 'risky Test !'],
            ['addIncompleteTest', 'Incomplete Test', 'incomplete Test !'],
            ['addSkippedTest', 'Skipped Test', 'skipped Test !']
        ];
    }
}
