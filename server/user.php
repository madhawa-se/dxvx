
<?php

require_once 'connection.php';

class User {

    public $db;

    public function __construct() {
        $con = new connection();
        $this->db = $con->getConnection();
    }

    public function register($email, $password, $phone) {

        $password = md5($password);
        if (true) {
            $sql1 = "INSERT INTO users SET email='$email', password='$password', phone='$phone'";
            $result = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno() . "Data cannot inserted");
            return $result;
        } else {
            return false;
        }
    }

    /*     * * for login process ** */

    public function check_login($emailusername, $password) {

        $password = md5($password);
        $sql2 = "SELECT uid from users WHERE uemail='$emailusername' or uname='$emailusername' and upass='$password'";

//checking if the username is available in the table
        $result = mysqli_query($this->db, $sql2);
        $user_data = mysqli_fetch_array($result);
        $count_row = $result->num_rows;

        if ($count_row == 1) {
// this login var will use for the session thing
            $_SESSION['login'] = true;
            $_SESSION['uid'] = $user_data['uid'];
            return true;
        } else {
            return false;
        }
    }

    /*     * * for showing the username or fullname ** */

    public function get_fullname($uid) {
        $sql3 = "SELECT fullname FROM users WHERE uid = $uid";
        $result = mysqli_query($this->db, $sql3);
        $user_data = mysqli_fetch_array($result);
        echo $user_data['fullname'];
    }

    /*     * * starting the session ** */

    public function get_session() {
        return $_SESSION['login'];
    }

    public function user_logout() {
        $_SESSION['login'] = FALSE;
        session_destroy();
    }

}

new User();
