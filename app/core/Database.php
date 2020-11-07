<?php 

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    //handler database
    private $dbh;
    private $stmt;

    public function __construct(){

        //data source name
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

        //membuat option
        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];


        // Tes koneksi block dengan try catch
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        } catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    //bind digunakan agar string bersih dan terhindar dari SQL injection
    public function bind($param, $value, $type = null){
        //jika tipe null, eksekusi
        if (is_null($type)){
            switch (true) {
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

    public function execute(){
        $this->stmt->execute();
    }

    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount(){
    //untuk menghitung baris jika kita gunakan tambah, ubah, dan hapus    
        return $this->stmt->rowCount();
}



}

?>