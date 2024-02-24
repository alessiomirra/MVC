<?php
namespace App\Models;

use PDO;

class User
{
    public function __construct(protected PDO $conn) {
        
    }

    function delete(int $id)
    {

        /**
         * @var $conn mysqli
         */
        $conn = $GLOBALS['mysqli'];

        $sql = 'DELETE FROM users WHERE id =' . $id;

        $res = $conn->query($sql);
        return $res && $conn->affected_rows;
    }

    function getUser(int $id)
    {

        /**
         * @var $conn mysqli
         */
        $conn = $GLOBALS['mysqli'];
        $result = [];
        $sql = 'SELECT *  FROM users WHERE id =' . $id;
        // echo $sql;

        $res = $conn->query($sql);
        if ($res && $res->num_rows) {
            $result = $res->fetch_assoc();
        }
        return $result;
    }

   public function getUserByEmail(string $email): object
    {


        $result = new \stdClass();
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email) {
            return $result;
        }


        $sql = 'SELECT *  FROM users WHERE email = :email';
          //echo $sql.$email;

        $stm = $this->conn->prepare($sql);

        $res = $stm->execute(['email' => $email]);
 
        if ($res && $stm->rowCount()) {

            $result = $stm->fetch();

        }
      
        return $result;
    }


   

    function saveUser(array $data){

        


        $result = [
            'id' => 0,
            'success' => false,
            'message' => 'PROBLEM SAVING USER',

        ] ;



        $sql = 'INSERT INTO users (username, email, password, roletype) ';
        $sql .= " VALUES(:username, :email,:password, :roletype)";
         
        $stm = $this->conn->prepare($sql);

        if($stm) {
            $res = $stm->execute([
                'username'=> $data['username'],
                'email'=> $data['email'],
               'password'=> $data['password'],
                'roletype' => $data['roletype'] ?? 'user'

            ]);
            if($res){
                $result['success']  = 1;
                $result['id'] = $this->conn->lastInsertId();
                $result['message'] = 'USER CREATED CORRECTLY';

            } else {
                $result['success']  = $this->conn->errorInfo();;
            }
        } else {
            $result['message'] = $this->conn->errorInfo();
        }
        return  $result;
    }

   

}