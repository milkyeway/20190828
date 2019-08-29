<?php
$check = $_POST['checkbox'];
echo $check;
?>
<?php
$check = $_POST['checkbox'];
foreach ($check as $value) {
    mysql_query("delete from `wine_goods` where `['sid']` = $value");
    if(file_exists($value)){
        unlink($value);
    }
}
?>

<!-- <?= 'readtrue' . $r['sid'] ?> -->