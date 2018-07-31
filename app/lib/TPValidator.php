<?php

namespace App\Lib;

class TPValidator
{
    private static $rule;
    private static $input;

    /**
     * Validates the input with the rule provided.
     * @param  any
     * @param  String
     * @return bool
     */
    public static function test($i, String $r) : bool
    {
        self::$rule     = RULES[$r];
        self::$input    = gettype($i) === 'string' ? trim($i) : $i;

        if (\array_key_exists('type', self::$rule)) {
            self::checkType();
        }

        if (\array_key_exists('required', self::$rule)) {
            self::checkRequired();
        }

        if (\array_key_exists('min', self::$rule)) {
            self::checkMin();
        }

        if (\array_key_exists('max', self::$rule)) {
            self::checkMax();
        }

        return true;
    }

    /**
     * Checks whether the specified rule for type
     * matched the type of the input.
     * @return bool
     */
    private function checkType() : bool
    {
        $valid = ['integer', 'string', 'boolean'];

        if (! \in_array(self::$rule['type'], $valid)) {
            throw new \Exception("Rule type is not valid.");
        }

        if (gettype(self::$input) !== self::$rule['type']) {
            throw new \Exception("Input type must be " . self::$rule['type'] . ".");
        }

        return true;
    }

    /**
     * Checks if the input has a value.
     * @return bool
     */
    private function checkRequired() : bool
    {
        if (!isset(self::$input) || self::$input === '') {
            throw new \Exception("Input must have a value");
        }

        return true;
    }

    /**
     * Checks if the input is beyond the minimum value or length.
     * @return bool
     */
    private function checkMin() : bool
    {
        if (! \array_key_exists('type', self::$rule)) {
            throw new \Exception("Ruleset must contain a type rule.");
        }

        if (self::$rule['type'] === 'boolean') {
            throw new \Exception("Rule not applicable to type boolean.");
        }

        if (self::$rule['type'] === 'integer' && self::$input < self::$rule['min']) {
            throw new \Exception("Input must be greater than " . self::$rule['min'] . ".");
        }
        
        if (self::$rule['type'] === 'string' && \strlen(self::$input) < self::$rule['min']) {
            throw new \Exception("Input character length must be greater than " . self::$rule['min'] . ".");
        }

        return true;
    }

    /**
     * Checks if the input is below the maximum value or length.
     * @return bool
     */
    private function checkMax() : bool
    {
        if (! \array_key_exists('type', self::$rule)) {
            throw new \Exception("Ruleset must contain a type rule.");
        }

        if (self::$rule['type'] === 'boolean') {
            throw new \Exception("Rule not applicable to type boolean.");
        }

        if (self::$rule['type'] === 'integer' && self::$input > self::$rule['max']) {
            throw new \Exception("Input must be less than or equal to " . self::$rule['max'] . ".");
        }
        
        if (self::$rule['type'] === 'string' && \strlen(self::$input) > self::$rule['max']) {
            throw new \Exception("Input character length must be less than or equal to " . self::$rule['max'] . ".");
        }

        return true;
    }
}
