<?php

namespace App\Controllers;

use App;
use App\Lib\TPGame;
use App\Models\Deck;
use App\Models\Table;
use App\Collections\PlayerCollection;

class GameController
{
    /**
     * Main Controller of the Game Simulation
     * @return void
     */
    public static function execute() : void
    {
        /** Game Initialization */
        $game = new TPGame();

        /** Game Dependency Injections */
        $game->setPlayerCollection(PlayerCollection::getInstance());

        /** Setup Config
         *  Manual Simulation: Manual configuration
         *  Automatic Simulation: Collects pre-defined config from application config
         */
        $game->setupConfig();

        /** Generating Player Models */
        $game->createPlayerModels();

        /** Display the Current Configuration */
        $game->showCurrentConfig();

        /** Display the introductory message for starting simulation */
        $game->showSimulationIntro();

        /** Table ready */
        $game->setTable(Table::getInstance());

        /** Deck preparation */
        $game->setDeck(Deck::getInstance());
        $game->deck->prepare();

        /** Deck shuffling */
        $game->deck->shuffle();

        /** Each player receives 2 randomly picked cards from the deck */
        foreach ($game->playerCollection->all() as $player) {
            $player->addToHand($game->deck->pick(2));
        }

        /** Flop Stage: Dealer receives 3 cards from the deck */
        $game->startFlopStage();
        $game->table->addToHand($game->deck->pick(3));

        /** Update ranks */
        $game->updateRanks();
        $game->showRanks();

        /** Turn Stage: Dealer receives another single card */
        $game->startTurnStage();
        $game->table->addToHand($game->deck->pick(1));

        /** Update ranks */
        $game->updateRanks();
        $game->showRanks();

        /** River Stage: Dealer receives another single card */
        $game->startRiverStage();
        $game->table->addToHand($game->deck->pick(1));

        /** Update ranks */
        $game->updateRanks();
        $game->showRanks('final');
    }
}
