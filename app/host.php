<?php

require "vendor/autoload.php";
Predis\Autoloader::register();

$redis = new Predis\Client(array(
    "scheme" => "tcp",
    "host" => "localhost",
    "port" => 6379,
    "persistent" => "1"));

echo('
<head>
    <title>Among Us IRL</title>
</head>

<style>
    @font-face {
      font-family: NerkoOne;
      src: url(resources/NerkoOne-Regular.ttf) format("truetype");
    }

    body {
        background-color: 121212;
        color: ffa500;
        font-family: NerkoOne;
    }

    .playButton {
    	/* background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%); */
    	background-color:ffa500;
    	border-radius:28px;
    	display:inline-block;
    	cursor:pointer;
    	color:#ffffff;
    	font-family:NerkoOne;
    	font-size:28px;
    	font-weight:bold;
    	padding:21px 76px;
    	text-decoration:none;
    }
    .playButton:hover {
    	background:linear-gradient(to bottom, #408c99 5%, #599bb3 100%);
    	background-color:#408c99;
    }
    .playButton:active {
    	position:relative;
    	top:1px;
    }
</style>
');






echo('<br><center><h1 style="font-size:50px">Among Us IRL</h1><br><br>');



if ( $redis->get('gameStatus') == 'notstarted' ) {

    echo('<h3>There ' . "isn't " . 'a game in progress at the moment.<br></h3>');

    if(array_key_exists('startGame', $_POST)) {
        echo('Starting Game...');
        $redis->set("gameStatus", "starting");
        echo ('<meta http-equiv="refresh" content="0">');
    }

    echo('
        <form method="post">
            <input type="submit" name="startGame" class="button" value="Start Game" /><br>
        </form>
    ');

}



if ( $redis->get('gameStatus') == 'starting' ) {

    echo("<h3>Players are now able to join. Here's the players that have joined so far:</h3><br><br>");

    foreach ($redis->smembers("players") as $player) {
        echo($player . '<br>');
    }

    echo('<br><br>');

    if(array_key_exists('kickAllPlayers', $_POST)) {
            echo('Kicking Players...');
            foreach ($redis->smembers("players") as $player) {
                        $redis->srem('players', $player);
                    }
            $redis->set('gameStatus', 'notstarted');
            echo ('<meta http-equiv="refresh" content="0">');
        }

    if(array_key_exists('startGameNoLobby', $_POST)) {
            echo('Starting Game...');
            $redis->set("gameStatus", "inProgress");
            $redis->set("impostor", $redis->srandmember('players'));
            echo ('<meta http-equiv="refresh" content="0">');
        }

    echo('
        <form method="post">
            <input type="submit" name="startGameNoLobby" class="button" value="Start Game" /><br>
            <input type="submit" name="kickAllPlayers" class="button" value="Stop Game" /><br>
        </form>
    ');

    echo ('<meta http-equiv="refresh" content="2">');

}



if ( $redis->get('gameStatus') == 'inProgress' ) {

    echo("<h3>Game in Progress!</h3><br>");

    echo('<u>Players</u><br>');
    foreach ($redis->smembers("players") as $player) {
            if ( $redis->sismember('deadPlayers', $player) ) {
                echo("<s>" . $player . "</s>" . ' DEAD!<br>');
            } else {
                echo($player . '<br>');
            }
    }

    echo('<br><br>');

    if(array_key_exists('endGame', $_POST)) {
            echo('Ending Game...');
            foreach ($redis->smembers("players") as $player) {
                        $redis->srem('players', $player);
                    }
            foreach ($redis->smembers("deadPlayers") as $player) {
                                    $redis->srem('deadPlayers', $player);
                                }
            $redis->set('gameStatus', 'notstarted');
            echo ('<meta http-equiv="refresh" content="0">');
        }

    echo('
        <form method="post">
            <input type="submit" name="endGame" class="button" value="End Game" /><br>
        </form>
    ');

    echo ('<meta http-equiv="refresh" content="2">');

}

echo('Among Us IRL is an original piece of software by @lincolnthedev');
