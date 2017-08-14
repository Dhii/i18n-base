<?php

namespace Dhii\I18n;

use Dhii\Data\ValueAwareInterface as Value;
use Dhii\Util\String\StringableInterface as Stringable;
use Dhii\I18n\Exception\I18nException;
use Dhii\I18n\Exception\TranslationException;
use Dhii\I18n\Exception\StringTranslationException;
use Dhii\I18n\Exception\FormatTranslationException;
use Exception as RootException;

/**
 * Common base functionality for format translators.
 *
 * @since 0.1
 */
abstract class AbstractBaseFormatTranslator extends AbstractFormatTranslator
{
    /**
     * {@inheritdoc}
     *
     * This method uses the {@see sprintf()} type format.
     *
     * @since 0.1
     */
    protected function _interpolateParams($format, $params)
    {
        $string = vsprintf($format, $params);

        return $string;
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1
     */
    protected function _createI18nException($message, $code = 0, RootException $previous = null)
    {
        return new I18nException($message, $code, $previous);
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1
     */
    protected function _createTranslationException($message, $code = 0, RootException $previous = null, $subject = null, TranslatorInterface $translator = null)
    {
        return new TranslationException($message, $code, $previous, $subject, $translator);
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1
     */
    protected function _createStringTranslationException($message, $code = 0, RootException $previous = null, $subject = null, TranslatorInterface $translator = null, $context = null)
    {
        return new StringTranslationException($message, $code, $previous, $subject, $translator, $context);
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1
     */
    protected function _createFormatTranslationException($message, $code = 0, RootException $previous = null, $subject = null, TranslatorInterface $translator = null, $context = null, $params = null)
    {
        return new FormatTranslationException($message, $code, $previous, $subject, $translator, $context, $params);
    }

    /**
     * Converts a value to a simple version.
     *
     * @since [*next-version*]
     *
     * @param mixed|Value $value The value to resolve.
     *
     * @return mixed The simpler value.
     */
    protected function _resolveValue($value)
    {
        if ($value instanceof Value) {
            $value = $value->getValue();
        }

        return $value;
    }

    /**
     * Converts a string representation into its primitive value.
     *
     * @since [*next-version*]
     *
     * @param mixed|Stringable|Value $string The string representation.
     *
     * @return string The string value.
     */
    protected function _resolveString($string)
    {
        if ($string instanceof Stringable) {
            return (string) $string;
        }
        $string = $this->_resolveValue($string);

        return (string) $string;
    }
}
