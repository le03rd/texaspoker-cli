<?php

namespace App\Lib;

use App;
use App\Models\Player;
use App\Models\Deck;
use App\Models\Table;
use App\Collections\PlayerCollection;

class TPGame
{
    private $playerCount;
    private $playerNames = array();
    public $playerCollection;
    public $deck;
    public $table;
    
    public function __construct()
    {
        App\send_newline();
        App\send_message("-- WELCOME TO TEXAS HOLDEM POKER SIMULATOR");
        App\send_message("A new game has been initiated...");
    }

    /**
     * Sets up the config either manual or automatic
     * input to the command line.
     * @return void
     */
    public function setupConfig() : void
    {
        if (TP_INPUT === INPUT_MANUAL) {
            App\send_newline();
            App\send_message("-- MANUAL CONFIGURATION --");

            App\get_input($this->playerCount, "Number of Players [ 2 - 6 ]", 'int');
            TPValidator::test($this->playerCount, 'player-count');

            foreach (range(1, $this->playerCount) as $i) {
                $this->players[] = App\get_input($player, "Player $i's name");
                TPValidator::test($player, 'player-name');
            }
        } else {
            $this->playerCount  = sizeof(TP_PLAYERS);
            $this->players      = TP_PLAYERS;
        }
    }

    /**
     * Displays the current configuration to the
     * command line.
     * @return void
     */
    public function showCurrentConfig() : void
    {
        App\send_newline();
        App\send_message("-- CURRENT GAME CONFIGURATION SETTINGS");
        App\send_message("Simulation Type: " . strtoupper(TP_INPUT));
        App\send_message("Player Count: " . $this->playerCollection->size());
        App\send_message("Players: " . implode(", ", $this->playerCollection->getNameList()));
    }

    /**
     * Displays the introductory message for
     * starting the simulation.
     * @return void
     */
    public function showSimulationIntro() : void
    {
        App\send_newline();
        App\send_message("-- SIMULATION STARTS");
    }

    /**
     * Creates the Player Models and store it to
     * PlayerCollection.
     * @return void
     */
    public function createPlayerModels() : void
    {
        foreach ($this->players as $idx => $name) {
            $this->playerCollection->add(new Player($idx + 1, $name));
        }
    }

    /**
     * Sets the PlayerCollection instance.
     * @param PlayerCollection
     * @return void
     */
    public function setPlayerCollection(PlayerCollection $pc) : void
    {
        $this->playerCollection = $pc;
    }

    /**
     * Sets the Deck instance.
     * @param Deck
     * @return void
     */
    public function setDeck(Deck $d) : void
    {
        $this->deck = $d;
    }

    /**
     * Sets the Table instance.
     * @param void
     */
    public function setTable(Table $t) : void
    {
        $this->table = $t;
    }

    /**
     * Updates the rank of the players with
     * their current hands.
     * @return void
     */
    public function updateRanks() : void
    {
        $players = $this->playerCollection->all();

        foreach ($players as $player) {
            $player->evaluateWith($this->table->hand);
        }
    }

    /**
     * Displays the current or final ranking
     * of the players.
     * @param  String|string
     * @return void
     */
    public function showRanks(String $s = 'current') : void
    {
        $players = $this->playerCollection->all();

        usort($players, function ($a, $b) {
            return $a->rank - $b->rank;
        });

        App\send_newline();
        App\send_message("-- " . strtoupper($s) . " PLAYER RANKINGS");

        foreach ($players as $player) {
            $player->getCurrentRank();
        }
    }

    /**
     * Displays a message for moving on to the
     * Flop Stage.
     * @return void
     */
    public function startFlopStage() : void
    {
        App\send_newline();
        App\send_message("-- THE FLOP STAGE");
    }

    /**
     * Displays a message for moving on to the
     * Turn Stage.
     * @return void
     */
    public function startTurnStage() : void
    {
        App\send_newline();
        App\send_message("-- THE TURN STAGE");
    }

    /**
     * Displays a message for moving on to the
     * River Stage.
     * @return void
     */
    public function startRiverStage() : void
    {
        App\send_newline();
        App\send_message("-- THE RIVER STAGE");
    }
}
