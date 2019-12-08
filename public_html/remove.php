<?php

// メッセージ削除画面
require_once(__DIR__ . '/../settings/config.php');

$app = new MyApp\Controller\Remove();
$app->run();

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Delete - Advanced BBS</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <h1>
    <a class="linkToTop" href="./index.php">Advanced BBS</a>
  </h1>
  <div class="message">
    <ul>
      <?php $message = $app->getOneMessage()->messageUserRemove ;?>
      <li>
        <?= h($message['u_content']); ?> from
        <?= h($message['u_name']); ?>　
        ( <?= h($message['created']); ?> )
      </li>
    </ul>
  </div>

  <!-- メッセージ削除フォーム -->
  <form action="" method="POST" class="formToRemove">
    <input type="hidden" name="messageId"
      value="<?= h($message['id']); ?>">
    <input type="hidden" name="topicIdMessageBelongTo"
      value="<?= h($message['belong_to']); ?>">
    <input type="hidden" name="messageFirstFlg"
      value="<?= h($message['first']); ?>">
    <span class="inputLabel">削除用パスワード</span>
    <input type="password" name="password" placeholder="8字以上15字以内" size="15">
    <input type="submit" class="btn" name="remove" value="削除する">
  </form>

</body>

</html>