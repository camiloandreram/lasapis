<?php
class Database{

  //private $db_host = 'localhost';
  //private $db_name = 'api';
  //private $db_username = 'root';
  //private $db_password = '';

  private $db_host = 'bortyhechw94uvphcl3l-mysql.services.clever-cloud.com';
   private $db_name = 'bortyhechw94uvphcl3l';
   private $db_username = 'unbfrie2dg2kroud';
   private $db_password = 'XnBfbBM4xNW1Pxeakci4';

  public function dbConnection(){
    try{
      $conn = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name,$this->db_username,$this->db_password);
      $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conn;
    }
    catch(PDOException $e){
      echo "Connection error".$e->getMessage();
      exit;
    }
  }
}
?>
