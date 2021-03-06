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

    public function delete($values)
    {
        $stmt = $this->db->prepare("delete from topics where id = :topicIdMessageBelongTo");
        $stmt->execute([
                ':topicIdMessageBelongTo' => $values['id']
            ]);
    }

    public function getLatestIdOfTopic()
    {
        $stmt = $this->db->prepare("select id from topics order by id desc limit 1");
        $stmt->execute();
        $result = $stmt->fetch(); // $result = { :id => x };
        return $result[0];
    }

    public function findAllTopics()
    {
        $stmt = $this->db->prepare("select * from topics order by id desc");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function findTopicWhoseIdMatch($topicId)
    {
        $stmt = $this->db->prepare("select * from topics where id = :topicId");
        $stmt->execute([':topicId' => $topicId]);
        $result = $stmt->fetch(); // $result = { :id => x, :title => y};
        return $result;
    }
}
