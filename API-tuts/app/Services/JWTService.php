<?php
namespace App\Service;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTService {

    /**
     * Parse token
     * @return mixed
     */
    public function parseToken() {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            return $user;
        } catch(JWTException $e) {
            throw $e;
        }
    }
}
?>