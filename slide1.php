<?php

$content = file_get_contents('app.php');
$content = str_replace('$lift', '$myLift', $content);
file_put_contents('app.php', $content);

file_put_contents('log.txt', date('H:i') . ' Add file log.txt');
unlink('README.txt');
