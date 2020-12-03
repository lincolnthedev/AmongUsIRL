<?php

echo("\n" . 'Installing Dependencies...' . "\n\n");
sleep(3);

exec('mkdir ~/AmongUsIRL');
exec('cd ~/AmongUsIRL');

echo("\n" . 'Installing Homebrew...' . "\n\n");
sleep(2);
exec('sudo /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"');

echo("\n" . 'Installing wget...' . "\n\n");
sleep(2);
exec('brew install wget');

echo("\n" . 'Installing Composer...' . "\n\n");
sleep(2);
exec('brew install composer');

echo("\n" . 'Installing Redis...' . "\n\n");
sleep(2);
exec('brew install redis');

echo("\n" . 'Installing Predis...' . "\n\n");
sleep(2);
exec('composer require predis/predis');

exec('clear');
echo('Installation Complete!' . "\n" . 'Now run "php run.php" to start the server.' . "\n\n");
