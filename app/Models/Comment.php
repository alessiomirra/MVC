<?php

namespace App\Models;

use PDO;

class Comment {

    public string $comment = '';
    public string $datecreated = '';
    public string $email = '';

    public function __construct(protected PDO $conn) {
        
    }

    public function all(int $postid): array {
        $result = [];
    $sql ='select p.*, u.email as user_email from postscomments as p  LEFT JOIN users as u ';
         $sql .= ' on p.user_id = u.id where post_id=:postid ORDER BY datecreated DESC';
         
         $stm = $this->conn->prepare($sql);
        $stm->bindParam(':postid', $postid, PDO::PARAM_INT);

        if ($stm) {
            $stm->execute();
            $result = $stm->fetchAll();
        }

        return $result;
    }

    public function save(array $comment): bool {
        $ret = false;

        $sql = 'INSERT INTO  postscomments (user_id,'
                . ' post_id,  email, comment,datecreated) values ';
        $sql .= ' (:user_id, :post_id,  :email, :comment,NOW())';

        $stm = $this->conn->prepare($sql);

        if ($stm) {
            $res = $stm->execute([
                'user_id' => $comment['user_id'],
                'post_id' => $comment['post_id'],
                'email' => $comment['email'],
                'comment' => $comment['comment']
                    ]
            );

            return $stm->rowCount();
        }

        return $ret;
    }

    public function delete(int $commentid): int {
        $ret = 0;

        $sql = 'DELETE FROM  postscomments  ';
        $sql .= ' where id = :commentid';

        $stm = $this->conn->prepare($sql);

        if ($stm) {
            $stm->bindParam('commentid', $commentid, PDO::PARAM_INT);

            $res = $stm->execute();

            return $stm->rowCount();
        }
        return $ret;
    }

}
