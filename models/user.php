<?php

class User
{
    public function __construct($username = null, $password = null)
    {
        $this->id = NULL;
        $this->username = $username;
        $this->password = $password;
    }

    function register($conn)
    {
        $sql = "INSERT INTO user VALUES (NULL, '$this->username', '$this->password')";

        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return $conn->error;
        }
    }

    function login($conn)
    {
        $sql = "SELECT * FROM user WHERE username='$this->username' AND password='$this->password'";

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            var_dump($user);
            $this->id = $user['id'];
            return true;
        } else {
            return false;
        }
    }
}