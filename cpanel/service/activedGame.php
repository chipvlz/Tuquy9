<?php
$open = $_POST['open'];
$close = $_POST['close'];

$sqlo = "UPDATE gamelist SET actived=1 WHERE id IN ($open)";
$sqlc = "UPDATE gamelist SET actived=0 WHERE id IN ($close)";

$rso = mysql_query($sqlo);
$rsc = mysql_query($sqlc);

echo "Đóng mở game thành công!.";