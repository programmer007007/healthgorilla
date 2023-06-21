
<?php 
    function base64url($source) {        
        $encodedSource = base64_encode($source);   
        $encodedSource = rtrim($encodedSource, '=');        
        $encodedSource = strtr($encodedSource, '+/', '-_');    
        return $encodedSource;
    }
    
    function createToken() {
        $expirationDate = "1623350000"; 
        $now = "1623350000"; 
    
        $header = array(
            "alg" => "HS256",
            "typ" => "JWT"
        );
        $stringifiedHeader = json_encode($header);
        $encodedHeader = base64url(utf8_encode($stringifiedHeader));   
        $data = array(
            "aud" => "https://sandbox.healthgorilla.com/oauth/token",
            "iss" => "https://www.crafthealth.com",
            "sub" => "viddy.desai",
            "iat" => $now,
            "exp" => $expirationDate
        );
        $stringifiedData = json_encode($data);        
        $stringifiedData = str_replace('\\', '', $stringifiedData);
        $encodedData = base64url(utf8_encode($stringifiedData));    
        $token = $encodedHeader . "." . $encodedData;    
        $secret = "HiYm2Lq5be7KUblmsnpyUE9zXj1WRDQmkGfSdhSZda4=";    
        $signature = hash_hmac('sha256', $token, $secret, true);
        $encodedSignature = base64url($signature);    
        $signedToken = $token . "." . $encodedSignature;
        echo "Your signed token is: <br>" . $signedToken;
    }

    createToken();
    ?>
