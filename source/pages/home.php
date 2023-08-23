<?php

$title = '- Home';

ob_start();
require 'source/template/header.php';
echo <<<HTM
<section>
    <h1>Clozer Woods</h1>
    <p>Random things:</p>
    <ul>
        <li><a href="/petz/">Petz</a></li>
        <li><a href="playlists">Playlists</a></li>
        <li><a href="macintosh-performa">Macintosh Performa</a></li>
        <li><a href="counters">Counters</a></li>
    </ul>
</section>
HTM;
require 'source/template/footer.php';
ob_end_flush();
