<?php

namespace Dhii\I18n\Exception;

use Dhii\I18n\TranslatorInterface;

/**
 * Represents an exception related to translation.
 *
 * @since [*next-version*]
 */
class TranslationException extends AbstractTranslationException implements TranslationExceptionInterface
{
    /**
     * {@inheritdoc}
     *
     * @see \Exception::__construct()
     * @since [*next-version*]
     */
    public function __construct(
        $message = '',
        $code = 0,
        \Exception $previous = null,
        $subject = null,
        TranslatorInterface $translator = null)
    {
        parent::__construct($message, $code, $previous);

        $this->_setSubject($subject);
        $this->_setTranslator($translator);

        $this->_construct();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getSubject()
    {
        return $this->_getSubject();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getTranslator()
    {
        return $this->_getTranslator();
    }
}
