<?php

class Bets {

    private $id;
    private $user_id;
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
    
    public function createBet($user_id, $bet_amount){
        $query = "INSERT INTO bets (user_id, bet_amount, created_at) VALUES (:user_id, :bet_amount, NOW())";
        $params = array(
            ':user_id' => $user_id,
            ':bet_amount' => $bet_amount
        );
        return $this->getId();
    }

    public function checkBet($user_id){

        $sql = 'SELECT `wallet` FROM users WHERE id ="' . $user_id . '"';
        
        //$sth = $dbh->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        //$sth->execute([':id' => $id]);
        //$users = $sth->fetchAll();

        
    }

}

?>