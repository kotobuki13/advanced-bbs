<?php

namespace MyApp\Controller;

class Reply extends \MyApp\Controller
{
    public function run()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') { // GET判断
            $topicsModel = new \MyApp\Model\Topic();  // 返信先トピックを取得
            $this->setTopics('topicUserReplyTo', $topicsModel->findTopicWhoseIdMatch($_GET['idOfTopicUserReplyTo']));
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // POSTされたか
            $this->addMessage($_POST['belong_to']);
        }
    }

    private function addMessage($topicId) // メッセージの作成
    {
        $messageModel = new \MyApp\Model\Message();
        $messageModel->create([
          'belong_to' => $topicId,
          'u_name' => $_POST['u_name'],
          'u_content' => $_POST['u_content'],
          'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
          'first' => 0
        ]);

        header('Location: http://' . SITE_URL);
        exit;
    }
}
