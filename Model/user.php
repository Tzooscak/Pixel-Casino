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
        $check = $this->db->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
        if (!$check) {
            return "Error: Hiba történt az előkészítés során.";
        }
        $check->bindValue(":username", $username);
        $check->bindValue(":email", $email);
        $check->execute();

        $result = $check->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            return "Felhasználónév vagy email már használatban van!";
        }

        $hashed_password = md5($password);
        $wallet_default = 100;

        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, wallet) VALUES (:username, :email, :password, :wallet)");
        if (!$stmt) {
            return "Error: Hiba történt az előkészítés során.";
        }

        $stmt->bindValue(":username", $username);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":password", $hashed_password);
        $stmt->bindValue(":wallet", $wallet_default, PDO::PARAM_INT);

        if ($stmt->execute()) {
        
            $_SESSION["name"] = $username;
            $_SESSION["id"] = $this->db->conn->lastInsertId();
            $_SESSION["email"] = $email;
            header('Location: Pixel-Casino/index.php');
            exit();
        } else {
            return "Error: Hiba történt a regisztráció során: " . $stmt->errorInfo()[2];
        }
    }

}
?>