<?php

namespace App\Collections;

use App\Models\Card;
use App\Interfaces\ICollection;

class CardCollection implements ICollection
{
    private static $instance;
    private static $collection = array();

    public static function getInstance()
    {
        if (! (self::$instance instanceof self)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Adds new card from the collection.
     * @param void
     */
    public function add($c) : void
    {
        if (! ($c instanceof Card)) {
            throw new \Exception("Must be an instance of Card");
        }

        self::$collection[] = $c;
    }

    /**
     * Returns the current collection of cards.
     * @return array
     */
    public function all() : array
    {
        return self::$collection;
    }

    /**
     * Returns the current size of the collection.
     * @return int
     */
    public function size() : int
    {
        return \sizeof(self::$collection);
    }

    /**
     * Returns the first card of the collection.
     * @return Card
     */
    public function get() : Card
    {
        return array_shift(self::$collection);
    }

    /**
     * Shuffles the collection of cards.
     * @return void
     */
    public function shuffle() : void
    {
        shuffle(self::$collection);
    }
}
