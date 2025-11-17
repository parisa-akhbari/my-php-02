<?php
    $filepath = realpath(dirname(__FILE__));
    require_once $filepath."../../config/config.php";

    class DB{
        private $hostname = DB_HOST;
        private $username = DB_USER;
        private $password = DB_PASS;
        private $database = DB_NAME;

        private $connect;

        public function __construct(){           
            $this->connectDB();
        }

       private function connectDB() {
        $this->connect = new mysqli(
            "my-php-02-database",  
            "root",               
            "1234",                
            "php81_dev_environment"
    );

    if ($this->connect->connect_error) {
        die("Connection failed: " . $this->connect->connect_error);
    }
}

        public function select($query){
            $result = $this->connect->query($query) or die($this->connect->error.__LINE__); 
            if ($result->num_rows > 0) {
                return $result;
            } else {
                return false;
            }
        }

       // داخل DB
        public function getone($query){
            $result = $this->connect->query($query) or die($this->connect->error . __LINE__);
            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc(); // فقط یک رکورد
            } else {
                return false;
        }
}


        public function insert($query){
            $insert_row = $this->connect->query($query) or die($this->connect->error.__LINE__); 
            if ($insert_row) {
                return $insert_row;
            } else {
                return false;
            }
        }
        public function update($query){
            $update_row = $this->connect->query($query) or die($this->connect->error . __LINE__);

            if ($update_row) {
                return $update_row;
            } else {
                return false;
        }
}

        public function delete($query){
            $result = $this->connect->query($query);

            if($result){
                return true;
            } else {
                 return false;
        }
}

        public function escape($str) {
            return $this->connect->real_escape_string($str);
    }

      public function getConnection() {
        return $this->connect;
    }
    }

?>