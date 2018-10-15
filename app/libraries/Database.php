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
    private $cursor;

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
        $this->conn = oci_connect("ecr2", "45ecR.77", "lirr-bschdev.lirr.org:10100/ECRDEV");
        
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
     $query = oci_parse($conn, "SELECT * FROM MDS_INFO");
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
      /*try{
        $exec = $this->stmt->execute();
      }catch(Exception $e){
        $exec = $e;
      }
      return $exec;*/
      return $this->stmt->execute();
    }

    public function pro_execute(){
      return $this->stmt->execute();
    }

    public function oci_new_cursor(){
      return oci_new_cursor($this->dbh);
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

    /**
     * Run a call to a stored procedure that returns a REF CURSOR data
     * set in a bind variable.  The data set is fetched and returned.
     *
     * Call like Db::refcurexecfetchall("begin myproc(:rc, :p); end",
     *                            "Fetch data", ":rc", array(array(":p", $p, -1)))
     * The assumption that there is only one refcursor is an artificial
     * limitation of refcurexecfetchall()
     *
     * @param string $sql A SQL string calling a PL/SQL stored procedure
     * @param string $action Action text for End-to-End Application Tracing
     * @param string $rcname the name of the REF CURSOR bind variable
     * @param array  $otherbindvars Binds. Array (bv_name, php_variable, length)
     * @return array Returns an array of tuples
    REF LINK : https://docs.oracle.com/cd/17781_01/appdev.112/e18555/ch_six_ref_cur.htm#TDPPH218
    EXAMPLE :   $sql = "BEGIN get_equip(:id, :rc); END;";
                $res = $db->refcurExecFetchAll($sql, "Get Equipment List", "rc", array(array(":id", $empid, -1)));

     */
    public function refcurExecFetchAll($sql, $action, $rcname, $otherbindvars = array()) {
        $this->stid = oci_parse($this->conn, $sql);
        //$this->stid = $this->query($sql);
        $rc = oci_new_cursor($this->conn);
        
        oci_bind_by_name($this->stid, $rcname, $rc, -1, OCI_B_CURSOR);
        foreach ($otherbindvars as $bv) {
            // oci_bind_by_name(resource, bv_name, php_variable, length)
            oci_bind_by_name($this->stid, $bv[0], $bv[1], $bv[2]);
        }
        oci_set_action($this->conn, $action);
        oci_execute($this->stid);
        oci_execute($rc); // run the ref cursor as if it were a statement id
        oci_fetch_all($rc, $res);   
        $this->stid = null;
        return($res);
    }


  }