<?php

namespace MyApp;

class Controller
{
    private $_value;

    public function __construct()
    {
        $this->_value = new \stdClass();
    }

    protected function setTopics($key, $topics)  // トピックをセット
    {
        $this->_value->$key = $topics;
    }

    public function getTopics()
    {
        return $this->_value; // _$value = {:xxx($key) => {{:id => x, :title => y}, ... }};
    }

    public function getMessages($topicId)
    {
        $messageModel = new \MyApp\Model\Message();
        return $messageModel->findMessagesBelongTo($topicId);
    }

    protected function setOneMessage($key, $message)  // メッセージをセット
    {
        $this->_value->$key = $message; // $message = { :id => x, :belong_to => y};
    }

    public function getOneMessage()
    {
        return $this->_value; // _$value = {:xxx($key) => {{:id => x, :belong_to => y}, ... }};
    }
}
