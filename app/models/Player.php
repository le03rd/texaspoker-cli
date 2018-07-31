<?php

namespace App\Models;

use App;
use App\Lib\TPHandManager;

class Player
{
    public $id;
    public $name;
    public $pairCards       = array();
    public $straightCards   = array();
    public $flushCards      = array();
    public $threeKindCards  = array();
    public $fourKindCards   = array();
    public $fullHouseCards  = array();
    public $strFlushCards   = array();
    public $currentHand     = array();
    public $rank            = null;
    private $hand           = array();

    /**
     * Creates a Player instance using its id
     * and name.
     * @param int
     * @param String
     */
    public function __construct(int $id, String $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }

    /**
     * Adds an array of cards to the player's hand
     * @param array
     */
    public function addToHand(array $c)
    {
        $cards = [];
        $this->hand = \array_merge($this->hand, $c);

        foreach ($c as $card) {
            $cards[] = $card->display;
        }

        $message = str_pad("(P" . $this->id . ") " . $this->name . "'s receives ", 25, " ", STR_PAD_RIGHT) . ": " . implode(" ", $cards);
        App\send_message($message);
    }

    /**
     * Gets the current rank of the player
     * based on its current hand.
     * @return void
     */
    public function getCurrentRank() : void
    {
        $message = str_pad("(P" . $this->id . ") " . $this->name . "'s rank ", 25, " ", STR_PAD_RIGHT) . ": " . $this->rank;
        App\send_message($message);
    }

    /**
     * Evaluate the player with the its
     * current hand.
     * @param  array
     * @return void
     */
    public function evaluateWith(array $dealer_cards) : void
    {
        $this->currentHand = array_merge($this->hand, $dealer_cards);
        TPHandManager::evaluate($this);
    }
}
