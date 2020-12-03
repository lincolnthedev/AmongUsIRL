<?php

require "predis/autoload.php";
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

<script>
    $(document).ready(function(){
        setInterval(function() {
            $("#data").load("joinData.php");
        }, 3000);
    });
</script>
');





echo('<center><br><br>');

echo('<h1 style="font-size:50px">Among Us <b>IRL</b></h1>');
echo('');

echo('</center>');
