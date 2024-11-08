<?php
class User
{
    private $szemelyid;
    private $nev;

    private $db;

    function __construct()
    {
        $this->db = new DataBase();
    }

    public function Login($username, $password)
    {
        $sql = 'SELECT * FROM users WHERE username ="' . $username . '"';
        $result = $this->db->dbSelect($sql);

        //Check if we have this user
        if ($result && count($result) > 0) {
            $row = $result[0];

            //check password
            if($row['password'] == md5($password)) 
            {
                $_SESSION["name"] = $row['username'];
                $_SESSION["id"] = $row['id'];
                $_SESSION["email"] = $row['email'];
                return true;
            } else {
                return "Password is Incorrect   ";
            }
        } else {
            return "User is not Exists ";
        }
    }


    public function register($username, $password, $email)
    {
        /* // Check password complexity
        if (strlen($password) < 8 ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[0-9]/', $password) ||
            !preg_match('/[^a-zA-Z0-9]/', $password)) {
            // Password doesn't meet complexity requirements
            return "Password must be at least 8 characters long and contain at least one uppercase letter, one number, and one special character.";
        } */

        // Check if user already exists
        $check = $this->db->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        if (!$check) {
            return "Error: " . $this->db->error;
        }
        $check->bind_param("ss", $username, $email);
        $check->execute();
        $result = $check->get_result();
        if ($result->num_rows > 0) {
            return "Username or email already taken!";
        }

        // Prepare the query
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, wallet) VALUES (?, ?, ?, ?)");
        // Check if the prepare statement failed
        if (!$stmt) {
            return "Error: " . $this->db->error;
        }
        //need a hashed password because he wil cry  for it later
        $hashed_password = md5($password);
        $walett_default = 100;

        // Bind the parameters
        $stmt->bind_param("sssi", $username, $email, $hashed_password, $walett_default);

        // Execute the query
        if ($stmt->execute()) {
            $_SESSION["name"] = $username;
            $_SESSION["id"] = $stmt->insert_id;
            $_SESSION["email"] = $email;
            //$_SESSION["wallet"] = 100;
            //$_SESSION["Jog"] = "user";
            header('location: Pixel-Casino/index.php');
            exit();
        } else {
            return "Error: " . $stmt->error;
        }
    }
}
?>