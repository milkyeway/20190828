<?php
require __DIR__ . '/__connect_db.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料欄位不足',
    'post' => $_POST,
];


# 如果沒有輸入必要欄位
// if (empty($_POST['wine']) or empty($_POST['sid']) or empty($_POST['my_life'])) {
//     echo json_encode($result, JSON_UNESCAPED_UNICODE);
//     exit;
// }

$upload_dir = 'uploads/';

$allowed_types = [
    'image/png',
    'image/jpeg',
];
$allowed_connection = [
    'image/png' => '.png',
    'image/jpeg' => '.jpg',
];



if (!empty($_FILES['my_file'])) {

    if (in_array($_FILES['my_file']['type'], $allowed_types)) {
        $new_filename = sha1(uniqid() . $_FILES['my_file']['name']);
        $new_ext = $allowed_connection[$_FILES['my_file']['type']];
        move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_dir . $new_filename . $new_ext);

        $sql = "UPDATE `wine_goods` SET
        `wine`=?,
        `kind`=?,
        `producing_countries`=?,
        `brand`=?,
        `Production_area`=?,
        `years`=?,
        `capacity`=?,
        `concentration`=?,
        `price`=?,
        `Product_brief`=?,
        `Brand_story`=?,
        `classification`=?,
        `my_file`=? 
         WHERE `sid`=?";
       
       $stmt = $pdo->prepare($sql);
       
       $stmt->execute([
           $_POST['wine'],
           $_POST['kind'],
           $_POST['producing_countries'],
           $_POST['brand'],
           $_POST['Production_area'],
           $_POST['years'],
           $_POST['capacity'],
           $_POST['concentration'],
           $_POST['price'],
           $_POST['Product_brief'],
           $_POST['Brand_story'],
           $_POST['classification'],
           $new_filename . $new_ext,  //資料庫圖片名   （編碼圖片名+副檔名）
           $_POST['sid'],
       ]);
       if ($stmt->rowCount() == 1) {
            $result['success'] = true;
            $result['code'] = 200;
            $result['info'] = '修改成功';
        } else {
            $result['code'] = 520;
            $result['info'] = '資料沒有修改';
        }

    } else {
        $result['code'] = 470;
        $result['info'] = '資料欄位不足';
    }

}else{
    $sql = "UPDATE `wine_goods` SET
    `wine`=?,
    `kind`=?,
    `producing_countries`=?,
    `brand`=?,
    `Production_area`=?,
    `years`=?,
    `capacity`=?,
    `concentration`=?,
    `price`=?,
    `Product_brief`=?,
    `Brand_story`=?,
    `classification`=?
     WHERE `sid`=?";
   
   $stmt = $pdo->prepare($sql);
   
   $stmt->execute([
       $_POST['wine'],
       $_POST['kind'],
       $_POST['producing_countries'],
       $_POST['brand'],
       $_POST['Production_area'],
       $_POST['years'],
       $_POST['capacity'],
       $_POST['concentration'],
       $_POST['price'],
       $_POST['Product_brief'],
       $_POST['Brand_story'],
       $_POST['classification'],
       $_POST['sid'],
   ]);
   if ($stmt->rowCount() == 1) {
        $result['success'] = true;
        $result['code'] = 200;
        $result['info'] = '修改成功';
    } else {
        $result['code'] = 420;
        $result['info'] = '資料沒有修改';
    }

}
// } else {
//     $sql = "UPDATE `wine_goods` SET
//  `my_file`=?  #上傳圖片 資料庫欄位id
//   WHERE `sid`=?";

//     $stmt = $pdo->prepare($sql);

//     $stmt->execute([
//         $new_filename . $new_ext,  //資料庫圖片名   （編碼圖片名+副檔名）
//         $_POST['sid'],
//     ]);

//     if ($stmt->rowCount() == 1) {
//         $result['success'] = true;
//         $result['code'] = 111;
//         $result['info'] = '修改成功';
//     } else {
//         $result['code'] = 500;
//         $result['info'] = '資料沒有修改';
//     }
// };
// TODO: 檢查必填欄位, 欄位值的格式

# \[value\-\d\]





echo json_encode($result, JSON_UNESCAPED_UNICODE);
