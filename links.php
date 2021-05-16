<?php
$file=fread(fopen("resources/links.txt","r"),filesize("resources/links.txt"));
echo $file;
?>