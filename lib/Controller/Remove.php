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
    }
}
