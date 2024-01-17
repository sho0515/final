<?php
    require 'db-connect.php'
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>店舗情報</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>店舗情報一覧</h1>
    
    <form action="search.php" method="post">
        カテゴリ：<select name="category" style="height: 30px";>
        <option value="null" selected hidden>選択してください</option>
        <?php
            $pdo = new PDO($connect, USER, PASS);
            $stmt = $pdo->query('SELECT c_id, category FROM Category');
            while ($row = $stmt->fetch()) {
                echo '<option value="' . $row['c_id'] . '">' . $row['category'] . '</option>';
            }
        ?>
        </select>
        予算目安：<select name="yosan" style="height: 30px";>
            <option value="1000000" selected hidden>選択してください</option>
            <option value="1000">1,000円以内</option>
            <option value="3000">3,000円以内</option>
            <option value="5000">5,000円以内</option>
            <option value="10000">10,000円以内</option>
            <option value="10001">10,001円以上</option>
        </select>
        <button>絞り込み</button></p>
    </form>
    <?php

        echo '<table>';
        echo '<tr><th>店舗ID</th><th>店舗名</th>';
        echo '<th>カテゴリ</th><th>予算</th><th>更新</th><th>削除</th></tr>';
        $pdo = new PDO($connect, USER, PASS);
        foreach($pdo -> query('SELECT store.store_id, store.name, Category.category, store.yosan
        FROM store
        LEFT JOIN Category ON store.c_id = Category.c_id') as $row){
            echo '<tr>';
            echo '<td>',$row['store_id'] ,'</td>';
            echo '<td>',$row['name'] ,'</td>';
            echo '<td>',$row['category'] ,'</td>';
            echo '<td>￥', number_format($row['yosan']), '</td>';
            echo '<td>';
            echo '<form action = "store-edit.php" method = "post">';
            echo '<input type = "hidden" name="store_id" value = "',$row['store_id'],'">';
            echo '<button type="submit">更新</button>';
            echo '</form>';
            echo '</td>';
            echo '<td>';
            echo '<form action = "store-delete.php" method = "post">';
            echo '<input type = "hidden" name="store_id" value = "',$row['store_id'],'">';
            echo '<button type="button" onclick="confirmDelete(\'',$row['store_id'],'\')">削除</button>';
            echo '</form>';
            echo '</td>';
            echo '<tr>';
        }
        echo '</table>';
    ?>
    <button onclick="location.href='store-insert-input.php'">店舗情報を登録する</button>
    <script>
        function confirmDelete(storeId) {
            var result = confirm("本当に削除しますか？");
            if (result) {
                // OKボタンが押された場合の処理
                window.location.href = 'store-delete.php?store_id=' + storeId;
            } else {
                // キャンセルボタンが押された場合の処理
            }
        }
    </script>
</body>
</html>
