<?php

namespace App\Collections;

use App\Models\Player;
use App\Interfaces\ICollection;

class PlayerCollection implements ICollection
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
     * Adds a Player instance to the collection.
     * @param void
     */
    public function add($p) : void
    {
        if (! ($p instanceof Player)) {
            throw new \Exception("Must be an instance of Player");
        }

        self::$collection[] = $p;
    }

    /**
     * Returns the player objects from the collection.
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
     * Returns the names of the player collection.
     * @return array
     */
    public function getNameList() : array
    {
        return array_map(function ($item) {
            return $item->name;
        }, self::$collection);
    }
}
