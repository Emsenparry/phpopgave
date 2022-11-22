<?php 
class Users {
    public $id;
    public $username;
    public $password;
    public $email;
    public $firstname;
    public $lastname;
    public $address;
    public $zipcode;

    private $db; 

    public function __construct() {
        global $db; 
        $this->db = $db;
    }

    /**
     * Funktion til at hente lister med
     */
    public function list() {
        $sql = "SELECT id, username, password
                FROM users
                ORDER BY username";
        return $this->db->query($sql);   
    }

    /**
     * Funktion til at hente detaljer med
     */
    public function details($id) {
        $params = array(
            'id' => array($id, PDO::PARAM_INT)
        );

        $sql = "SELECT email, firstname, lastname, address, zipcode
                FROM users
                WHERE id = :id";
        return $this->db->query($sql, $params, Db::RESULT_SINGLE); 
    }
    
    /**
     * Opret users
     */
    public function create() {
        $params = array(
            'id' => array($this->id, PDO::PARAM_INT),
            // 'username' => array($this->username, PDO::PARAM_STR),
            // 'password' => array($this->password, PDO::PARAM_STR),
            'email' => array($this->email, PDO::PARAM_STR),
            'firstname' => array($this->firstname, PDO::PARAM_STR),
            'lastname' => array($this->lastname, PDO::PARAM_STR),
            'address' => array($this->address, PDO::PARAM_STR),
            'zipcode' => array($this->zipcode, PDO::PARAM_INT)
        );

        $sql = "INSERT INTO users(id, email, firstname, lastname, address, zipcode)
                VALUES(:id, :email, :firstname, :lastname, :address, :zipcode)";
        $this->db->query($sql, $params);
        return $this->db->lastInsertId();
    }


    /**
     * Opdater users
     */
    public function update() {
        $params = array(
            'id' => array($this->id, PDO::PARAM_INT),
            'username' => array($this->username, PDO::PARAM_STR),
            'password' => array($this->password, PDO::PARAM_STR),
            'email' => array($this->email, PDO::PARAM_STR),
            'firstname' => array($this->firstname, PDO::PARAM_STR),
            'lastname' => array($this->lastname, PDO::PARAM_STR),
            'address' => array($this->address, PDO::PARAM_STR),
            'zipcode' => array($this->zipcode, PDO::PARAM_INT)
        );

        $sql = "UPDATE users SET
                    username = :username,
                    password = :password,
                    email = :email,
                    firstname = :firstname,
                    lastname = :lastname,
                    address = :address,
                    zipcode = :zipcode
                    WHERE id = :id";
        return $this->db->query($sql, $params);
    }

    /**
     * Delete users
     */
    // public function delete($id) {
    //     $params = array(
    //         'id' => array($id, PDO::PARAM_INT)
    //     );

    //     $sql = "DELETE FROM artist 
    //             JOIN song
    //             ON id = artist_id
    //             WHERE id = :id";
    //     return $this->db->query($sql, $params);
    // }
}

?>