<?php

namespace Dhii\I18n\FuncTest\Exception;

use Xpmock\TestCase;
use Dhii\Util\String\StringableInterfacen as Stringable;

/**
 * Tests {@see \Dhii\I18n\Exception\StringTranslationException}.
 *
 * @since 0.1
 */
class StringTranslationExceptionTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since 0.1
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\I18n\\Exception\StringTranslationException';

    /**
     * Creates a new instance of the test subject.
     *
     * @since 0.1
     *
     * @return \Dhii\I18n\Exception\StringTranslationException
     */
    public function createInstance($message = '', $code = 0, $previous = null, $value = null, $translator = null, $context = null)
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->new($message, $code, $previous, $value, $translator, $context);

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
     * Creates a new instance of a translator.
     *
     * @since 0.1
     *
     * @return TranslatorInterface The new instance.
     */
    protected function _createTranslator()
    {
        return $this->mock('Dhii\\I18n\\TranslatorInterface')
                ->translate()
                ->new();
    }
    /**
     * Creates a new stringable.
     *
     * @since [*next-version*]
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
        $value = uniqid('subject-');
        $translator = $this->_createTranslator();
        $context = uniqid('context-');
        $subject = $this->createInstance($message, $code, $previous, $value, $translator, $context);

        /* @var $result \Exception */
        $this->assertInstanceOf('Dhii\\I18n\\Exception\\StringTranslationExceptionInterface', $subject, 'Returned exception is not of the correct type');
        $this->assertEquals($message, $subject->getMessage(), 'Returned exception does not have the correct message');
        $this->assertEquals($code, $subject->getCode(), 'Returned exception does not have the correct code');
        $this->assertSame($previous, $subject->getPrevious(), 'Returned exception does not have the correct inner exception');
        $this->assertEquals($value, $subject->getSubject(), 'Returned exception does not have the correct subject');
        $this->assertSame($translator, $subject->getTranslator(), 'Returned exception does not have the correct translator');
        $this->assertEquals($context, $subject->getContext(), 'Returned exception does not have the correct context');
    }

    /**
     * Tests that the constructor works correctly when a stringable is passed.
     *
     * @since [*next-version*]
     */
    public function testConstructStringable()
    {
        $message = uniqid('message-');
        $_message = $this->_createStringable($message);
        $code = rand(1, 99);
        $previous = $this->_createException();
        $value = uniqid('subject-');
        $translator = $this->_createTranslator();
        $context = uniqid('context-');
        $subject = $this->createInstance($_message, $code, $previous, $value, $translator, $context);

        /* @var $result \Exception */
        $this->assertInstanceOf('Dhii\\I18n\\Exception\\StringTranslationExceptionInterface', $subject, 'Returned exception is not of the correct type');
        $this->assertEquals($message, $subject->getMessage(), 'Returned exception does not have the correct message');
        $this->assertEquals($code, $subject->getCode(), 'Returned exception does not have the correct code');
        $this->assertSame($previous, $subject->getPrevious(), 'Returned exception does not have the correct inner exception');
        $this->assertEquals($value, $subject->getSubject(), 'Returned exception does not have the correct subject');
        $this->assertSame($translator, $subject->getTranslator(), 'Returned exception does not have the correct translator');
        $this->assertEquals($context, $subject->getContext(), 'Returned exception does not have the correct context');
    }
}
