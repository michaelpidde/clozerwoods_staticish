<?php

$title = '- Counters';

ob_start();
require 'source/template/header.php';
echo <<<HTM
<section>
    <h1>Counters</h1>
    <h2>General</h2>
    <p>Days since being a bitch: <span id="counter-bitch"></span></p>
    <h2>Garden 2023</h2>
    <p>Days since starting seeds: <span id="counter-seed-start"></span><br>(sweet 100, roma, parsley, Geno & sweet basil, slenderette & garden beans, rosemary, mini belle peppers)</p>
    <p>Days since transplanting outdoors: <span id="counter-transplant"></span><br>(sans basil, rosemary, peppers)</p>
    <p>Days since starting carrots: <span id="counter-carrots"></span><br>(Nantes half long, short & sweet)</p>
</section>
<script>
const DaysSince = (/*string*/ date) => {
    return Math.floor((Date.now() - new Date(date).getTime()) / 1000 / 60 / 60 / 24);
};
document.getElementById('counter-bitch').innerHTML = DaysSince('2023-07-20');
document.getElementById('counter-seed-start').innerHTML = DaysSince('2023-04-15');
document.getElementById('counter-transplant').innerHTML = DaysSince('2023-05-07');
document.getElementById('counter-carrots').innerHTML = DaysSince('2023-05-08');
</script>
HTM;
require 'source/template/footer.php';
ob_end_flush();
