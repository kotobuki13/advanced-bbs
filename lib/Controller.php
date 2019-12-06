<?php

namespace MyApp;

class Controller
{
    private $_valueOfTopics;

    public function __construct()
    {
        $this->_valueOfTopics = new \stdClass();
    }

    protected function setTopics($key, $topics)  // 全トピックをセット
    {
        $this->_valueOfTopics->$key = $topics;
    }

    public function getTopics()
    {
        return $this->_valueOfTopics; // _$valueOfTopics = {:topics($key) => {{:title => x, :created => y}, {:title => α, :created => β} ... }};
    }
}
