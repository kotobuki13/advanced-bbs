<?php

// トップ画面
require_once(__DIR__ . '/../config/config.php');

$app = new MyApp\Controller\Index();
$app->run();

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Top - Advanced BBS</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>

  <h1>Advanced BBS</h1>
  <!-- トッピク投稿フォーム -->
  <form action="" method="POST">
    <span class="inputLabel">名前</span>
    <input type="text" name="u_name" placeholder="10字以内" size="20">
    <span class="inputLabel">トピックタイトル</span>
    <input type="text" name="title" placeholder="20字以内" size="40">
    <span class="inputLabel">投稿内容</span>
    <textarea name="u_content" placeholder="150字以内" cols="40" rows="6"></textarea>
    <span class="inputLabel">削除用パスワード</span>
    <input type="password" name="password" placeholder="8字以上15字以内" size="15">
    <input type="submit" class="btn" name="add" value="投稿する">
  </form>

  <h2>Topics</h2>
  <!-- トピック一覧 -->
  <div class="posts">
    <ul>
      <?php foreach ($app->getTopics()->topics as $topic) : ?>
      <li>
        <?= h($topic['title']); ?>
        <!-- 返信ボタン -->
        <form class="buttonToReply" method="GET" action="./reply.php">
          <input type="hidden" name="idOfTopicUserReplyTo"
            value="<?= h($topic['id']); ?>">
          <input type="submit" value="返信">
        </form>
        <ul>
          <?php foreach ($app->getMessages($topic['id']) as $message) : ?>
          <li>
            <?= h($message['u_content']); ?> from
            <?= h($message['u_name']); ?>　
            ( <?= h($message['created']); ?> )
          </li>
          <?php endforeach; ?>
        </ul>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>


</body>

</html>