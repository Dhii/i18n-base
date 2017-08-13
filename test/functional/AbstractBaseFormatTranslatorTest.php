<?php

namespace Dhii\I18n\FuncTest;

use Xpmock\TestCase;

/**
 * Tests {@see Dhii\I18n\AbstractBaseFormatTranslator}.
 *
 * @since 0.1
 */
class AbstractBaseFormatTranslatorTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since 0.1
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\I18n\\AbstractBaseFormatTranslator';

    /**
     * Creates a new instance of the test subject.
     *
     * @since 0.1
     *
     * @return \Dhii\I18n\AbstractBaseFormatTranslator
     */
    public function createInstance()
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->_translateString()
            ->translate()
            ->new();

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
     * Tests whether parameters are interpolated correctly.
     *
     * @since 0.1
     */
    public function testInterpolateParams()
    {
        $subject = $this->createInstance();
        $value = 'I ate an %1$s and then a %2$s';
        $params = array('apple', 'banana');
        $reflection = $this->reflect($subject);
        $expected = 'I ate an apple and then a banana';

        $result = $reflection->_interpolateParams($value, $params);
        $this->assertEquals($expected, $result, 'Parameters could not be interpolated correctly');
    }

    /**
     * Tests that an internationalization exception can be created correctly.
     *
     * @since 0.1
     */
    public function testCreateI18nException()
    {
        $message = 'A quiet woven plant zipped past the sunny gravel';
        $code = 123;
        $previous = $this->_createException();
        $subject = $this->createInstance();
        $reflection = $this->reflect($subject);

        $result = $reflection->_createI18nException($message, $code, $previous);
        /* @var $result \Exception */
        $this->assertInstanceOf('Dhii\\I18n\\Exception\\I18nExceptionInterface', $result, 'Returned exception is not of the correct type');
        $this->assertEquals($message, $result->getMessage(), 'Returned exception does not have the correct message');
        $this->assertEquals($code, $result->getCode(), 'Returned exception does not have the correct code');
        $this->assertSame($previous, $result->getPrevious(), 'Returned exception does not have the correct inner exception');
    }

    /**
     * Tests that a translation exception can be created correctly.
     *
     * @since 0.1
     */
    public function testCreateTranslationException()
    {
        $message = uniqid('message-');
        $code = rand(1, 99);
        $previous = $this->_createException();
        $value = uniqid('subject-');
        $subject = $this->createInstance();
        $reflection = $this->reflect($subject);

        $result = $reflection->_createTranslationException($message, $code, $previous, $value);
        /* @var $result \Exception */
        $this->assertInstanceOf('Dhii\\I18n\\Exception\\TranslationExceptionInterface', $result, 'Returned exception is not of the correct type');
        $this->assertEquals($message, $result->getMessage(), 'Returned exception does not have the correct message');
        $this->assertEquals($code, $result->getCode(), 'Returned exception does not have the correct code');
        $this->assertSame($previous, $result->getPrevious(), 'Returned exception does not have the correct inner exception');
        $this->assertEquals($value, $result->getSubject(), 'Returned exception does not have the correct subject');
        $this->assertSame($subject, $result->getTranslator(), 'Returned exception does not have the correct translator');
    }

    /**
     * Tests that a string translation exception can be created correctly.
     *
     * @since 0.1
     */
    public function testCreateStringTranslationException()
    {
        $message = uniqid('message-');
        $code = rand(1, 99);
        $previous = $this->_createException();
        $value = uniqid('subject-');
        $subject = $this->createInstance();
        $context = uniqid('context-');
        $reflection = $this->reflect($subject);

        $result = $reflection->_createStringTranslationException($message, $code, $previous, $value, $context);
        /* @var $result \Exception */
        $this->assertInstanceOf('Dhii\\I18n\\Exception\\StringTranslationExceptionInterface', $result, 'Returned exception is not of the correct type');
        $this->assertEquals($message, $result->getMessage(), 'Returned exception does not have the correct message');
        $this->assertEquals($code, $result->getCode(), 'Returned exception does not have the correct code');
        $this->assertSame($previous, $result->getPrevious(), 'Returned exception does not have the correct inner exception');
        $this->assertEquals($value, $result->getSubject(), 'Returned exception does not have the correct subject');
        $this->assertSame($subject, $result->getTranslator(), 'Returned exception does not have the correct translator');
        $this->assertEquals($context, $result->getContext(), 'Returned exception does not have the correct context');
    }

    /**
     * Tests that a format translation exception can be created correctly.
     *
     * @since 0.1
     */
    public function testCreateFormatTranslationException()
    {
        $message = uniqid('message-');
        $code = rand(1, 99);
        $previous = $this->_createException();
        $value = uniqid('subject-');
        $subject = $this->createInstance();
        $context = uniqid('context-');
        $params = array('apple', 'banana');
        $reflection = $this->reflect($subject);

        $result = $reflection->_createFormatTranslationException($message, $code, $previous, $value, $context, $params);
        /* @var $result \Exception */
        $this->assertInstanceOf('Dhii\\I18n\\Exception\\FormatTranslationExceptionInterface', $result, 'Returned exception is not of the correct type');
        $this->assertEquals($message, $result->getMessage(), 'Returned exception does not have the correct message');
        $this->assertEquals($code, $result->getCode(), 'Returned exception does not have the correct code');
        $this->assertSame($previous, $result->getPrevious(), 'Returned exception does not have the correct inner exception');
        $this->assertEquals($value, $result->getSubject(), 'Returned exception does not have the correct subject');
        $this->assertSame($subject, $result->getTranslator(), 'Returned exception does not have the correct translator');
        $this->assertEquals($context, $result->getContext(), 'Returned exception does not have the correct context');
        $this->assertEquals($params, $result->getParams(), 'Returned exception does not have the correct params');
    }
}
