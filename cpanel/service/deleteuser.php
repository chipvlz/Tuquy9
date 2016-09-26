<?php
$userid = $_POST["userid"];
$deletedDate = date ("Y-m-d H:i:s", time());
$userdeleted = $_SESSION["adminuser"];

$sql = "UPDATE player SET actived=0, isdeleted=1, datedeleted='$deletedDate', userdeleted='$userdeleted' WHERE username='$userid'";

$result = mysql_query($sql);

//echo $sql;die;