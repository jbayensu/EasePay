<?php

/**
 * User DAO Class - Objects are meant to act as Data Access Objects. 
 * Performs select, insert, update & delete operations upon 'users' table.
 * Inherits form BaseDao class.
 */
class TryDao {
    private $db = null;

    const DB_SERVER = "localhost";
    const DB_USER = "root";
    const DB_PASSWORD = "742166jab";
    const DB_NAME = "easepayclientsdb";

    public function __construct() {

        $this->db = $this->getDb();
    }

    protected final function getDb() {
        $dsn = 'mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_SERVER;

        try {
            $this->db = new \PDO($dsn, self::DB_USER, self::DB_PASSWORD);
        } catch (PDOException $e) {
            throw new \Exception('Connection failed: ' . $e->getMessage());
        }

        return $this->db;
    }
    
    
    public function getRecord($id) {
        $statement = $this->db->prepare("SELECT * FROM usertb where id='$id'");
        $statement->execute();
                
        if ($statement->rowCount() > 0) {
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
         
        return false;
    }

   
   

   
}

$tryDao = new TryDao;

$data=$tryDao->getRecord($_POST['id']);
if($data){
    for($index=0;$index<count($data);$index++){
        echo $data[$index]['fname'].'<br/>';
    }
}
?>