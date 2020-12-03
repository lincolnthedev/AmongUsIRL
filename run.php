<?php

exec('clear');

echo("\n");

exec('figlet -f small Among Us IRL');

sleep(3);

echo("\n" . 'Starting Server...' . "\n\n\n");

exec('php -S localhost:8000 -t app/');
