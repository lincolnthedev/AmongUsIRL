<?php

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



echo('<img src="resources/artwork.jpeg" height="325" width="240" style="margin-bottom:-4.5rem">');
echo('<h1 style="font-size:100px">Among Us <b>IRL</b></h1>');
echo('<h3 style="margin-top:-3rem">by @lincolnthedev</h3>');

echo('<br><br><br>
<form action="join.php" method="get">
<input type="text" id="myname" name="myname" placeholder="Your Name"><br><br>
<button type="submit" class="playButton">Play</button>
<br><br><br>');
echo('<a href="host.php" style="color:ffa500">Host Game</a>');



echo('</center>');
