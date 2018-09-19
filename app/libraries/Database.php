<?php
  /*
   * PDO Database Class
   * Connect to database
   * Create prepared statements
   * Bind values
   * Return rows and results
   */
  class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $db_type = DB_TYPE;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
      // Set DSN
      switch ($this->db_type) {
        case 'mysql':
          $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
          break;
        case 'oracle':
          
          $tns = "lirr-bschdev.lirr.org:10100/ECRDEV";
          $dsn = 'oci:dbname='.$tns;
         // $dsn = $this->host;
          break;
        default:
          $dsn = $this->host;
          break;
      }
      
      $options = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );

      // Create PDO instance
      try{
        $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
      } catch(PDOException $e){
        $this->error = $e->getMessage();
        echo $this->error;
      }
     

     /* $conn = oci_connect("ecr2", "45ecR.77", "lirr-bschdev.lirr.org:10100/ECRDEV");
      if (!$conn) {
        $m = oci_error();
        echo $m['message'], "\n";
        exit;
      }
     $query = oci_parse($conn, "SELECT * FROM EHOST_INFO");
     oci_execute($query);
     $i=0;
     while (($row = oci_fetch_array($query, OCI_ASSOC)) != false) {
        echo "-----".$i."------";
        echo "<pre>";
        print_r($row);
        echo "<pre>";
        $i++;
     }*/
     
     

    }

    // Prepare statement with query
    public function query($sql){
      $this->stmt = $this->dbh->prepare($sql);
    }



    // Bind values
    public function bind($param, $value, $type = null){
      if(is_null($type)){
        switch(true){
          case is_int($value):
            $type = PDO::PARAM_INT;
            break;
          case is_bool($value):
            $type = PDO::PARAM_BOOL;
            break;
          case is_null($value):
            $type = PDO::PARAM_NULL;
            break;
          default:
            $type = PDO::PARAM_STR;
        }
      }

      $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    public function execute(){
      return $this->stmt->execute();
    }

    // Get result set as array of objects
    public function resultSet(){
      $this->execute();
      return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as object
    public function single(){
      $this->execute();
      return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get result set as array 
    public function resultArraySet(){
      $this->execute();
      return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get single record as object
    public function singleArray(){
      $this->execute();
      return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function executeQuery($sql, $data){
      $this->stmt = $this->dbh->prepare($sql);
      $this->stmt->execute($data);
      $rows = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
     // print_r($rows);
      return $rows;
    }

    // Get row count
    public function rowCount(){
      return $this->stmt->rowCount();
    }
  }