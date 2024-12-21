<?php
class Movie extends Database
{
    private $_db, $_data;

    public function __construct($movie = null)
    {
        $this->_db = DB::getInstance();
    }

    public function create($fields = array()) 
    {
        if(!$this->_db->insert('crud', $fields)) 
        {
            throw new Exception('There was a problem inserting data to crud table.');
        }
    }

    public function data() 
    {
        return $this->_data;
    }
    
    public function select()
    {

        $sql =  "SELECT * FROM crud";

        $result = $this->connect()->query($sql);

        if($result->rowCount() > 0) 
        {
            while ($row = $result->fetch())
            {
                $data[] = $row;
            }
            return $data;
        }

    }

    public function insert($fields)
    {
        $implodeColumns = implode(", ",array_keys($fields));
        $implodePlaceholder = implode(", :",array_keys($fields));

        $sql = "INSERT INTO crud ($implodeColumns) VALUES (:".$implodePlaceholder.")";
        $statement = $this->connect()->prepare($sql);
        foreach($fields as $key => $value) 
        {
            $statement->bindValue(':'.$key,$value);
        }
        $statementExec = $statement->execute();
    }

    public function selectOne($id) 
    {
        $sql = "SELECT * FROM crud WHERE id = :id";
        $statement =  $this->connect()->prepare($sql);
        $statement->bindValue(":id",$id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function destroy($id) 
    {
        $sql = "DELETE FROM crud WHERE id = :id";

        $statement = $this->connect()->prepare($sql);
        $statement->bindValue(":id", $id);
        $statement->execute();
    }

    public function update_movie($id, $title, $duration, $rating)
    {
        $sql = "UPDATE crud 
                SET title = :title,
                    duration = :duration,
                    rating = :rating
                WHERE id = :id";

        $statement = $this->connect()->prepare($sql);
        $statement->bindValue(":title", $title);
        $statement->bindValue(":duration", $duration);
        $statement->bindValue(":rating", $rating);
        $statement->bindValue(":id", $id);
        $statement->execute();
    }
}
