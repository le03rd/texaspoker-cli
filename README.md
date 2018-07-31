# PHP-CLI Texas Holdem Poker Simulator
A simple PHP-CLI Application created for simulating the game Texas Holdem Poker with upto 6 players.

## Requirements
Make sure all dependencies have been installed before moving on:
* [PHP](https://secure.php.net/manual/en/install.php)
* [Composer](https://getcomposer.org/download/)

## Configuration
The application configuration can be modified from:
` /config/application.php`
* `TP_INPUT` - Sets whether we set players directly from the cli on runtime. Possible values are: `manual`, `automatic`.

* `TP_CLEAN_DEBUG` - Set to 'true' if you want to see only
the message from an exception error.

* `TP_PLAYERS` - Must be an array of String consisting of list of all the player names.

## Basic Usage
Start the simulator using the following command:
```shell
$ ./simulate
```

## Sample Output
```shell
$ ./simulate

[INFO] -- WELCOME TO TEXAS HOLDEM POKER SIMULATOR
[INFO] A new game has been initiated...

[INFO] -- CURRENT GAME CONFIGURATION SETTINGS
[INFO] Simulation Type: AUTOMATIC
[INFO] Player Count: 5
[INFO] Players: A, B, C, D, E

[INFO] -- SIMULATION STARTS
[INFO] Table ready...
[INFO] Deck preparation...
[INFO] Shuffling cards...

[INFO] (P1) A's receives        :  9 ♠  4 ♦
[INFO] (P2) B's receives        :  8 ♣  5 ♣
[INFO] (P3) C's receives        :  9 ♣  6 ♦
[INFO] (P4) D's receives        :  J ♠  2 ♥
[INFO] (P5) E's receives        :  J ♥  3 ♦

[INFO] -- THE FLOP STAGE
[INFO] Dealer's receives        :  7 ♠  A ♣ 10 ♣

[INFO] -- CURRENT PLAYER RANKINGS
[INFO] (P1) A's rank            : 9
[INFO] (P2) B's rank            : 9
[INFO] (P3) C's rank            : 9
[INFO] (P4) D's rank            : 9
[INFO] (P5) E's rank            : 9

[INFO] -- THE TURN STAGE
[INFO] Dealer's receives        :  7 ♥

[INFO] -- CURRENT PLAYER RANKINGS
[INFO] (P1) A's rank            : 8
[INFO] (P2) B's rank            : 8
[INFO] (P3) C's rank            : 8
[INFO] (P4) D's rank            : 8
[INFO] (P5) E's rank            : 8

[INFO] -- THE RIVER STAGE
[INFO] Dealer's receives        :  6 ♥

[INFO] -- FINAL PLAYER RANKINGS
[INFO] (P3) C's rank            : 7
[INFO] (P1) A's rank            : 8
[INFO] (P2) B's rank            : 8
[INFO] (P4) D's rank            : 8
[INFO] (P5) E's rank            : 8
```