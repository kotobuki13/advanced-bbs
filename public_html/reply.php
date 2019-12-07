<?php

// トップ画面
require_once(__DIR__ . '/../config/config.php');

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
  <h1>Advanced BBS</h1>
  <div class="post">
    <ul>
      <li>
        <?php $topic = $app->getTopics()->topicUserReplyTo; ?>
        <?= h($topic['title']); ?>
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

</body>

</html>