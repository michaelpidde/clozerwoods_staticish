<?php
    $localTime = new DateTime();
    $localTime->setTimestamp(time());
    $localTime->setTimezone(new DateTimeZone('America/Chicago'));
?>
        <footer>
            Module built: <?php echo $localTime->format('Y-m-d H:i:s (p)'); ?>
        </footer>
    </main>
</body>
</html>