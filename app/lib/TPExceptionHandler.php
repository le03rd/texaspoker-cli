<?php

namespace App\Lib;

use App;

class TPExceptionHandler
{
    public function __construct()
    {
        //
    }

    /**
     * Sends only the message from the exception
     * for cleaner debugging.
     * @param  any
     * @return void
     */
    public static function exceptionHandler($exception) : void
    {
        App\send_message($exception->getMessage(), 'danger');
    }

    /**
     * Sets whether we apply the clean debugging
     * feature.
     * @return void
     */
    public function handle() : void
    {
        if (!TP_CLEAN_DEBUG) {
            return;
        }

        \set_exception_handler([$this, 'exceptionHandler']);
    }
}
