<?php
require __DIR__ . '/__connect_db.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '沒有輸入姓名',
    'post' => $_POST,
];

# 如果沒有輸入必要欄位, 就離開
if (empty($_POST['wine'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

// 上傳圖片
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
        $new_filename = sha1(uniqid() . $_FILES['my_file']['name']); //加密圖片檔（轉碼）
        $new_ext = $allowed_connection[$_FILES['my_file']['type']]; //副檔名
        move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_dir . $new_filename . $new_ext);  //串接 資料夾檔名+資料庫裡的轉碼檔名+副檔名
    }
}

// ---------------------------------------------------------------


// if (!empty($_FILES['my_file'])) { // 有沒有上傳
//     if (in_array($_FILES['my_file']['type'], $allowed_types)) { // 檔案類型是否允許
//         move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_dir.$_FILES['my_file']['name']);
//     }
// }

/*
$sql = sprintf("INSERT INTO `address_book`(
            `name`, `email`, `mobile`, `birthday`, `address`, `created_at`
            ) VALUES (%s, %s, %s, %s, %s, NOW())",
    $pdo->quote($_POST['name']),
    $pdo->quote($_POST['email']),
    $pdo->quote($_POST['mobile']),
    $pdo->quote($_POST['birthday']),
    $pdo->quote($_POST['address'])
);
echo $sql;
$stmt = $pdo->query($sql);
*/

$sql = "INSERT INTO `wine_goods`(
            `wine`,
            `kind`,
            `producing_countries`,
            `brand`,
            `Production_area`, #5
            `years`,
            `capacity`,
            `concentration`,
            `price`,
            `Product_brief`,    #10
            `Brand_story`,
            `classification`,
            `my_file`) 
            VALUES (?,?,?,?,?
            ,?,?,?,?,?,
            ?,?,?)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['wine'],
    $_POST['kind'],
    $_POST['producing_countries'],
    $_POST['brand'],
    $_POST['Production_area'],  #5
    $_POST['years'],
    $_POST['capacity'],
    $_POST['concentration'],
    $_POST['price'],
    $_POST['Product_brief'],    #10
    $_POST['Brand_story'],
    $_POST['classification'],
    $new_filename . $new_ext,   //資料庫裡顯示的檔案名子 （不顯示資料夾名）
]);

if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '新增成功';
} else {
    $result['code'] = 420;
    $result['info'] = '新增失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
