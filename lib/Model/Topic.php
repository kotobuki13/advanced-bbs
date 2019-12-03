<?php

namespace MyApp\Model;

class Topic extends \MyApp\Model
{
    public function create($values)
    {
        $stmt = $this->db->prepare("insert into topics (title, created)
  values (:title, now())");

        if ($values['title'] === "") {
            $values['title'] = "無題";
        }
        $stmt->execute([
          ':title' => $values['title']
        ]);
    }
}
