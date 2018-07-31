<?php

/**
 * Set of rules for input validation
 * and pre-defined inputs.
 */
const RULES = array(
    'player-count' => [
        'type'      => 'integer',
        'min'       => 2,
        'max'       => 6
    ],
    'player-name'  => [
        'type'      => 'string',
        'required'  => true,
    ]
);
