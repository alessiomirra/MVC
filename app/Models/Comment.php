<?php

namespace App\Models;

use PDO;

class Comment
{
    public string $comment = '';
    public string $datecreated = '';
    public string $email = '';

    public function __construct(protected PDO $conn)
    {
    }

    public function all(int $postid): array
    {
        $result = [];
        $sql = 'select * from postscomments WHERE post_id=:postid ORDER BY datecreated DESC';
        $stm = $this->conn->prepare($sql);
        $stm->bindParam(':postid', $postid, PDO::PARAM_INT);

        if ($stm) {
            $stm->execute();
            $result = $stm->fetchAll();
        }

        return $result;
    }


    public function save(array $comment, int $postid): bool
    {
        $ret = false;

        $sql = 'INSERT INTO  postscomments ( post_id,  email, comment,datecreated) values ';
        $sql .= ' (:postid,  :email, :comment,NOW())';

        $stm = $this->conn->prepare($sql);

        if ($stm) {
            $res = $stm->execute([
                'postid' => $postid,
                'email' => $comment['email'],
                'comment' => $comment['comment']  
            ]);

            return $stm->rowCount();
        }
         
        return $ret;
    }

    public function delete(int $commentid): int
    {
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
