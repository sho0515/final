<?php
    require 'db-connect.php'
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>store-delete</title>
        <link rel="stylesheet" href="css/style.css">
	</head>
	<body>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $deletecategory_id=$pdo->prepare('select c_id from store where store_id=?');
    $deletecategory_id->execute([$_GET['store_id']]);
    $c_id=$deletecategory_id->fetch();
        $c_id['c_id'];

    $sql=$pdo->prepare('delete from store where store_id=?');
        
    if($sql->execute([$_GET['store_id']])){
        echo '削除に成功しました。';
        
        $delete = $pdo->prepare('SELECT * FROM store WHERE c_id = ?');
        $delete->execute([$c_id['c_id']]);
        //$delete = $pdo->lastInsertId();
        $count = $delete->rowCount();
        if($count==0){
            $sql=$pdo->prepare('delete from Category where c_id=?');
            $sql->execute([$c_id['c_id']]);
        }
    
        
    }else{
        echo '削除に失敗しました。';
    }

?>
    <br><hr><br>
	<table>
		<tr><th>店舗ID</th><th>店舗名</th>
        <th>カテゴリ</th><th>予算</th></tr>
<?php
    foreach($pdo -> query('SELECT store.store_id, store.name, Category.category, store.yosan
    FROM store
    LEFT JOIN Category ON store.c_id = Category.c_id') as $row){
        echo '<tr>';
        echo '<td>',$row['store_id'] ,'</td>';
        echo '<td>',$row['name'] ,'</td>';
        echo '<td>',$row['category'] ,'</td>';
        echo '<td>￥', number_format($row['yosan']), '</td>';
        echo '<tr>';
    }
?> 
</table>
    <button onclick="location.href='store-info.php'">店舗一覧へ</button>
    </body>
</html>
