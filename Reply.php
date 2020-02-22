<?php

namespace MyApp\Controller;

class Reply extends \MyApp\Controller
{
    public $errors = array();

    public function run()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') { // GET判断
            $topicsModel = new \MyApp\Model\Topic();  // 返信先トピックを取得
            $this->setTopics('topicUserReplyTo', $topicsModel->findTopicWhoseIdMatch($_GET['idOfTopicUserReplyTo']));
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // POSTされたか
            if ($this->checkMessage()) {
                $this->addMessage();
            }
        }
    }

    private function checkMessage()
    {
        if (isset($_POST["title"]) && isset($_POST["u_name"])) { // 名前はnullでないか
            $u_name = $_POST["u_name"];
        } else {
            return false;
        }

        if (isset($_POST["u_content"]) && isset($_POST["password"])) { // 投稿内容とパスワードはnullでないか
            $u_content = $_POST["u_content"];
            $password = $_POST["password"];
        } else {
            return false;
        }

        if ($u_name === "") {
            $this->errors[] = "名前を入力して下さい。";
            return false;
        } elseif (mb_strlen($u_name) > 10) {
            $this->errors[] = "名前は10文字以内です。";
            return false;
        }

        if ($u_content === "") {
            $this->errors[] = "投稿内容を入力して下さい。";
            return false;
        } elseif (mb_strlen($u_content) > 150) {
            $this->errors[] = "投稿内容は150文字以内です。";
            return false;
        }

        if ($password === "") {
            $this->errors[] = "パスワードを入力して下さい。";
            return false;
        } elseif (!(preg_match("/^[a-zA-Z0-9]+$/", $password))) {
            $this->errors[] = "パスワードは半角英数字のみです。";
            return false;
        } elseif (mb_strlen($password) < 8 || mb_strlen($password) > 15) {
            $this->errors[] = "パスワードは8字以上15文字以内です。";
            return false;
        }

        return true;
    }

    private function addMessage() // メッセージの作成
    {
        $messageModel = new \MyApp\Model\Message();
        $messageModel->create([
          'belong_to' => $_POST['belong_to'],
          'u_name' => $_POST['u_name'],
          'u_content' => $_POST['u_content'],
          'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
          'first' => 0
        ]);

        header('Location: http://' . SITE_URL);
        exit;
    }
}
