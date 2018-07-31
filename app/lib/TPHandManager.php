<?php

namespace App\Lib;

class TPHandManager
{
    private static $player;

    /**
     * Evaluates the player with the traditional rules
     * of poker.
     * @param  Player
     * @return void
     */
    public static function evaluate(&$player) : void
    {
        self::$player = $player;
        self::sortHand(self::$player->currentHand);
        self::findFlushes();
        self::findStraight();
        self::findPairs();

        /** Get hand's rank */
        self::$player->rank = self::getRank();
    }

    /**
     * Gets the current rank of the hand
     * @return int
     */
    private static function getRank() : int
    {
        /** If none of each is found, hand is
         *  automatically ranked as High Card
         */
        if (!sizeof(self::$player->flushCards) &&
            !sizeof(self::$player->pairCards) &&
            !sizeof(self::$player->straightCards)) {
            return 9;
        }

        /** Rank 1: Straight Flush */
        if (sizeof(self::$player->strFlushCards)) {
            return 1;
        }

        /** Rank 2: Four of a Kind */
        if (sizeof(self::$player->fourKindCards)) {
            return 2;
        }
        
        /** Rank 3: Full House */
        if (sizeof(self::$player->fullHouseCards)) {
            return 3;
        }

        /** Rank 4: Flush */
        if (sizeof(self::$player->flushCards)) {
            return 4;
        }

        /** Rank 5: Straight */
        if (sizeof(self::$player->straightCards)) {
            return 5;
        }

        /** Rank 6: Three of a Kind */
        if (sizeof(self::$player->threeKindCards)) {
            return 6;
        }

        /** Rank 7: Two Pair */
        if (sizeof(self::$player->pairCards) >= 2) {
            return 7;
        }

        /** Rank 8: One Pair */
        if (sizeof(self::$player->pairCards) >= 1) {
            return 8;
        }

        /** Rank 9: High Card */
        return 9;
    }

    /**
     * Sorts the provided hand.
     * @param  array
     * @return void
     */
    private static function sortHand(array &$hand) : void
    {
        $suit_order = array_keys(CARD_SUITS);

        usort($hand, function ($a, $b) use ($suit_order) {
            $pos_a = array_search($a->suit, $suit_order);
            $pos_b = array_search($b->suit, $suit_order);

            return $pos_a - $pos_b;
        });
    }
    
    /**
     * Finds the flushes from the current hand.
     * @return void
     */
    private static function findFlushes() : void
    {
        self::$player->flushCards = [];
        $symbols = array_column(self::$player->currentHand, 'symbol');
        $counter = array_count_values($symbols);

        if (max($counter) >= 5) {
            $filter_symbol = array_search(max($counter), $counter);

            self::$player->flushCards = array_filter(self::$player->currentHand, function ($card) use ($filter_symbol) {
                return $card->symbol === $filter_symbol;
            });

            self::sortHand(self::$player->flushCards);
            self::findStraight(self::$player->flushCards);
        }
    }

    /**
     * Finds the pairs from the current hand.
     * @return void
     */
    private static function findPairs() : void
    {
        $player = &self::$player;
        self::$player->pairCards        = [];
        self::$player->threeKindCards   = [];
        self::$player->fourKindCards    = [];
        self::$player->fullHouseCards   = [];
        
        $dupes              = array();
        $suits              = array_column(self::$player->currentHand, 'suit');
        $dupes['raw']       = array_filter(array_count_values($suits), function ($item) {
            return $item > 1;
        });
        $dupes['keys']      = array_keys($dupes['raw']);
        $dupes['values']    = array_values($dupes['raw']);

        if (sizeof($dupes['raw'])) {
            array_map(
                function ($card) use (&$player, $dupes) {
                    $bool = in_array($card->suit, $dupes['keys']);

                    if ($bool) {
                        if ($dupes['raw'][$card->suit] >= 3) {
                            $player->threeKindCards[] = $card;
                        } elseif ($dupes['raw'][$card->suit] === 4) {
                            $player->fourKindCards[] = $card;
                        }

                        if (sizeof($dupes['values']) >= 2 &&
                            (in_array(3, $dupes['values']) ||
                            in_array(4, $dupes['values']))) {
                            $player->fullHouseCards[] = $card;
                        } elseif (sizeof($dupes['values']) >= 2 &&
                            (!in_array(3, $dupes['values']) &&
                            !in_array(4, $dupes['values']))) {
                            $player->pairCards[$card->suit] = $card;
                        } else {
                            $player->pairCards[$card->suit] = $card;
                        }
                    }
                },
                self::$player->currentHand
            );
        }
    }

    /**
     * Finds a straight pattern from the current hand.
     * @param  array
     * @return bool
     */
    private static function findStraight(array &$hand = []) : bool
    {
        $currentHand = !sizeof($hand) ? self::$player->currentHand : $hand;

        if (sizeof($hand)) {
            self::$player->strFlushCards = [];
        }

        self::$player->straightCards = [];

        $suit_order = array_keys(CARD_SUITS);
        $suits      = array_unique(array_column($currentHand, 'suit'));
        $flushCards = [];
        $count      = 0;

        array_reduce($suits, function ($a, $b) use (&$flushCards, &$count, $suit_order) {
            $size = sizeof($suit_order);
            $diff = ($size - array_search($a, $suit_order)) - ($size - array_search($b, $suit_order));

            if ($diff === 1) {
                if (! $count) {
                    $flushCards[] = $a;
                }

                $flushCards[] = $b;
                $count += 1;
            } else {
                $flushCards = [];
            }

            return $b;
        });

        /** If hand has an ACE & 2, lower ace is considered */
        if (in_array("ACE", $suits) && in_array(2, $flushCards)) {
            $flushCards[] = "ACE";
        }

        if (sizeof($flushCards) >= 5) {
            self::$player->straightCards = array_filter($currentHand, function ($card) use ($flushCards) {
                return in_array($card->suit, $flushCards);
            });

            if (sizeof($hand)) {
                self::$player->strFlushCards = self::$player->straightCards;
            }

            return true;
        }
        
        return false;
    }
}
