<?php

$sql = "DELETE FROM newsmarquee";
mysql_query($sql);

for ($i = 0; $i < count($_POST['title']); $i++) {
    $title = $_POST['title'][$i];
    $link = $_POST['link'][$i];
    
    if ($title != '' && $link != '') {
        $sql = "INSERT INTO newsmarquee(title, link) VALUES('$title','$link')";
        mysql_query($sql);
        
    }
    
    
}

echo 'Cập nhật thành công!';