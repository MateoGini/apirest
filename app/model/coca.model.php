<?php

class CocaModel{
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_stock;charset=utf8', 'root', '');
    }
    
    public function getAll(){
        $query = $this->db->prepare("SELECT * FROM pedidos");
        $query->execute();

        $cocacola = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $cocacola;
    }
    public function orderASCstock(){
        $query = $this->db->prepare("SELECT * FROM pedidos ORDER BY stock ASC");
        $query->execute();
        $cocacola = $query->fetchAll(PDO::FETCH_OBJ);
        return $cocacola;
    }
    public function orderDESCstock(){
        $query = $this->db->prepare("SELECT * FROM pedidos ORDER BY stock DESC");
        $query->execute();
        $cocacola = $query->fetchAll(PDO::FETCH_OBJ);
        return $cocacola;
    }
    public function orderASCid(){
        $query = $this->db->prepare("SELECT * FROM pedidos ORDER BY id ASC");
        $query->execute();
        $cocacola = $query->fetchAll(PDO::FETCH_OBJ);
        return $cocacola;
    }
    public function orderDESCid(){
        $query = $this->db->prepare("SELECT * FROM pedidos ORDER BY id DESC");
        $query->execute();
        $cocacola = $query->fetchAll(PDO::FETCH_OBJ);
        return $cocacola;
    }
    public function orderASCtipo(){
        $query = $this->db->prepare("SELECT * FROM pedidos ORDER BY tipo_coca ASC");
        $query->execute();
        $cocacola = $query->fetchAll(PDO::FETCH_OBJ);
        return $cocacola;
    }
    public function orderDESCtipo(){
        $query = $this->db->prepare("SELECT * FROM pedidos ORDER BY tipo_coca DESC");
        $query->execute();
        $cocacola = $query->fetchAll(PDO::FETCH_OBJ);
        return $cocacola;
    }
    public function orderASCenvase(){
        $query = $this->db->prepare("SELECT * FROM pedidos ORDER BY envase ASC");
        $query->execute();
        $cocacola = $query->fetchAll(PDO::FETCH_OBJ);
        return $cocacola;
    }
    public function orderDESCenvase(){
        $query = $this->db->prepare("SELECT * FROM pedidos ORDER BY envase DESC");
        $query->execute();
        $cocacola = $query->fetchAll(PDO::FETCH_OBJ);
        return $cocacola;
    }
    public function ShowByType($envase){
        $query = $this->db->prepare("SELECT * FROM pedidos WHERE envase = ?");
        $query->execute([$envase]);
        $cocacola= $query->fetchAll(PDO::FETCH_OBJ);
        return $cocacola;
    }
    public  function insert($tipo_coca, $envase, $stock){
        $query = $this->db->prepare("INSERT INTO pedidos (tipo_coca, envase, stock) VALUES (?, ?, ?)");
        $query->execute([$tipo_coca, $envase, $stock]);   
        return $this->db->lastInsertId();
     
    }
    public function delete($id){
        $query = $this->db->prepare('DELETE FROM pedidos WHERE id = ?'); //Elimino segun id 
        $query->execute([$id]);
    }
    public function get($id){
        $query = $this->db->prepare("SELECT * FROM pedidos WHERE id=?");
        $query->execute([$id]);
        $cocacolas = $query->fetch(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        return $cocacolas;
    }
}