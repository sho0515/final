<?php
    require 'db-connect.php'
?>

<!DOCTYPE html>
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

        $deletecategory_id=$pdo->prepare('select c_id from store where store_id=?');
        $deletecategory_id->execute([$_POST['store_id']]);
        $c_id=$deletecategory_id->fetch();
        $c_id['c_id'];

        $sql = $pdo->prepare('update store set name=?,c_id=?,yosan=? where store_id =?');
    if (empty($_POST['name'])) {
        echo '店舗名を入力してください。';
    } else if(empty($_POST['category'])) {
        echo 'カテゴリを入力してください。';
    }else if (!preg_match('/[0-9]+/', $_POST['yosan'])) {
        echo '予算目安を整数で入力してください。';
    } else if($sql->execute([htmlspecialchars($_POST['name']),$category_id,$_POST['yosan'],$_POST['store_id']])){
        //更新に成功しました　作成４
        echo '更新に成功しました。';
        

        $delete = $pdo->prepare('SELECT * FROM store WHERE c_id = ?');
        $delete->execute([$c_id['c_id']]);
        $count = $delete->rowCount();
        if($count==0){
            $deletecategory=$pdo->prepare('delete from Category where c_id=?');
            $deletecategory->execute([$c_id['c_id']]);
        }

    }else{
        echo '更新に失敗しました。';
    }
    
    
    
?>
        <hr>
        <table>
        <tr><th>店舗番号</th><th>店舗名</th><th>カテゴリ</th><th>予算目安</th></tr>

<?php
    foreach($pdo -> query('SELECT store.store_id, store.name, Category.category, store.yosan
    FROM store
    LEFT JOIN Category ON store.c_id = Category.c_id') as $row){
        echo '<tr>';
        echo '<td>', $row['store_id'], '</td>';
        echo '<td>', $row['name'], '</td>';
        echo '<td>', $row['category'], '</td>';
        echo '<td>￥', number_format($row['yosan']), '</td>';
        echo '</tr>';
        echo "\n";
    }
?>
    </table>
    <button onclick="location.href='store-info.php'">トップへ戻る</button>
</body>
</html>

