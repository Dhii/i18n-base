<?php

namespace Dhii\I18n\FuncTest\Exception;

use Xpmock\TestCase;
use Dhii\Util\String\StringableInterfacen as Stringable;

/**
 * Tests {@see \Dhii\I18n\Exception\I18nException}.
 *
 * @since 0.1
 */
class I18nExceptionTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since 0.1
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\I18n\\Exception\I18nException';

    /**
     * Creates a new instance of the test subject.
     *
     * @since 0.1
     *
     * @return \Dhii\I18n\Exception\I18nException
     */
    public function createInstance($message = '', $code = 0, $previous = null)
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->new($message, $code, $previous);

        return $mock;
    }

    /**
     * Creates a new generic exception.
     *
     * @since 0.1
     *
     * @param string $message The message for the exception.
     *
     * @return \Exception The new exception.
     */
    protected function _createException($message = '')
    {
        $mock = $this->mock('Exception')
            ->new($message);

        return $mock;
    }

    /**
     * Creates a new stringable.
     *
     * @since 0.2
     *
     * @param string $string The string for the stringable to represent.
     * @return Stringable The new instance.
     */
    protected function _createStringable($string = '')
    {
        $mock = $this->mock('Dhii\Util\String\StringableInterface')
                ->__toString(function() use ($string) {
                    return $string;
                })
                ->new();

        return $mock;
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since 0.1
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInstanceOf(static::TEST_SUBJECT_CLASSNAME, $subject, 'A valid instance of the test subject could not be created');
    }

    /**
     * Tests that the constructor works correctly.
     *
     * @since 0.1
     */
    public function testConstruct()
    {
        $message = uniqid('message-');
        $code = rand(1, 99);
        $previous = $this->_createException();
        $subject = $this->createInstance($message, $code, $previous);

        /* @var $result \Exception */
        $this->assertInstanceOf('Dhii\\I18n\\Exception\\I18nExceptionInterface', $subject, 'Returned exception is not of the correct type');
        $this->assertEquals($message, $subject->getMessage(), 'Returned exception does not have the correct message');
        $this->assertEquals($code, $subject->getCode(), 'Returned exception does not have the correct code');
        $this->assertSame($previous, $subject->getPrevious(), 'Returned exception does not have the correct inner exception');
    }

    /**
     * Tests that the constructor works correctly when a stringable is passed.
     *
     * @since 0.2
     */
    public function testConstructStringable()
    {
        $message = uniqid('message-');
        $_message = $this->_createStringable($message);
        $code = rand(1, 99);
        $previous = $this->_createException();
        $subject = $this->createInstance($_message, $code, $previous);

        /* @var $result \Exception */
        $this->assertInstanceOf('Dhii\I18n\Exception\I18nExceptionInterface', $subject, 'Returned exception is not of the correct type');
        $this->assertEquals($message, $subject->getMessage(), 'Returned exception does not have the correct message');
        $this->assertEquals($code, $subject->getCode(), 'Returned exception does not have the correct code');
        $this->assertSame($previous, $subject->getPrevious(), 'Returned exception does not have the correct inner exception');
    }
}
