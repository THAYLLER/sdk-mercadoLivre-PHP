<?php

class mercadoLivreProductsCategory extends mercadoLivreActions{

    
    
    public function __set($atrib, $value) {
        
        $this->$atrib = $value;
    }

    public function __get($atrib) {

        return $this->$atrib;
    }

    public function getCategory() {

        return $this->get("/sites/".self::$SITE_ID['BR']."/categories");     
    }

    public function setCategory($id) {
        
        $params = array("category"=>$id);

        return $this->get("/sites/".self::$SITE_ID['BR']."/search",$params);     
    }

}