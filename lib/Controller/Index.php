<?php

namespace MyApp\Controller;

class Index extends \MyApp\Controller
{
    public function run()
    {
        $topicsModel = new \MyApp\Model\Topic();  //トピックテーブルから全件取得
        $this->setTopics('topics', $topicsModel->findAllTopics());

        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // POSTされたか
            $this->addTopic();
        }
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
