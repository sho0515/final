<?php
    require 'db-connect.php'
?>
<link rel="stylesheet" href="css/style.css">
<?php

echo '<table>';
echo '<tr><th>店舗ID</th><th>店舗名</th>';
echo '<th>カテゴリ</th><th>予算</th></tr>';
$yosan = 0;
switch ($_POST['yosan']) {
    case "1000":
        $yosan = 1000;
        break;
    case "3000":
        $yosan = 3000;
        break;
    case "5000":
        $yosan = 5000;
        break;
    case "10000":
        $yosan = 10000;
        break;
    case "10001":
        $yosan = 10001;
        break;
    case "1000000":
        $yosan = 1000000;
        break;
}



$pdo = new PDO($connect, USER, PASS);
if($_POST['category']=="null"){
    if($yosan==10001){
        $sql=$pdo -> prepare('SELECT store.store_id, store.name, Category.category, store.yosan
        FROM store
        LEFT JOIN Category ON store.c_id = Category.c_id
        WHERE store.yosan >= ?;
        ');
    }else{
        $sql=$pdo -> prepare('SELECT store.store_id, store.name, Category.category, store.yosan
        FROM store
        LEFT JOIN Category ON store.c_id = Category.c_id
        WHERE store.yosan <= ?;
        ');
    }
    
    $sql->execute([$yosan]);
}else{
    if($yosan==10001){
        $sql=$pdo -> prepare('SELECT store.store_id, store.name, Category.category, store.yosan
        FROM store
        LEFT JOIN Category ON store.c_id = Category.c_id
        WHERE store.c_id = ? AND store.yosan >= ?');
    }else{
        $sql=$pdo -> prepare('SELECT store.store_id, store.name, Category.category, store.yosan
        FROM store
        LEFT JOIN Category ON store.c_id = Category.c_id
        WHERE store.c_id = ? AND store.yosan <= ?');
    }
    
    $sql->execute([$_POST['category'],$yosan]);
}

echo '<form action="search.php" method="post">
        カテゴリ：<select name="category">
        <option value="null" selected hidden>選択してください</option>';
            $pdo = new PDO($connect, USER, PASS);
            $stmt = $pdo->query('SELECT c_id, category FROM Category');
            while ($row = $stmt->fetch()) {
                echo '<option value="' . $row['c_id'] . '">' . $row['category'] . '</option>';
            }
        echo '</select>　
        予算目安：<select name="yosan">
            <option value="1000000" selected hidden>選択してください</option>
            <option value="1000">1,000円以内</option>
            <option value="3000">3,000円以内</option>
            <option value="5000">5,000円以内</option>
            <option value="10000">10,000円以内</option>
            <option value="10001">10,001円以上</option>
        </select>　
        <button>絞り込み</button></p>
    </form>';


foreach($sql as $row){
    echo '<tr>';
    echo '<td>',$row['store_id'] ,'</td>';
    echo '<td>',$row['name'] ,'</td>';
    echo '<td>',$row['category'] ,'</td>';
    echo '<td>￥', number_format($row['yosan']), '</td>';
    echo '<tr>';
}
echo '</table>';
?>
    <button onclick="location.href='store-info.php'">店舗一覧へ</button>
    </body>
</html>