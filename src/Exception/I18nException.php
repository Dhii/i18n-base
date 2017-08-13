<?php

namespace Dhii\I18n\Exception;
use Exception as RootException;

/**
 * Represents an exception related to internationalization.
 *
 * @since 0.1
 */
class I18nException extends AbstractI18nException implements I18nExceptionInterface
{
    /**
     * {@inheritdoc}
     *
     * @see RootException::__construct()
     * @since 0.1
     */
    public function __construct($message = '', $code = 0, RootException $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->_construct();
    }
}
