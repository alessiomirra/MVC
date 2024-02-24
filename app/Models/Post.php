<?php

namespace App\Models;

use PDO;

class Post {

    public function __construct(protected PDO $conn) {
        
    }

    public function all(): array {

        $result = [];
   
        $sql = 'select p.* , u.email from posts as p  INNER JOIN users as u';
        $sql .= ' ON u.id=p.user_id ORDER BY p.datecreated DESC';
        $stm = $this->conn->query($sql);
        if ($stm && $stm->rowCount()) {
            $result = $stm->fetchAll();
        }

        return $result;
    }

    public function findByPostId(int $postId) {

        $ret = [];

        $sql = 'select p.* , u.email from posts  as p  INNER JOIN users as u';
        $sql .= ' ON u.id=p.user_id where p.id = :id';
        
        $stm = $this->conn->prepare($sql);
        if ($stm) {

            $res = $stm->execute(['id' => $postId]);
            if ($res) {
                $ret = $stm->fetch();
            }
        }
        return $ret;
    }

    public function save(array $post): bool {

        $ret = false;

        $sql = 'INSERT INTO  posts (title, user_id, message,datecreated) values ';
        $sql .= ' (:title, :user_id, :message,NOW())';

        $stm = $this->conn->prepare($sql);
        
        if ($stm) {

            $res = $stm->execute([
                'title' => $post['title'],
                'user_id' => $post['user_id'],
                'message' => $post['email'],
               // 'datecreated' => date('Y-m-d H:i:s')
                    ]
            );

            return $stm->rowCount();
        }
        return $ret;
    }
     public function update(array $post, int $postid): bool {

        $ret = false;

        $sql = 'UPDATE posts SET title =:title , message=:message ';
        $sql .= ' where id = :postid';

        $stm = $this->conn->prepare($sql);
        
        if ($stm) {

            $res = $stm->execute([
                'title' => $post['title'],
                
                'message' => $post['message'],
                'postid' => $postid
                    ]
            );

            return $stm->rowCount();
        }
        return $ret;
    }
     public function delete( int $postid): int {

        $ret = 0;

        $sql = 'DELETE FROM  posts  ';
        $sql .= ' where id = :postid';

        $stm = $this->conn->prepare($sql);
        
        if ($stm) {
             $stm->bindParam('postid', $postid, PDO::PARAM_INT);

            $res = $stm->execute();

            return $stm->rowCount();
        }
        return $ret;
    }

}
