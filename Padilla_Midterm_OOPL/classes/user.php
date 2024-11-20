<?php

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE user_name = ? LIMIT 1");
        $stmt->bind_param("s", $username);  
        $stmt->execute();
        $result = $stmt->get_result();

        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            
            if ($password === $user['password']) {
                return $user;  
            }
        }

        return false;  
    }
}
?>
