<?php
require __DIR__ . '/__connect_db.php';
$page_name = 'data_list';
$page_title = '資料列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 10; // 每一頁要顯示幾筆

$t_sql = "SELECT COUNT(1) FROM `wine_goods` ";

$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數
//$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數

$totalPages = ceil($totalRows / $per_page); // 取得總頁數

if ($page < 1) {
    header('Location: data_list.php');
    exit;
}
if ($page > $totalPages) {
    header('Location: data_list.php?page=' . $totalPages);
    exit;
}

$sql = sprintf(
    "SELECT * FROM `wine_goods` ORDER BY `sid` DESC LIMIT %s, %s", //ASC 順序排列
    ($page - 1) * $per_page,
    $per_page
);
$stmt = $pdo->query($sql)
// $stmt = $pdo->query($sql)->fetch();

//$rows = $stmt->fetchAll();

?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<style>
    .box_td {
        max-width: 100px;
        max-height: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .thumbImage {
        max-width: 25px;
        max-height: 25px;
    }

    .d-flex {
        display: flex;
    }

    .text-a {
        text-align: center;
    }

    .Flex_box {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<?php include __DIR__ . '/__html_head.php' ?>
<?php include __DIR__ . '/__navbar.php' ?>
<div class="main-content-container container-fluid col-md-10 offset-md-2 d-flex justify-content-center">
    <div class="" style="margin-top: 1rem;">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page - 1 ?>">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
                <?php
                $p_start = $page - 5;
                $p_end = $page + 5;
                for ($i = $p_start; $i <= $p_end; $i++) :
                    if ($i < 1 or $i > $totalPages) continue;
                    ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page + 1 ?>">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <table class="table table-striped table-bordered">
            <thead>

                <tr>
                    <th scope="col" style="vertical-align:left;">
                        <label class='checkbox-inline checkboxeach'>
                            <input id='checkAll' type='checkbox' name='checkboxall' value='1'></label>選取
                    </th>
                    <th scope="col"><a href="javascript:delete_all()"><i class="fas fa-trash-alt delete_all"></i></a></th>
                    <!--刪除 -->
                    <th class="box_td" scope="col">#</th>
                    <th class="box_td" scope="col">酒名</th>
                    <th class="box_td" scope="col">種類</th>
                    <th class="box_td" scope="col">生產國</th>
                    <th class="box_td" scope="col">酒莊/品牌</th>
                    <th class="box_td" scope="col">產區</th>
                    <th class="box_td" scope="col">年份</th>
                    <th class="box_td" scope="col">容量</th>
                    <th class="box_td" scope="col">濃度</th>
                    <th class="box_td" scope="col">價錢</th>
                    <th class="box_td" scope="col">商品簡述</th>
                    <th class="box_td" scope="col">品牌故事</th>
                    <th class="box_td" scope="col">廠商ID</th>
                    <th class="box_td" scope="col">產品圖片</th>
                    <th class="box_td" scope="col"><i class="fas fa-edit">編輯</i></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($r = $stmt->fetch()) {  ?>
                    <tr>
                        <td class="box_td">
                            <label class=' checkbox-inline checkboxeach'>
                                <input id="<?= 'readtrue' . $r['sid'] ?>" type='checkbox' name=<?= 'readtrue' . $r['sid'] . '[]' ?> value='<?= $r['sid'] ?>'> <!-- 選取框 -->
                            </label>
                        </td>
                        <td>
                            <a href="javascript:delete_one(<?= $r['sid'] ?>)"><i class="fas fa-trash-alt"></i></a>
                            <!--刪除確認 -->
                            <input type="hidden" id="getvalues" name="getvalues" />
                            <!--隱藏域傳參數 -->
                        </td>
                        <td class="box_td"><?= $r['sid'] ?></td>
                        <td class="box_td"><?= htmlentities($r['wine']) ?></td> <!-- htmlentities，將標籤轉換為HTML文字，防止執行標籤 -->
                        <td class="box_td"><?= htmlentities($r['kind']) ?></td> <!-- htmlentities，將標籤轉換為HTML文字，防止執行標籤 -->
                        <td class="box_td"><?= htmlentities($r['producing_countries']) ?></td> <!-- htmlentities，將標籤轉換為HTML文字，防止執行標籤 -->
                        <td class="box_td"><?= htmlentities($r['brand']) ?></td> <!-- htmlentities，將標籤轉換為HTML文字，防止執行標籤 -->
                        <td class="box_td"><?= htmlentities($r['Production_area']) ?></td> <!-- htmlentities，將標籤轉換為HTML文字，防止執行標籤 -->
                        <td class="box_td"><?= htmlentities($r['years']) ?></td>
                        <td class="box_td"><?= htmlentities($r['capacity']) ?></td>
                        <td class="box_td"><?= htmlentities($r['concentration']) ?></td>
                        <td class="box_td"><?= htmlentities($r['price']) ?></td>
                        <td class="box_td"><?= htmlentities($r['Product_brief']) ?></td>
                        <td class="box_td"><?= htmlentities($r['Brand_story']) ?></td>
                        <!-- classification -->
                        <td class="box_td"><?= htmlentities($r['classification']) ?></td>
                        <!-- 產品圖片 -->
                        <td class="Flex_box"><img class="thumbImage " src="<?= 'uploads/' . $r['my_file'] ?>" alt=""> </td>
                        <!-- <td><img src=" ?= $stmt['my_file'] ?>              "style="width:100px; height=100px;" alt=""></td> -->
                        <td style="text-align:center" ;><a href="data_edit.php?sid=<?= $r['sid'] ?>"><i class="fas fa-edit"></i></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
    <!-- 批次選取器JQ -->
    <script>
        let checkAll = $('#checkAll'); //控制所有勾選的欄位
        let checkBoxes = $('tbody .checkboxeach input'); //其他勾選欄位

        checkAll.click(function() {
            for (let i = 0; i < checkBoxes.length; i++) {
                checkBoxes[i].checked = this.checked;
            }
        })
    </script>

    <script>

        // 單筆刪除
        function delete_one(sid) {
            if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
                location.href = 'data_delete.php?sid=' + sid;
            }
        }

        // 多重刪除 
        function delete_all() {
            let sids = [];
            checkBoxes.each(function() {
                if ($(this).prop('checked')) {
                    sids.push($(this).val())
                }
            });
            if (!sids.length) {
                alert('沒有選擇任何資料');
            } else {
                if(confirm('確定要刪除這些資料嗎？')){
                    location.href = 'data_delete_all.php?sids=' + sids.toString();
                }

            }
        }
    </script>
</div>
<?php include __DIR__ . '/__html_foot.php' ?>