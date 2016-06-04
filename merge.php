<?php
$file = '/var/www/lift/Strategy/Check/Free.php';

$content = file_get_contents($file);
$content = str_replace('$points', '$sum', $content);
file_put_contents($file, $content);

exec('git add -u');
exec('git commit -m "points -> sum"');


$content = file_get_contents($file);
$content = str_replace('$sum', '$points', $content);
file_put_contents($file, $content);

exec('git add -u');
exec('git commit -m "sum -> points"');

$content = file_get_contents($file);
$content = str_replace('@return int', '@return bool', $content);
file_put_contents($file, $content);

exec('git add -u');
exec('git commit -m "fix doc block"');
