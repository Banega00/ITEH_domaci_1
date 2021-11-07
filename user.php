<?php

class User
{
    public function __construct($username = null, $password = null)
    {
        $this->id = NULL;
        $this->username = $username;
        $this->password = $password;
    }

    function login($conn)
    {
        $sql = "SELECT * FROM user WHERE username='$this->username' AND password='$this->password'";

        echo $sql;
        $result = $conn->query($sql);

        if ($result) {
            $user = $result->fetch_assoc();
            $this->id = $user['id'];
            return true;
        } else {
            return false;
        }
    }
}
