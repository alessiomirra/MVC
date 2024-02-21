<?php 

namespace App\Models; 

use PDO; 

class Post 
{
    public function __construct(protected PDO $conn)
    {
    }

    public function all() :array 
    {
        $result = [];
        $stm = $this->conn->query('select * from posts ORDER BY datecreated desc', PDO::FETCH_OBJ);

        if ($stm && $stm->rowCount()){
            $result = $stm->fetchAll();
        }

        return $result;
    }

    public function findByPostId(int $postId) {

        $ret = [];

        $sql = 'SELECT * FROM posts where id = :id';
        $stm = $this->conn->prepare($sql);
        if ($stm) {

            $res = $stm->execute(['id' => $postId]);
            if ($res) {
                $ret = $stm->fetch();
            }
        }
        return $ret;
    }

    public function save(array $post) :bool {

        $ret = false;

        $sql = 'INSERT INTO posts (title, email, message, datecreated) values ';
        $sql .= '(:title, :email, :message, NOW())';
        $stm = $this->conn->prepare($sql);
        if ($stm) {

            $res = $stm->execute([
                'title' => $post["title"], 
                'email' => $post["email"],
                'message' => $post["message"],
            ]);
            return $stm->rowCount();
        }
        return $ret;
    }

    public function update(array $post, int $postid) :bool {

        $ret = false;

        $sql = 'UPDATE posts SET title=:title, email=:email, message=:message ';
        $sql .= 'where id = :postid';
        $stm = $this->conn->prepare($sql);
        if ($stm) {

            $res = $stm->execute([
                'title' => $post["title"], 
                'email' => $post["email"],
                'message' => $post["message"],
                'postid' => $postid,
            ]);
            return $stm->rowCount();
        }
        return $ret;
    }

    public function delete(int $postid) :int {

        $ret = 0;

        $sql = 'DELETE FROM posts ';
        $sql .= 'where id = :postid';
        $stm = $this->conn->prepare($sql);
        if ($stm) {
            $stm->bindParam('postid', $postid, PDO::PARAM_INT);
            $res = $stm->execute();

            return $stm->rowCount();
        }
        return $ret;
    }
}