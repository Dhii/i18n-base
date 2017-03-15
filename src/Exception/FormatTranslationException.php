<?php

namespace Dhii\I18n\Exception;

use Dhii\I18n\TranslatorInterface;

/**
 * Represents an exception related to string translation.
 *
 * @since 0.1
 */
class FormatTranslationException extends AbstractFormatTranslationException implements FormatTranslationExceptionInterface
{
    /**
     * {@inheritdoc}
     *
     * @see \Exception::__construct()
     * @since 0.1
     */
    public function __construct(
            $message = '',
            $code = 0,
            \Exception $previous = null,
            $subject = null,
            TranslatorInterface $translator = null,
            $context = null,
            $params = null)
    {
        parent::__construct($message, $code, $previous);

        $this->_setSubject($subject);
        $this->_setTranslator($translator);
        $this->_setContext($context);
        $this->_setInterpolationParams($params);

        $this->_construct();
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1
     */
    public function getSubject()
    {
        return $this->_getSubject();
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1
     */
    public function getTranslator()
    {
        return $this->_getTranslator();
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1
     */
    public function getContext()
    {
        return $this->_getContext();
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1
     */
    public function getParams()
    {
        return $this->_getInterpolationParams();
    }
}
