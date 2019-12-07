<?php

namespace MyApp;

class Controller
{
    private $_valueOfTopics;

    public function __construct()
    {
        $this->_valueOfTopics = new \stdClass();
    }

    protected function setTopics($key, $topics)  // トピックをセット
    {
        $this->_valueOfTopics->$key = $topics;
    }

    public function getTopics()
    {
        return $this->_valueOfTopics; // _$valueOfTopics = {:xxx($key) => {{:title => x, :created => y}, ... }};
    }

    public function getMessages($topicId)
    {
        $messageModel = new \MyApp\Model\Message();
        return $messageModel->findMessagesBelongTo($topicId);
    }
}
