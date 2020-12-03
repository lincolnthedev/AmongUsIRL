<?php

require "vendor/autoload.php";
Predis\Autoloader::register();

$redis = new Predis\Client(array(
    "scheme" => "tcp",
    "host" => "localhost",
    "port" => 6379,
    "persistent" => "1"));






if ( $redis->get('gameStatus') == 'notstarted' ) {

    echo('There ' . "isn't " . 'a game in progress at the moment.<br>');

    function startGame() {
        echo('Starting Game...');
        $redis->set("gameStatus", "starting");
    }

    if(array_key_exists('startGame', $_POST)) {
        echo('Starting Game...');
        $redis->set("gameStatus", "starting");
    }

    echo('
        <form method="post">
            <input type="submit" name="startGame" class="button" value="Start Game" /><br>
        </form>
    ');

}



if ( $redis->get('gameStatus') == 'starting' ) {

    echo("Players are now able to join. Here's the players that have joined so far:\n\n");

    foreach ($predis->smembers('players') as $player) {
        echo($player . "<br>");
    }

    if(array_key_exists('startGame', $_POST)) {
        echo('Starting Game...');
        $redis->set('gameStatus', 'inProgress');
    }

    echo('
        <form method="post">
            <input type="submit" name="startGame" class="button" value="Start Game" /><br>
        </form>
    ');

}
