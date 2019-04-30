<?php
class mercadoLivreAuth extends mercadoLivreActions{

	/**
	 * @version 0.0.1
	 */
    const VERSION  = "0.0.1";

    /**
     * @var $API_ROOT_URL é uma URL principal para acessar as APIs do MercadoLivre.
     * @var $AUTH_URL é uma URL para redirecionar o usuário para login.
     */
    protected static $API_ROOT_URL = "https://api.mercadolibre.com";
    protected static $OAUTH_URL    = "/oauth/token";
    public static $AUTH_URL = array(
        "MLA" => "https://auth.mercadolibre.com.ar", // Argentina 
        "MLB" => "https://auth.mercadolivre.com.br", // Brasil
        "MCO" => "https://auth.mercadolibre.com.co", // Colombia
        "MCR" => "https://auth.mercadolibre.com.cr", // Costa Rica
        "MEC" => "https://auth.mercadolibre.com.ec", // Ecuador
        "MLC" => "https://auth.mercadolibre.cl", // Chile
        "MLM" => "https://auth.mercadolibre.com.mx", // Mexico
        "MLU" => "https://auth.mercadolibre.com.uy", // Uruguay
        "MLV" => "https://auth.mercadolibre.com.ve", // Venezuela
        "MPA" => "https://auth.mercadolibre.com.pa", // Panama
        "MPE" => "https://auth.mercadolibre.com.pe", // Peru
        "MPT" => "https://auth.mercadolibre.com.pt", // Prtugal
        "MRD" => "https://auth.mercadolibre.com.do"  // Dominicana
    );

    private $client_id;
    private $client_secret;
    private $redirect_uri;
    private $access_token;
    private $refresh_token;

    /**
     * Getter e setter. Definir todas as variáveis ​​para conectar no MercadoLivre
     *
     * @param string $client_id
     * @param string $client_secret
     * @param string $access_token
     * @param string $refresh_token
     */
    
    public function __set($atrib, $value) {
        $this->$atrib = $value;
    }

    public function __get($atrib) {
        return $this->$atrib;
    }

    /**
     * Devolve uma string com um URL de login completo do MercadoLivre.
     * NOTA: Você pode modificar o $ AUTH_URL para alterar o idioma de login
     * 
     * @param string $redirect_uri
     * @return string
     */
    public function getAuthUrl($redirect_uri, $auth_url) {
        
        $this->redirect_uri = $redirect_uri;

        $params = array("client_id" => $this->client_id, "response_type" => "code", "redirect_uri" => $this->redirect_uri);
        
        return $auth_url."/authorization?".http_build_query($params);
    }

    /**
    * Executa uma solicitação POST para autorizar o aplicativo e
     * um AccessToken.
     * 
     * @param string $code
     * @param string $redirect_uri
     * 
     */
    public function authorize($code, $redirect_uri) {

        if(!empty($redirect_uri)) $this->redirect_uri = $redirect_uri;

        $body = array(
            "grant_type" => "authorization_code", 
            "client_id" => $this->client_id, 
            "client_secret" => $this->client_secret, 
            "code" => $code, 
            "redirect_uri" => $this->redirect_uri
        );
        
        $opts = array(
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $body
        );
    
        $request = $this->execute(self::$OAUTH_URL, $opts);

        if($request["httpCode"] == 200) {             
            $this->access_token = $request["body"]->access_token;

            if($request["body"]->refresh_token)
                $this->refresh_token = $request["body"]->refresh_token;

            return $request;

        } else {
            return $request;
        }
    }

    /**
     * Execute uma solicitação POST para criar um novo AccessToken a partir de um refresh_token existente
     * 
     * @return string|mixed
     */
    public function refreshAccessToken() {

        if($this->refresh_token) {
             $body = array(
                "grant_type" => "refresh_token", 
                "client_id" => $this->client_id, 
                "client_secret" => $this->client_secret, 
                "refresh_token" => $this->refresh_token
            );

            $opts = array(
                CURLOPT_POST => true, 
                CURLOPT_POSTFIELDS => $body
            );
        
            $request = $this->execute(self::$OAUTH_URL, $opts);

            if($request["httpCode"] == 200) {             
                $this->access_token = $request["body"]->access_token;

                if($request["body"]->refresh_token)
                    $this->refresh_token = $request["body"]->refresh_token;

                return $request;

            } else {
                return $request;
            }   
        } else {
            $result = array(
                'error' => 'Offline-Access is not allowed.',
                'httpCode'  => null
            );
            return $result;
        }        
    }

    /**
     * Verifique e construa um URL real para fazer o pedido
     * 
     * @param string $path
     * @param array $params
     * @return string
     */
    public function make_path($path, $params = array()) {
        if (!preg_match("/^\//", $path)) {
            $path = '/' . $path;
        }

        $uri = self::$API_ROOT_URL . $path;
        
        if(!empty($params)) {
            $paramsJoined = array();

            foreach($params as $param => $value) {
               $paramsJoined[] = "$param=$value";
            }
            $params = '?'.implode('&', $paramsJoined);
            $uri = $uri.$params;
        }

        return $uri;
    }
}
