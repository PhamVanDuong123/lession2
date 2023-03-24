<?php
class Category{

    // database connection and table name
    private $conn;
    private $table_name = "categories";

    // object properties
    public $id;
    public $name;
  

    public $parent_id;
    public $timestamp;
  
 
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function readAll($from_record_num, $records_per_page)
    {

        $query = "SELECT
                    id, name , parent_id
                FROM
                    " . $this->table_name . "
              
                LIMIT
                    {$from_record_num}, {$records_per_page}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // create product
    function create()
    {

        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, parent_id=:parent_id";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->name = htmlspecialchars(strip_tags($this->name));
      
        $this->parent_id = htmlspecialchars(strip_tags($this->parent_id));

        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');

        // bind values 
        $stmt->bindParam(":name", $this->name);
       
    
        $stmt->bindParam(":parent_id", $this->parent_id);
       

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function countAll()
    {

        $query = "SELECT id FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }
    function readOne(){
  
        $query = "SELECT
                    name, parent_id
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                LIMIT
                    0,1";
      
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
        $this->name = $row['name'];
       
    
        $this->parent_id = $row['parent_id'];
    }
    function update(){
  
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name = :name,
                    parent_id  = :parent_id
                WHERE
                    id = :id";
      
        $stmt = $this->conn->prepare($query);
      
        // posted values
        $this->name=htmlspecialchars(strip_tags($this->name));
       
        $this->parent_id=htmlspecialchars(strip_tags($this->parent_id));
        $this->id=htmlspecialchars(strip_tags($this->id));
      
        // bind parameters
        $stmt->bindParam(':name', $this->name);
    
        $stmt->bindParam(':parent_id', $this->parent_id);
        $stmt->bindParam(':id', $this->id);
      
        // execute the query
        if($stmt->execute()){
            return true;
        }
      
        return false;
          
    }
    function delete(){
  
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
          
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
      
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function search($search_term, $from_record_num, $records_per_page){
  
        // select query
        $query = "SELECT
                    c.name as category_name, p.id, p.name, p.parent_id,
                FROM
                    " . $this->table_name . " p
                
                WHERE
                    p.name LIKE ?               
                   
                LIMIT
                    ?, ?";
      
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
      
        // bind variable values
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(3, $records_per_page, PDO::PARAM_INT);
      
        // execute query
        $stmt->execute();
      
        // return values from database
        return $stmt;
    }
      
    public function countAll_BySearch($search_term){
      
        // select query
        $query = "SELECT
                    COUNT(*) as total_rows
                FROM
                    " . $this->table_name . " p 
                WHERE
                    p.name LIKE ?";
      
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
      
        // bind variable values
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
      
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
        return $row['total_rows'];
    }
    function read(){
        //select all data
        $query = "SELECT
                    id, name
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }
    function readName(){
      
        $query = "SELECT name FROM " . $this->table_name . " WHERE id = ? limit 0,1";
      
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
          
        $this->name = $row['name'];
    }
    public function searchPlayer($searchText, $start = 0, $limit = 10)
    {
        $sql = "SELECT * FROM {$this->table_name} p WHERE p.name LIKE :search ORDER BY id DESC LIMIT {$start},{$limit}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':search' => "{$searchText}%"]);
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $results = [];
        }

        return $results;
    }
  
   
}
