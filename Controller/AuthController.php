<?php
require_once 'Model/db-inc.php';
require_once 'Model/user.php';
class AuthController
{
  public function registration()
  {

    require_once 'View/Auth/registration.php';
  }

  public function login()
  {

    require_once 'View/Auth/login.php';


  }

  public function logout(){

    session_start();
    
    
    session_unset();
    session_destroy();
    
    
    header('Location: /Pixel-Casino/');
    exit();

    
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
        header('location: Pixel-Casino/index.php');
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
        header('location: /Pixel-Casino/');
      } else {
        $_SESSION['message'] = $result;
        header('Location: /Pixel-Casino/register');
      }
    } else {
      header('Location: /Pixel-Casino/register');
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
      $name = $_POST["name"];
      $password = $_POST["password"];

      // check if required fields are empty
      if (empty($name) || empty($password)) {
        header('Location: /Pixel-Casino/index.php');
        return;
      }

      // sanitize the inputs
      $name = filter_var($name, FILTER_SANITIZE_EMAIL);

      // login the user
      $result = $this->user->Login($name, $password);
      echo $result;
      if ($result === true) {
        header('Location: /Pixel-Casino/');
      } else {
        $_SESSION['message'] = $result;
        header('Location: /Pixel-Casino/AuthLogin.php');
      }
    } else {
      header('Location: /Pixel-Casino/AuthLogin.php');
    }

  }
}


?>