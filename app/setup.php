<?php

use App\Controllers\GameController;
use App\Lib\TPExceptionHandler;

/**
 * Override exception handler for cleaner
 * messages from the console.
 */
$eHandler = new TPExceptionHandler();
$eHandler->handle();

/**
 * Starts the Game Simulation
 */
GameController::execute();
