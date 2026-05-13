<?php
class Bebida {
    private $conn;
    private $table_name = "bebidas";

    public $idBebida;
    public $nome;
    public $valor;
    public $categorias;
    public $ativo;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT idBebida, nome, valor, categorias, ativo FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function get() {
        $query = "SELECT idBebida, nome, valor, categorias, ativo 
                  FROM " . $this->table_name . " 
                  WHERE idBebida = ? LIMIT 1";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->idBebida);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($row) {
            $this->nome       = $row['nome'];
            $this->valor      = $row['valor'];
            $this->categorias = $row['categorias'];
            $this->ativo      = $row['ativo'];
        }
    }

    public function add() {
        $query = "INSERT INTO " . $this->table_name . "
                  (nome, valor, categorias, ativo)
                  VALUES (?, ?, ?, ?)";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(1, $this->nome);
        $stmt->bindParam(2, $this->valor);
        $stmt->bindParam(3, $this->categorias);
        $stmt->bindParam(4, $this->ativo);
    
        return $stmt->execute();
    }
}