<?php
require __DIR__.'/__connect_db.php';
$page_name = 'data_list'; //設定變數 給__navbar.php呼叫
$page_title = '資料列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1; //用戶要看第幾頁 檢查有無變數 如果有設定就給值 沒有就設為1

$per_page = 10; //每一頁要顯示幾筆
$t_sql = "SELECT COUNT(1) FROM `酒商` "; //sql算出總筆數

$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
// $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數 query要資料 fetch取出
$totalPages = ceil($totalRows/$per_page); //ceil無條件進位 總筆數/10=拿到總頁數


//限制分頁超過總頁數
if($page < 1){
    header('Location: data_list.php'); //起始頁  //header("檔頭資訊名稱:檔頭內容");
    exit;
}
if($page > $totalPages){
    header('Location: data_list.php?page='.$totalPages); //最後一頁
    exit;
}

// echo "$totalRows <br>";
// echo "$totalPages <br>";
// exit;

$sql = sprintf("SELECT * FROM `酒商` ORDER BY `sid` DESC LIMIT %s, %s", //LIMIT 限制筆數 {資料起始的index}, {要顯示幾筆資料}
              ($page-1)*$per_page, $per_page
);  //10筆資料為一分頁
$stmt = $pdo->query($sql);

?>
<?php include __DIR__. '/__html_head.php' ?>
<?php include __DIR__. '/__navbar.php' ?>
<div class="main-content-container container-fluid col-md-10 offset-md-2 d-flex justify-content-center">
<div class="" style="margin-top: 1rem;">
    <!-- Pagination 分頁標籤 -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page-1 ?>">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>

            <?php 
            $p_start = $page-5; //顯示前五頁
            $p_end = $page+5; //顯示後五頁
            for($i=$p_start; $i<=$p_end; $i++):
                if($i<1 or $i>$totalPages) continue;
            ?>
            <li class="page-item <?= $i==$page ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
            <?php endfor; ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page+1 ?>">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        </ul>
    </nav>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col"><i class="fas fa-trash-alt"></i></th>
                <th scope="col">#</th>
                <th scope="col">酒名</th>
                <th scope="col">分類</th>
                <th scope="col">地址</th>
                <th scope="col">統一編號</th>
                <th scope="col">負責人</th>
                <th scope="col">電話</th>
                <th scope="col">電子信箱</th>
                <th scope="col"><i class="fas fa-edit"></i></th>
            </tr>
        </thead>

        <tbody>
        <?php while($r=$stmt->fetch()) { ?> <!--拿到第一筆資料 如果為true 開始執行-->
            <tr>
                <td><a href="javascript:delete_one(<?= $r['sid'] ?>)"><i class="fas fa-trash-alt"></i></a></td>
                <td><?= $r['sid'] ?></td>
                <td><?= htmlentities($r['name']) ?></td>
                <td><?= htmlentities($r['sort']) ?></td>
                <td><?= htmlentities($r['address']) ?></td>
                <td><?= htmlentities($r['vat']) ?></td>
                <td><?= htmlentities($r['principal']) ?></td>
                <td><?= htmlentities($r['phone']) ?></td>
                <td><?= htmlentities($r['email']) ?></td>
                <td><a href="data_edit.php?sid=<?= $r['sid'] ?>"><i class="fas fa-edit"></i></a></td>
                <!-- htmlentities 跳脫網頁標籤 避免新增資料輸入標籤影響網頁呈現 -->
            </tr>
        <?php } ?>

        </tbody>
    </table>
</div>

<script>
    function delete_one(sid){
        if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
            location.href = 'data_delete.php?sid=' + sid;
        }
    }
</script>

</div>
<?php include __DIR__. '/__html_foot.php' ?>