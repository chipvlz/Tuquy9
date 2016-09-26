<?php
$allid = $_POST['list'];
$action = $_POST['action'];

$sql = "UPDATE room SET actived=$action WHERE id IN ($allid) ";

$result = mysql_query($sql);
