<?php

namespace App\Models;

class Card
{
    public $symbol;
    public $suit;
    public $display;

    /**
     * Creates a card by setting its suit
     * and symbol.
     * @param any $suit
     * @param String $symbol
     */
    public function __construct($suit, String $symbol)
    {
        $this->suit     = $suit;
        $this->symbol   = $symbol;
        $this->display  = "\033[" . CARD_COLORS[$symbol] . "m";
        $this->display .= str_pad(CARD_SUITS[$this->suit], 2, ' ', STR_PAD_LEFT) . ' ' . CARD_SYMBOLS[$this->symbol];
        $this->display .= "\033[0m";
    }
}
