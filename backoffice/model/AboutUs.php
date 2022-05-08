<?php

  class AboutUs {

      private $db_conn;

      public function __construct($con)
      {
          $this->db_conn = $con;
      }

    public function getAboutUsDetail($id)
    {
      try {
          $query = $this->db_conn->prepare("SELECT * FROM aboutus where id=:id");

          $query->execute(['id' => $id]);
                
          return $query->fetchAll(PDO::FETCH_ASSOC);
          
     } catch (PDOException $e) {
        return $e->getMessage();
    }
  }


  public function getAboutUs()
  {
    try {
        $query = $this->db_conn->query("SELECT * FROM aboutus");
              
        return $query->fetchAll(PDO::FETCH_ASSOC);
        
   } catch (PDOException $e) {
      return $e->getMessage();
  }
}

public function deleteAboutUs($id)
{
  try {
      $query = $this->db_conn->prepare("DELETE FROM aboutus WHERE id=:id")->execute(['id' => $id]);
                
 } catch (PDOException $e) {
    return $e->getMessage();
}
}

public function postAboutUs($title, $subtitle, $description, $link) {
  try {
      $query = $this->db_conn->prepare("INSERT INTO aboutus (title, subtitle, description, link) VALUES(:title, :subtitle, :description, :link)");
      $values = [
        'title' => $title,
        'subtitle' => $subtitle, 
        'description' => $description,
        'link' => $link
      ];
      $query->execute($values);
      $getLastIdInserted = $this->db_conn->lastInsertId();
      return $getLastIdInserted;
    
  } catch (PDOException $e) {
    return $e->getMessage();
  }

}
  public function updateRegister($id, $title, $subtitle, $description, $link){
    try {
    $query = $this->db_conn->prepare("Update aboutus SET title=:title, subtitle=:subtitle, description=:description, link=:link WHERE id=:id");
    $query->execute([
      'id' => $id,
      'title' => $title,
      'subtitle' => $subtitle,
      'description' => $description,
      'link' => $link
    ]);
    return $query->rowCount();
    } catch (PDOException $e) {
      return $e->getMessage();
    }
}
    
  }
