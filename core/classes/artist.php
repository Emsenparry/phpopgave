<?php 
class Artist {
    public $id;
    public $name;
    public $content;
    public $created_at;
    public $updated_at;

    private $db; 

    public function __construct() {
        global $db; 
        $this->db = $db;
    }

    /**
     * Funktion til at hente lister med
     */
    public function list() {
        $sql = "SELECT id, name
                FROM artist
                ORDER BY name";
        return $this->db->query($sql);   
    }

    /**
     * Funktion til at hente detaljer med
     */
    public function details($id) {
        $params = array(
            'id' => array($id, PDO::PARAM_INT)
        );

        $sql = "SELECT id, name, created_at, updated_at
                FROM artist";
        return $this->db->query($sql, $params, Db::RESULT_SINGLE); 
    }
    
    /**
     * Opret artist
     */
    public function create() {
        $params = array(
            'id' => array($this->id, PDO::PARAM_INT),
            'name' => array($this->name, PDO::PARAM_STR)
        );

        $sql = "INSERT INTO artist(id, name)
                VALUES(:id, :name)";
        $this->db->query($sql, $params);
        return $this->db->lastInsertId();
    }


    /**
     * Opdater artist
     */
    public function update() {
        $params = array(
            'id' => array($this->id, PDO::PARAM_INT),
            'name' => array($this->name, PDO::PARAM_STR)
        );

        $sql = "UPDATE artist SET
                    name = :name
                    WHERE id = :id";
        return $this->db->query($sql, $params);
    }

    /**
     * Delete artist
     */
    public function delete($id) {
        $params = array(
            'id' => array($id, PDO::PARAM_INT)
        );

        $sql = "DELETE FROM artist
                WHERE id = :id";
        return $this->db->query($sql, $params);
    }
}

?>