<?php

class User
{
    public function __construct($username = null, $password = null, $email = null)
    {
        $this->id = NULL;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }

    public static function changePassword($conn, $userId, $oldPassword, $newPassword)
    {
        $sql = "SELECT * FROM user WHERE id='$userId' AND password='$oldPassword'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $sql = "UPDATE user SET password='$newPassword' WHERE id='$userId'";
            echo $sql;
            $result = $conn->query($sql);

            if ($result === TRUE) {
                return '';
            } else {
                return $conn->error;
            }
        } else {
            return "Pogrešna stara šifra";
        }
    }

    function register($conn)
    {
        $sql = "INSERT INTO user VALUES (NULL, '$this->username', '$this->password', '$this->email')";

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
            $this->email = $user['email'];
            return true;
        } else {
            return false;
        }
    }
}
