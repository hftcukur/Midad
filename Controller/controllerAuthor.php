<?php
class ControllerAuthor {
    private $model;
    function __construct($model)
    {
        $this->model = $model;
    }
       public function findByID($id)
    {

        return $this->model->findByID($id);
    }
    public function getAll(){
    return $this->model->loadAll();
    }
    public function getBookAuthor($id)
    {
      $has = $this->model->loadBookByAuthorID($id);
      if(!$has){
        return "ليس لديه كتب";
      }
      return $has ;
    }
}

?>