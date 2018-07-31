<?php

namespace App\Models;

use App;
use App\Collections\CardCollection;
use App\Models\Card;

class Deck
{
    private static $instance;
    private static $cardCollection;
    private static $pickedCards;

    private function __construct()
    {
        self::$cardCollection = CardCollection::getInstance();
    }

    public static function getInstance()
    {
        if (! (self::$instance instanceof self)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Generates the card collection and store it
     * on deck.
     * @return void
     */
    public function prepare()
    {
        foreach (array_keys(\CARD_SYMBOLS) as $symbol) {
            foreach (array_keys(\CARD_SUITS) as $suit) {
                self::$cardCollection->add(new Card($suit, $symbol));
            }
        }
        App\send_message("Deck preparation...");
    }

    /**
     * Shuffles the deck.
     * @return void
     */
    public function shuffle()
    {
        self::$cardCollection->shuffle();
        App\send_message("Shuffling cards...");
        App\send_newline();
    }

    /**
     * Picks a card on the collection then
     * returns the picked cards.
     * @param  int
     * @return array
     */
    public function pick(int $amt)
    {
        $cards = array();

        foreach (range(1, $amt) as $i) {
            $cards[] = self::$cardCollection->get();
        }
        
        return $cards;
    }
}
