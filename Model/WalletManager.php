<?php
session_start();

class WalletManager
{
    private $conn;


    public function __construct($conn){
        $this->conn = $conn;
    }


    public function getWalletBalance($userId){
        $sql = "UPDATE users WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->execute();
    }

    public function withdrawFunds($amount){
        $sql = "UPDATE users SET balance = balance - $amount WHERE user_id = :user_id AND balance >= :amount";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->bindParam(':amount', $amount);
        $stmt->execute();
    }
}

?>