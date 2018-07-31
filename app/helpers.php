<?php

namespace App;

/**
 * Prompts and gets the input from the command line
 * and store it on the first argument or parameter.
 * @param  any
 * @param  String
 * @param  String|string
 * @return any
 */
function get_input(&$v, String $m, String $dt = 'string')
{
    echo "\033[" . TYPE_COLORS['input'] . "m" . TYPES['input'] . " \033[0m$m: ";
    $v = fgets(STDIN);
    settype($v, $dt);

    return $v = ($dt === 'string' ? trim($v) : $v);
}

/**
 * Sends a message to the command line.
 * @param  String
 * @param  String|string
 * @return void
 */
function send_message(String $m, String $type = 'info') : void
{
    echo "\033[" . TYPE_COLORS[$type] . "m" . TYPES[$type] . " \033[0m$m\n";
}

/**
 * Sends an empty line to the command line.
 * @return void
 */
function send_newline() : void
{
    echo "\n";
}
