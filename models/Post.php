<?php 
  class Post {
    // DB stuff
    private $conn;
    private $table = 'Prekes';

    // Post Properties
    public $id;
    public $Pavadinimas;
    public $Miestas;
    public $Kiekis;
    public $Vieta_sandelyje;
    public $Kategorija;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT  id, Pavadinimas, Miestas, Kiekis, Vieta_sandelyje, Kategorija
                                FROM ' . $this->table . '
                                ORDER BY
                                    id ASC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT 
                        id, 
                        Pavadinimas, 
                        Miestas, 
                        Kiekis, 
                        Vieta_sandelyje, 
                        Kategorija
                    FROM ' . $this->table . '
                    WHERE
                        id = ?
                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->Pavadinimas = $row['Pavadinimas'];
          $this->Miestas = $row['Miestas'];
          $this->Kiekis = $row['Kiekis'];
          $this->Vieta_sandelyje = $row['Vieta_sandelyje'];
          $this->Kategorija = $row['Kategorija'];
    }  
  }