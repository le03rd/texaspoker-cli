<?php

/**
 * Constants for the input type.
 */
const INPUT_AUTO       = 'automatic';
const INPUT_MANUAL     = 'manual';

/**
 * Constants for type of console message.
 */
const TYPES = array(
    'info'      => '[INFO]',
    'debug'     => '[DEBUG]',
    'danger'    => '[ERROR]',
    'warn'      => '[WARN]',
    'input'     => '[INPUT]',
);

/**
 * Constants for the appropriate colors
 * for each type.
 */
const TYPE_COLORS = array(
    'info'      => '1;36',
    'debug'     => '1;30',
    'danger'    => '1;31',
    'warn'      => '1;33',
    'input'     => '1;34',
);

/**
 * Constants for the list of Suits.
 */
const CARD_SUITS = array(
    'ACE'   => 'A',
    'KING'  => 'K',
    'QUEEN' => 'Q',
    'JACK'  => 'J',
    '10'    => '10',
    '9'     => '9',
    '8'     => '8',
    '7'     => '7',
    '6'     => '6',
    '5'     => '5',
    '4'     => '4',
    '3'     => '3',
    '2'     => '2',
);

/**
 * Constants for the list of symbols.
 */
const CARD_SYMBOLS = array(
    'HEART'     => '♥',
    'DIAMOND'   => '♦',
    'CLUB'      => '♣',
    'SPADES'    => '♠',
);

/**
 * Constants for the colors appropriate
 * for the card symbols.
 */
const CARD_COLORS = array(
    'HEART'     => '1;31',
    'DIAMOND'   => '1;31',
    'CLUB'      => '0;37',
    'SPADES'    => '0;37',
);
