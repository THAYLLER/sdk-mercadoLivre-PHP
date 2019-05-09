<?php

class mercadoLivreProducts extends mercadoLivreActions{

    private $title;
    private $category_id;
    private $price;
    private $official_store_id;
    private $currency_id;
    private $available_quantity;
    private $buying_mode;
    private $listing_type_id;
    private $condition;
    private $description;
    private $video_id;
    private $warranty;
    private $pictures;
    private $tags;
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
            "condition" => $this->condition,
            "description" => $this->description,
            "video_id" => $this->video_id,
            "tags" => $this->tags,
            "warranty" => $this->warranty,
            "pictures" => $this->pictures
        );
    }

    public function publishProduct() {

        return $this->post("/items",$this->publishProductParams());
    }
}