<!DOCTYPE html>
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
            text-align: center; /* Center text in the body */
        }

        h1 {
            font-size: 24px;
            color: #ac1874;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            text-align: left; /* Align form elements to the left */
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #af4c82;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .back-button {
            margin-top: 10px;
            text-align: left;
        }

        .back-button button {
            background-color: #af4c82;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 3px;
            cursor: pointer;
        }

        .back-button button:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <h1>店舗情報を追加します</h1>
    <form action="store-insert-output.php" method="post">
        <label for="store_id">店舗番号</label>
        <input type="text" id="store_id" name="store_id">

        <label for="name">店舗名</label>
        <input type="text" id="name" name="name">

        <label for="category">カテゴリ</label>
        <input type="text" id="category" name="category">

        <label for="yosan">予算目安</label>
        <input type="text" id="yosan" name="yosan">

        <div style="text-align: center;"> <!-- Center the button -->
            <button type="submit">追加</button>
        </div>
    </form>

    <div class="back-button">
        <button onclick="location.href='store-info.php'">店舗一覧へ</button>
    </div>
</body>

</html>
