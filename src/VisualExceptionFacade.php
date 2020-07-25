<?php

namespace Austinw\VisualException;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AustinW\VisualException\VisualException
 */
class VisualExceptionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'visual-exceptions';
    }
}
