<?php

  class RegisterUser {

      private $db_conn;

      public function __construct($con)
      {
          $this->db_conn = $con;
      }
  

     public function getRegisters()
      {
        try {
            $query = $this->db_conn->query("SELECT * FROM register");
                  
            return $query->fetchAll(PDO::FETCH_ASSOC);
            
       } catch (PDOException $e) {
          return $e->getMessage();
      }
    }

    public function totalRegister()
    {
      try {
          return $query = $this->db_conn->query("SELECT count(*) FROM register")->fetchColumn();
          
     } catch (PDOException $e) {
        return $e->getMessage();
    }
  }

    public function getRegister($id)
    {
      try {
         $query = $this->db_conn->prepare("SELECT * FROM register WHERE id=:id");
        
         $query->execute(['id' => $id]);
                
          return $query->fetchAll(PDO::FETCH_ASSOC);
          
     } catch (PDOException $e) {
        return $e->getMessage();
    }
  }

    public function deleteSelectedRegister($id)
    {
      try {
          $query = $this->db_conn->prepare("DELETE FROM register WHERE id=:id")->execute(['id' => $id]);
                    
     } catch (PDOException $e) {
        return $e->getMessage();
    }
  }

  	public function register($userName, $email, $userType, $password) {
  		try {
  				$query = $this->db_conn->prepare("INSERT INTO register(username, usertype, email, password) VALUES(:username, :usertype, :email, :password)");
		  		$values = [
            'username' => $userName,
            'usertype' => $userType, 
            'email' => $email,
            'password' => $password
          ];
		  		$query->execute($values);
		  		$getLastIdInserted = $this->db_conn->lastInsertId();
          return $getLastIdInserted;
  			
  		} catch (PDOException $e) {
  			return $e->getMessage();
  		}

  	}
      public function updateRegister($id, $username, $usertype, $email, $password){
        try {
        $query = $this->db_conn->prepare("Update register SET username=:username, usertype=:usertype, email=:email, password=:password WHERE id=:id");
        $query->execute([
          'id' => $id,
          'username' => $username,
          'usertype' => $usertype,
          'email' => $email,
          'password' => $password
        ]);
        return $query->rowCount();
        } catch (PDOException $e) {
          return $e->getMessage();
        }
    }

    public function Login($email, $password){
        try {
        $query = $this->db_conn->prepare("SELECT * FROM register WHERE email=:email AND password=:password");
        $query->execute([
          'email' => $email,
          'password' => $password
        ]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          return $e->getMessage();
        }
    }
    
  }
