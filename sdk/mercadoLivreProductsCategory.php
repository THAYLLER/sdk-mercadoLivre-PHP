<?php

class mercadoLivreProductsCategory extends mercadoLivreActions{

    
    
    public function __set($atrib, $value) {
        
        $this->$atrib = $value;
    }

    public function __get($atrib) {

        return $this->$atrib;
    }

}