<?php

namespace App\Interfaces;

interface ICollection
{
    /**
     * A Collection must have an all method to
     * return its current collection.
     * @return array
     */
    public function all() : array;

    /**
     * A Collection must have an add method to
     * add items from its collection.
     * @param void
     */
    public function add($item) : void;

    /**
     * A Collection must have a size method to
     * get the current size of the collection.
     * @return int
     */
    public function size() : int;
}
