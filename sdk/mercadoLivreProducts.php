<?php

class mercadoLivreProducts extends mercadoLivreActions{

    private $token; 
    
    public function __set($atrib, $value) {
        
        $this->$atrib = $value;
    }

    public function __get($atrib) {

        return $this->$atrib;
    }

    public function getConsultUser() {
    
        $params = array("access_token"=>$this->token);

        return $this->get("/users/me",$params);        
    }
}