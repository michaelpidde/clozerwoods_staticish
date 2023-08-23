<?php
require 'header.php';
?>

<article>
    <div class="top"></div>
    <div class="paper">
        <h1>Upgrading PetzA For 2023</h1>
        <p>I don't like preambles, so let's jump into it :)</p>
        <p>(You can skip the code upgrade steps and go right to the IDE setup by cloning this <a href="https://github.com/eddybones/PetzA">already-upgraded repository</a> and following the steps in the readme file to pull the git submodules. This repo will be updated over time with fixes.)</p>
        <p>&#9635; Clone (or fork & clone) the PetzA repo: <a href="https://github.com/thenickdude/PetzA">https://github.com/thenickdude/PetzA</a>. In the terminal (you're using <a href="https://github.com/microsoft/terminal">Windows Terminal</a>, right?), CD to the code folder, then run <span class="highlight-red">git submodule update --init</span>. This will pull the git submodules at their current old versions. To pull the latest versions (where possible), run <span class="highlight-red">git submodule update --remote --merge</span>. The changeset can then be committed.</p>
        <p>&#9635; The code in ./lib/DIMime will need to be upgraded as well from the <a href="https://www.yunqa.de/delphi/products/mime/index">author's website</a>. Click the "Download Freeware" button to get the installer, then run it. Select the lib/DIMime folder as the destination to extract to. You can then commit this changeset as well.</p>
        <p>&#9635; Get the <a href="https://www.embarcadero.com/products/delphi/starter">Delphi 11 Community Edition</a> IDE. You will have to give them some contact info and possibly suffer some spam, so handle that as you see fit... You'll get an email with a serial number which will be good for a year.</p>
        <p>&#9635; Get the <a href="http://www.madshi.net/">madCollection</a> and install that, selecting madExcept version 5.</p>
        <p>&#9635; At this point you can open ./source/PetzA.dproj in the IDE. Assuming that all prior steps have happened correctly, you can hit Ctrl + F9 (or Project > Compile PetzA), and the .toy file should be generated in the build folder.</p>
        <h1>Known issues</h1>
        <ul>
            <li>Profile selection is wonky until you drag the dialog (<a href="images/petza-upgrade/issue-profiles.png">img</a>)</li>
            <li>Pet names not showing correctly in PetzA > Pets list (<a href="images/petza-upgrade/issue-pet-names.png">img</a>)</li>
            <li>Dialog title and pet name (in file name) not showing correctly when saving a photo (<a href="images/petza-upgrade/issue-save-photo.png">img</a>)</li>
        </ul>
    </div>
</article>

<?php
require 'footer.php';
