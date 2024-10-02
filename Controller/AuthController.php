<?php
require_once 'Model/db-inc.php';
require_once 'Model/user.php';
class AuthController
{
  public function registration()
  {

    require_once 'View/layout/navbar.php';
    require_once 'View/Auth/registration.php';
  }

}

class UserRegister
{


  private $user;
  private $db;

  function __construct()
  {
    $this->db = new DataBase();
    $this->user = new User();
  }

  function register()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $username = $_POST["name"];
      $email = $_POST["email"];
      $password = $_POST["password"];

      // check if required fields are empty
      if (empty($username) || empty($email) || empty($password)) {
        header('Location: /benjamin/register');
        return;
      }

      /* // check if email address contains '@'
      if (strpos($email, '@') === false) {
          $_SESSION['message'] = "Invalid email address";
          header('Location: /benjamin/register');
          return;
      } */

      /* // sanitize the inputs
      $username = filter_var($username, FILTER_SANITIZE_STRING);
      $email = filter_var($email, FILTER_SANITIZE_EMAIL);
      $password = filter_var($password, FILTER_SANITIZE_STRING);
*/
      // register the user
      $result = $this->user->register($username, $password, $email);
      if ($result === true) {
        header('Location: /benjamin/index.php');
      } else {
        $_SESSION['message'] = $result;
        header('Location: /benjamin/register');
      }
    } else {
      header('Location: /benjamin/register');
    }
  }

}

class UserLogin
{
  private $user;
  private $db;

  function __construct()
  {
    $this->db = new DataBase();
    $this->user = new User();
  }

  function login()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $email = $_POST["email"];
      $password = $_POST["password"];

      // check if required fields are empty
      if (empty($email) || empty($password)) {
        header('Location: /benjamin/login');
        return;
      }

      // sanitize the inputs
      $email = filter_var($email, FILTER_SANITIZE_EMAIL);

      // login the user
      $result = $this->user->login($email, $password);
      if ($result === true) {
        header('Location: /benjamin/index.php');
      } else {
        $_SESSION['message'] = $result;
        header('Location: /benjamin/login');
      }
    } else {
      header('Location: /benjamin/login');
    }

  }
}


?>