<?php

class Fetch extends Basic{
    
    public function fetch_user($userid)
    {
      $sql= "SELECT * from users WHERE id=:id"; 
           $stmt = $this->dbConnection->prepare($sql);
           $stmt->bindParam(':id', $userid, PDO::PARAM_INT);
           $stmt->execute();
         $row = $stmt->fetch();
         return $row;
    }
  

}
