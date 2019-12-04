<?php

namespace MyApp\Model;

class Topic extends \MyApp\Model
{
    public function create($values)
    {
        $stmt = $this->db->prepare("insert into topics (title, created)
  values (:title, now())");
        $stmt->execute([
          ':title' => $values['title']
        ]);
    }
    public function getLatestIdOfTopic()
    {
        $stmt = $this->db->prepare("select id from topics order by id desc limit 1");
        $stmt->execute();
        $result = $stmt->fetch(); // $result = { id => x, id => y};
        return $result[0];
    }
}
