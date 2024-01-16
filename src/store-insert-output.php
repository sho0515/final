<?php
    require 'db-connect.php'
?>

<DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body> 
    <?php
        $pdo = new PDO($connect, USER, PASS);

        $sql = $pdo->prepare('select * from Category where category=?');
        $sql->execute([$_POST['category']]);
        $category_id = $sql->fetchColumn();
        
        if (empty($category_id)) {
            $sql = $pdo->prepare('insert into Category(category) values(?)');
            $sql->execute([$_POST['category']]);
        
            $category_id = $pdo->lastInsertId();
        }
        
        $sql = $pdo->prepare('select * from store where store_id=?');
        $sql->execute([$_POST['store_id']]);
        if (empty($sql->fetchAll())) {
            $sql = $pdo->prepare('insert into store values(?,?,?,?)');
            $sql->execute([
                $_POST['store_id'], $_POST['name'],
                $category_id, $_POST['yosan']
            ]);
            echo '店舗情報を登録しました。';
        } else {
            echo '店舗番号が既に使用されていますので、変更してください。';
        }
        
    ?>
    <br><hr><br>
    <table>
        <tr><th>店舗番号</th><th>店舗名</th><th>カテゴリ</th><th>予算目安</th></tr>
    <?php
        foreach($pdo -> query('SELECT store.store_id, store.name, Category.category, store.yosan
        FROM store
        LEFT JOIN Category ON store.c_id = Category.c_id') as $row){
            echo '<tr>';
            echo '<td>',$row['store_id'],'</td>';
            echo '<td>',$row['name'],'</td>';
            echo '<td>',$row['category'],'</td>';
            echo '<td>',$row['yosan'], '</td>';
            echo '</tr>';
            echo "\n";
        }
    ?>
    </table>
    <button onclick="location.href='store-info.php'">店舗一覧へ</button>
</body>
</html>