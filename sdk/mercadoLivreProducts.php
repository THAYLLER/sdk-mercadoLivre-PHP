<?php

class mercadoLivreProducts extends mercadoLivreActions{

    private $title;
    private $category_id;
    private $price;
    private $currency_id;
    private $available_quantity;
    private $buying_mode;
    private $listing_type_id;
    private $description;
    private $video_id;
    private $attributes;
    private $sale_terms;
    private $pictures;
    private $token;
    
    public function __set($atrib, $value) {
        
        $this->$atrib = $value;
    }

    public function __get($atrib) {

        return $this->$atrib;
    }

    public function publishProductParams() {

        return array(
            "access_token"=>$this->token,
            "title" => $this->title,
            "category_id" => $this->category_id,
            "price" => $this->price,
            "currency_id" => $this->currency_id,
            "available_quantity" => $this->available_quantity,
            "buying_mode" => $this->buying_mode,
            "listing_type_id" => $this->listing_type_id,
            "description" => $this->description,
            "video_id" => $this->video_id,
            "attributes" => $this->attributes,
            "sale_terms" => $this->sale_terms,
            "pictures" => $this->pictures
        );
    }

    public function publishProduct() {
        exit(print_r($this->publishProductParams()));
        return $this->post("/items",$this->publishProductParams());
    }
}