<?php
$id = $_POST['id'];

$sql = "UPDATE room SET actived=Not(actived) WHERE id='$id'";

$result = mysql_query($sql);

$sql = "SELECT * FROM room WHERE id='$id'";
$rs = mysql_query($sql);
$row = mysql_fetch_array($rs,MYSQL_ASSOC);

echo $row['actived'];
