<?php

namespace MyApp\Controller;

class Index extends \MyApp\Controller
{
    public function run()
    {
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

        // $messageModel = new \MyApp\Model\Message(); // 一つ目のレスを作成
        // $messageModel->create([
        //   'belong_to' => $belong_to,
        //   'u_name' => $_POST['u_name'],
        //   'u_content' => $_POST['u_content'],
        //   'password' => $_POST['password'],
        //   'first' => true
        // ]);

        header('Location: http://' . SITE_URL);
        exit;
    }
}
