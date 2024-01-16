<?php
    require 'db-connect.php'
?>

<DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>店舗情報登録</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #f8f8f8;
            color: #333;
        }

        p {
            font-size: 18px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
            max-width: 400px; /* Set a maximum width for better readability */
            margin-left: auto;
            margin-right: auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc; /* Add a border for better visibility */
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .back-button {
            margin-top: 10px;
        }

        .back-button button {
            background-color: #3498db;
        }

        .back-button button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>  
    <p>店舗情報を追加します</p>
    <form action="store-insert-output.php" method="post">
        店舗番号<input type="text" name="store_id"><br>
        店舗名<input type="text" name="name"><br>
        カテゴリ<input type="text" name="category"><br>
        予算目安<input type="text" name="yosan"><br>
        <button type="submit">追加</button>
    </form>


    <button onclick="location.href='store-info.php'">店舗一覧へ</button>
</body>
</html>