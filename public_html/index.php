<?php

// トップ画面
require_once(__DIR__ . '/../config/config.php');

$app = new MyApp\Controller\Index();


?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Advanced BBS</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>

  <h1>Advanced BBS</h1>
  <!-- トッピク投稿フォーム -->
  <form action="./index.php" method="POST" id="postMessage">
    <span class="inputLabel">名前</span>
    <input type="text" name="u_name" placeholder="１０字以内" size="20">
    <span class="inputLabel">投稿内容</span>
    <textarea name="content" placeholder="１５０字以内" cols="40" rows="6"></textarea>
    <input type="submit" class="btn" name="add" value="投稿する">
  </form>

  <h2>Topics</h2>

</body>

</html>