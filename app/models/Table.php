<?php

namespace App\Models;

use App;

class Table
{
    private static $instance;
    private $name = "Dealer";
    public $hand = array();

    private function __construct()
    {
        App\send_message("Table ready...");
    }

    public static function getInstance()
    {
        if (! (self::$instance instanceof self)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Adds an array of cards to the table's hand
     * @param array
     */
    public function addToHand(array $c)
    {
        $cards = [];
        $this->hand = \array_merge($this->hand, $c);

        foreach ($c as $card) {
            $cards[] = $card->display;
        }

        $message = str_pad($this->name . "'s receives", 25, " ", STR_PAD_RIGHT) . ": " . implode(" ", $cards);
        App\send_message($message);
    }
}
