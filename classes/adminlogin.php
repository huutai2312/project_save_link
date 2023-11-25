<?php
include "config/session.php";
Session::checkLogin();
include "config/database.php";
include "helpers/format.php";
?>

<?php
class adminlogin
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function login_admin($username, $password, $token)
    {
        $username = $this->fm->validation($username);
        $password = $this->fm->validation($password);
        $token = $this->fm->validation($token);

        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);
        $token = mysqli_real_escape_string($this->db->link, $token);

        if ($username == '' || $password == '' || $token == '') {
            $alert = '<p style="color: red;">Please Input Username || Password || Token</p>';
        } else {
            // $password = md5($password);
            $query = "SELECT * FROM user WHERE username = '$username' LIMIT 1";
            $result = $this->db->select($query);

            if ($result != false) {
                $value = $result->fetch_assoc();
                // Thay đổi dòng sau để sử dụng password_verify
                if (password_verify($password, $value['password']) && password_verify($token, $value['token'])) {
                    Session::set('adminlogin', true);
                    Session::set('id', $value['id']);
                    Session::set('username', $value['username']);
                    Session::set('email', $value['email']);
                    Session::set('name', $value['name']);
                    header('Location:./');
                } else {
                    $alert = '<p style="color: red;">Username || Pass || Token wrong</p>';
                    return $alert;
                }
            } else {
                $alert = '<p style="color: red;">Username || Pass || Token wrong</p>';
                return $alert;
            }
        }
    }
}


?>