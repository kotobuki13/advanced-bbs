<?php

namespace MyApp\Controller;

class Remove extends \MyApp\Controller
{
    public function run()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') { // GET判断
            $messageModel = new \MyApp\Model\Message();  // 削除するメッセージを取得
            $this->setOneMessage(
                'messageUserRemove', // $key
                $messageModel->findMessageWhoseIdMatch($_GET['messageId']) // $value
            ); // $value = { :id => x, :title => y};
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // POSTされたか
            $this->verifyPassword();
        }
    }

    private function verifyPassword() // パスワードのチェック
    {
        $this->deleteMessage();
    }

    private function deleteMessage() // メッセージ削除処理
    {
        $messageModel = new \MyApp\Model\Message();
        $deleteTopicFlg = $messageModel->delete([
          'id' => $_POST['messageId'],
          'belong_to' => $_POST['topicIdMessageBelongTo'],
          'first' => (bool)$_POST['messageFirstFlg'] // 文字列として渡されたので、論理型に変換
        ]);

        if ($deleteTopicFlg === true) {
            $topicModel = new \MyApp\Model\Topic();
            $topicModel->delete([
              'id' => $_POST['topicIdMessageBelongTo']
            ]);
        }

        header('Location: http://' . SITE_URL);
        exit;
    }
}
