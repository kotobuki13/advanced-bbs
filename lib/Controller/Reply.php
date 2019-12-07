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
    }
}
