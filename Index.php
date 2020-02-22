<?php

namespace MyApp\Controller;

class Index extends \MyApp\Controller
{
    public $errors = array();

    public function run()
    {
        $topicsModel = new \MyApp\Model\Topic();  //トピックテーブルから全件取得
        $this->setTopics('topics', $topicsModel->findAllTopics());

        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // POSTされたか
            if ($this->checkTopic()) {
                $this->addTopic();
            }
        }
    }

    private function checkTopic()
    {
        if (isset($_POST["title"]) && isset($_POST["u_name"])) { // タイトルと名前はnullでないか
            $title = $_POST["title"];
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

        if ($title === "") {
            $this->errors[] = "トピックタイトルを入力して下さい。";
            return false;
        } elseif (mb_strlen($title) > 20) {
            $this->errors[] = "トピックタイトルは20文字以内です。";
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

    private function addTopic() // トピックの作成
    {
        $topicModel = new \MyApp\Model\Topic();
        $topicModel->create([
        'title' => $_POST['title']
      ]);

        $belong_to = $topicModel->getLatestIdOfTopic();
    
        $messageModel = new \MyApp\Model\Message(); // 一つ目のレスを作成
        $messageModel->create([
          'belong_to' => $belong_to,
          'u_name' => $_POST['u_name'],
          'u_content' => $_POST['u_content'],
          'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
          'first' => 1
        ]);

        header('Location: http://' . SITE_URL);
        exit;
    }
}
