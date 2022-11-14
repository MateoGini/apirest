<?php
require_once './app/model/coca.model.php';
require_once './app/view/coca.view.php';

//require_once './helpers/AuthHelper.php';

class CocaController {
    private $model;
    private $view;
    private $data;


    // private $authHelper;

    public function __construct() {
        $this->model = new CocaModel();
        $this->view = new CocaView();
        $this->data = file_get_contents("php://input");

        } 
        
        
        private function getData() {
            return json_decode($this->data);
        }
   
    public function showAll($params = NULL){
        try{
        if (isset($_GET['sortby']) && isset($_GET['order'])){
            if  ($_GET['sortby'] == 'stock'){
                    if ($_GET['order'] == 'DESC'){
                    $cocacola = $this->model->orderDESCstock();//?sortby=stock&order=DESC
                    }
                    elseif ($_GET['order'] == 'ASC'){
                    $cocacola = $this->model->orderASCstock();//?sortby=stock&order=DESC
                    }
                }
            elseif($_GET['sortby'] == 'id'){
                    if ($_GET['order'] == 'DESC'){
                    $cocacola = $this->model->orderDESCid();//?sortby=id&order=DESC
                    }
                    elseif ($_GET['order'] == 'ASC'){
                    $cocacola = $this->model->orderASCid();//?sortby=id&order=DESC
                    }
                }
            elseif($_GET['sortby'] == 'tipococa'){
                    if ($_GET['order'] == 'DESC'){
                    $cocacola = $this->model->orderDESCtipo();//?sortby=tipo&order=DESC
                    }
                     elseif ($_GET['order'] == 'ASC'){
                    $cocacola = $this->model->orderASCtipo();//?sortby=tipo&order=ASC
                    }
                }
            elseif($_GET['sortby'] == 'envase'){
                    if ($_GET['order'] == 'DESC'){
                        $cocacola = $this->model->orderDESCenvase();//?sortby=envase&order=DESC
                    }
                    elseif ($_GET['order'] == 'ASC'){
                    $cocacola = $this->model->orderASCenvase();//?sortby=envase&order=ASC
                    }
                }
            }
        elseif(isset($_GET['filterByType'])){
         $cocacola = $this->model->ShowByType($_GET['filterByType']);//?filterByType=tipo
        }
        else{
        $cocacola = $this->model->getAll();
        }
         return  $this->view->response($cocacola, 200);
     }
    catch(Exception $e){
       $this->view->response("Error en la url", 404);
    }
}

   
    // muestra por detalle el producto seleccionado
    public function showProduct($params = NULL) {
        $id = $params[':ID'];
        $product  = $this->model->get($id);
        if($product)
        $this->view->response($product);
        else 
        $this->view->response("El producto buscado con el id=$id no existe", 404);
    }

    public function addProduct($params = NULL){ //añadir un nuevo stock
        $cocacola = $this->getData();  
        
        if(empty($cocacola->tipo_coca) || empty($cocacola->envase)|| empty($cocacola->stock)){
            $this->view->response("Complete los datos", 400);
        }
        else {
            $id = $this->model->insert($cocacola->tipo_coca, $cocacola->envase, $cocacola->stock);
            $cocacola = $this->model->get($id);
            $this->view->response($cocacola, 201);
        }
    }
   public function delete($params = NULL) {
        $id = $params[':ID'];

        $product  = $this->model->get($id);
    if($product){
        $this->model->delete($id);
        $this->view->response($product);
      }
    else
    $this->view->response("La tarea con el id=$id no existe", 404);
        }
    }

