<?php

class Bets {

    private $id;
    private $user_id;
    private $game_id;
    private $bet_amount;
    private $result;
    private $created_at;
    private $db;

    function __construct()
    {
        $this->db = new DataBase();
    }

    public function getId(){
        return $this->id;
    }
    
    public function getUserId(){
        return $this->user_id;
    }
    
    public function getBetAmount(){
        return $this->bet_amount;
    }
    
    public function getResult(){
        return $this->result;
    }
    
    public function getCreatedAt(){
        return $this->created_at;
    }
    
    public function createBet($user_id, $game_id, $bet_amount) {
        if (!$this->checkBet($user_id, $bet_amount)) {
            return ['success' => false, 'message' => 'Insufficient funds'];
        }
    
        $query = "INSERT INTO bets (user_id, game_id, bet_amount, created_at) VALUES (:user_id, :game_id, :bet_amount, NOW())";
        $params = [
            ':user_id' => $user_id,
            ':game_id' => $game_id,
            ':bet_amount' => $bet_amount
        ];
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
    
            // Pénztárca frissítése
            $this->updateWallet($user_id, -$bet_amount, 'bet');
    
            return ['success' => true, 'message' => 'Bet placed successfully'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    

    public function updateResult($result) {
        $this->result = $result;
    }

    public function checkBet($user_id, $bet_amount) {
        $query = 'SELECT wallet FROM users WHERE id = :user_id';
        $stmt = $this->db->prepare($query);
        $stmt->execute([':user_id' => $user_id]);
        $wallet = $stmt->fetchColumn();
    
        return $wallet >= $bet_amount;
    }
    
    public function updateWallet($user_id, $amount, $type) {
        $query = "INSERT INTO transactions (user_id, amount, type, created_at) VALUES (:user_id, :amount, :type, NOW())";
        $params = array(
            ':user_id' => $user_id,
            ':amount' => $amount,
            ':type' => $type
        );
        $this->db->query($query, $params);
    
        $walletUpdateQuery = "UPDATE users SET wallet = wallet + :amount WHERE id = :user_id";
        $this->db->query($walletUpdateQuery, [':user_id' => $user_id, ':amount' => $amount]);
    }

    public function processResult($bet_id, $user_id, $result, $bet_amount) {
        $amount = 0;
        $type = 'lose';

        if ($result === 'win') {
            $amount = $bet_amount * 2;
            $type = 'win';
        } elseif ($result === 'draw') {
            $amount = $bet_amount;
            $type = 'draw';
        }
    
        try {
            $this->updateWallet($user_id, $amount, $type);
    
            $query = "UPDATE bets SET result = :result WHERE id = :bet_id";
            $params = [
                ':result' => $result,
                ':bet_id' => $bet_id
            ];
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
    
            return ['success' => true, 'message' => 'Result processed successfully'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    
    
    
}

?>