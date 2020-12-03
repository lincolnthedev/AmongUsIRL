<?php

require "vendor/autoload.php";
Predis\Autoloader::register();

$redis = new Predis\Client(array(
    "scheme" => "tcp",
    "host" => "localhost",
    "port" => 6379));

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





echo('<center><br><br>');

echo('<h1 style="font-size:50px">Among Us <b>IRL</b></h1>');





if ( isset($_GET['myname']) and $_GET['myname'] !== '' ) {





if ( $redis->get('gameStatus') == 'notstarted' ) {

    echo('<h3>There ' . "isn't " . 'a game in progress at the moment.<br>Please wait for the host to start the game.<br></h3>');
    echo ('<meta http-equiv="refresh" content="3">');

}



if ( $redis->get('gameStatus') == 'starting' ) {

    echo("<h3>Game Available! You're ready to go, " . $_GET['myname'] . "!</h3><br><br>");

    $redis->sadd('players', $_GET['myname']);

    echo('<h3>Please wait for the host to start the game.</h3>');

    echo ('<meta http-equiv="refresh" content="2">');

}



if ( $redis->get('gameStatus') == 'inProgress' ) {

    echo("<h3>Game in Progress!</h3><br>");

    if ( $_GET['myname'] == $redis->get('impostor') ) {
        echo('You are <u>IMPOSTOR</u>!<br><br>');
    } else {
        echo('You are <u>CREWMATE</u>!<br><br>');
    }

    echo('<u>Players</u><br>');
    foreach ($redis->smembers("players") as $player) {
        if ( $redis->sismember('deadPlayers', $player) ) {
            echo("<s>" . $player . "</s>" . ' DEAD!<br>');
        } else {
            echo($player . '<br>');
        }
    }

    echo('<br><br>');

    if(array_key_exists('meDead', $_POST)) {
            echo('<h1>:(</h1>');
            $redis->sadd("deadPlayers", $_GET['myname']);
        }

    if ( $_GET['myname'] !== $redis->get('impostor') ) {
    echo('
        <form method="post">
            <input type="submit" name="meDead" class="button" value="Report Yourself as Dead" /><br>
        </form>
    ');
    }

    echo ('<meta http-equiv="refresh" content="2">');

}

} else {
    echo('<h3>Your name must be included in the URL!</h3>');
}

echo('Among Us IRL is an original piece of software by @lincolnthedev');



echo('</center>');
