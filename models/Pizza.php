<?php
class Pizza {
    private $conn;
    private $tabela = 'pizzas';
    public $idPizza;
    public $nome;
    public $ingredientes;
    public $valor;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT idPizza, nome, ingredientes, valor FROM " . $this->tabela;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function get() {
        $query = 'SELECT idPizza, nome, ingredientes, valor FROM ' . $this->tabela . ' WHERE idPizza = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->idPizza);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->nome        = $row['nome'];
        $this->ingredientes = $row['ingredientes'];
        $this->valor       = $row['valor'];
    }

    public function add() {
        $query = 'INSERT INTO ' . $this->tabela . ' SET nome = :nome, ingredientes = :ingredientes, valor = :valor';
        $stmt = $this->conn->prepare($query);

        $this->nome        = htmlspecialchars(strip_tags($this->nome));
        $this->ingredientes = htmlspecialchars(strip_tags($this->ingredientes));
        $this->valor       = htmlspecialchars(strip_tags($this->valor));

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':ingredientes', $this->ingredientes);
        $stmt->bindParam(':valor', $this->valor);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

} // ← fecha a classe aqui, depois de todos os métodos