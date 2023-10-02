<?php

$title = '- SSL Notes';

ob_start();
require 'source/template/header.php';
echo <<<HTM
<section>
    <h1>SSL Cert Upgrade Notes</h1>
    <p>I never remember how to manage the SSL cert renewal for my domains, so I'm recording some notes here. To start with, I need to <a href="https://www.namecheap.com/support/knowledgebase/article.aspx/9446/2290/generating-csr-on-apache-opensslmodsslnginx-heroku/">generate a new CSR</a> (Certificate Signing Request):<br>
    <pre>openssl req -new -newkey rsa:2048 -nodes -keyout clozerwoods.key -out clozerwoods.csr</pre></p>
    <p>The contents of clozerwoods.csr can be copied to the input box in namecheap. After that, they request that a domain confirmation step is taken. In this case, I select to add a CNAME record in my server DNS. At that point I simply need to go into Vultr's DNS settings and update the existing record with the new verification CNAME record.</p>
    <p>Once the CNAME record is verified, I'll receive an email with a zip file containing .ca-bundle and .crt files which can be moved to the correct location on the server. This should be in /var/www/crt/ssl_cert/current/[YEAR]. The .key file which was generated at the time of the CSR should also be copied into this directory. After that, the SSL poriton of the site's .conf must be updated to reference the new file paths.</p>
    <p>After restarting Apache, all should be well.</p>
</section>
HTM;
require 'source/template/footer.php';
ob_end_flush();