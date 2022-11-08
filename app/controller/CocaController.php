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
        if (isset($_GET['sortby']) && isset($_GET['order'])){
            if($_GET['order'] == 'ASC'){
                if($_GET['sortby'] == 'stock')
                $cocacola = $this->model->orderASC();//?sortby=stock&order=ASC
                }
            elseif ($_GET['order'] == 'DESC'){
                if($_GET['sortby'] == 'stock')
                $cocacola = $this->model->orderDESC();//?sortby=stock&order=DESC
            }
        }
        else{
        $cocacola = $this->model->getAll();
        }
        return $this->view->response($cocacola, 200);
        
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


      public function showFormEdit($id_stock){
        $this->checkLoggedIn();
        $cocacolas= $this->model->getID($id_stock);
        $tipo = $this->model_type->getEnvase();  
        $this->view->showFormEdit($tipo, $cocacolas);
      }

     public function EditStock(){
        $this->checkLoggedIn();
      
            $id_stock = $_POST['id_stock'];
            $tipo_coca = $_POST['tipo_coca'];
            $envase = $_POST['envase'];
            $stock = $_POST['stock'];

            $this->model->EditStock($tipo_coca,$envase,$stock,$id_stock);
            header("Location: " . BASE_URL .""); 

        }
    
public function checkLoggedIn() {
    if (!isset($_SESSION['IS_LOGGED'])) {
        header("Location: " . BASE_URL . '/login');
        die();
    }
} 
}


