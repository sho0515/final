<?php
    require 'db-connect.php'
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>店舗情報更新</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
    <table>
    <tr><th>店舗番号</th><th>店舗名</th><th>カテゴリ</th><th>予算目安</th><th>更新</th></tr>
<?php
    $pdo=new PDO($connect, USER, PASS);
	$sql=$pdo->prepare('SELECT store.store_id, store.name, Category.category, store.yosan
    FROM store
    LEFT JOIN Category ON store.c_id = Category.c_id where store_id=?');
	$sql->execute([$_POST['store_id']]);

	foreach ($sql as $row) {
        echo '<tr>';
		echo '<form action="store-edit-output.php" method="post">';
        echo '<td> ';
		echo  $row['store_id'] ;
		echo '</td> ';
		echo '<td>';
		echo '<input type="text" name="name" value="', $row['name'], '">';
		echo '</td> ';
        echo '<td>';
		echo '<input type="text" name="category" value="', $row['category'], '">';
		echo '</td> ';
		echo '<td>';
		echo ' <input type="text" name="yosan" value="', $row['yosan'], '">';
		echo '</td> ';
		echo '<td><input type="submit" value="更新"></td>';
		echo '</form>';
        echo '</tr>';
		echo "\n";
	}
?>
</table>
<button onclick="location.href='store-info.php'">店舗一覧へ</button>
    </body>
</html>