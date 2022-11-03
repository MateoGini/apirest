<?php

class CocaModel{
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_stock;charset=utf8', 'root', '');
    }
    
    public function getAll(){
        $query = $this->db->prepare("SELECT * FROM pedidos INNER JOIN tipos ON pedidos.envase=tipos.id_envase");
        $query->execute();

        $cocacola = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $cocacola;
    }
    public  function insert($tipo_coca, $envase, $stock){
        $query= $this->db->prepare("INSERT INTO pedidos (tipo_coca, envase, stock) VALUES (?, ?, ?)");
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
    public function EditStock($tipo_coca,$envase,$stock,$id_stock){
        $query = $this->db->prepare("UPDATE pedidos SET tipo_coca= ? ,envase=?,stock=? WHERE id_stock = ? ");
         $query->execute(array($tipo_coca,$envase,$stock,$id_stock));
        }
}