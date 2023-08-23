<?php

$title = '404';

ob_start();
require 'source/template/header.php';
echo <<<HTM
<section>
    <h1>404</h1>
    <p>I'm not sure what you're looking for, but it isn't here.</p>
    <a href="/">Go home</a>
</section>
HTM;
require 'source/template/footer.php';
ob_end_flush();
