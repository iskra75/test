<?php
echo 'Html-file for index';
$index_adr = $_SERVER['SERVER_NAME'] . "test/dz30.09.16/";
//echo $_SERVER['SERVER_NAME'];
//echo Obrobnyk::$uri;
?>
<center>
<br /><br />
<a href="<?php $index_adr ?>">Main page</a>
<br /><br />
<a href="<?php $index_adr ?>command">Command page</a>
<br /><br />
<a href="<?php $index_adr ?>match">Match page</a>
</center>
