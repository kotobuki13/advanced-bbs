<?php

// トップ画面
require_once(__DIR__ . '/../settings/config.php');

$app = new MyApp\Controller\Reply();
$app->run();

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reply - Advanced BBS</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <h1>
    <a class="linkToTop" href="./index.php">Advanced BBS</a>
  </h1>
  <div class="post">
    <ul>
      <li>
        <?php $topic = $app->getTopics()->topicUserReplyTo; ?>
        <span class="topicTitle"><?= h($topic['title']); ?></span>
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
    </ul>
  </div>

  <!-- トッピク返信フォーム -->
  <form action="" method="POST" class="formToReply">
    <input type="hidden" name="belong_to"
      value="<?= h($topic['id']); ?>">
    <span class="inputLabel">名前</span>
    <input type="text" name="u_name" placeholder="10字以内" size="20">
    <span class="inputLabel">返信内容</span>
    <textarea name="u_content" placeholder="150字以内" cols="40" rows="6"></textarea>
    <span class="inputLabel">削除用パスワード</span>
    <input type="password" name="password" placeholder="8字以上15字以内" size="15">
    <input type="submit" class="btn" name="add" value="返信する">
  </form>

</body>

</html>