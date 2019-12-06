<?php

namespace MyApp\Model;

class Message extends \MyApp\Model
{
    public function create($values)
    {
        $stmt = $this->db->prepare("insert into messages (belong_to, u_name, 
        u_content, password, first, created)
        values (:belong_to, :u_name, :u_content, :password, :first, now())");
        $stmt->execute([
          ':belong_to' => $values['belong_to'],
          ':u_name' => $values['u_name'],
          ':u_content' => $values['u_content'],
          ':password' => $values['password'],
          ':first' => $values['first']
        ]);
    }

    public function findMessagesMatch($topicId)
    {
        $stmt = $this->db->prepare("select * from messages where belong_to = :topicId order by id");
        $stmt->execute([':topicId' => $topicId]);
        $result = $stmt->fetchAll();
        return $result;
    }
}
