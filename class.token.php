<?php

class key{

  private $min = 0;
  private static $token; // == $value
  private static $length = 15;
  private static $codeAlphabet = "-_0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

  protected static $db;

  public function __construct($length=9){
    self::$length = $length;
    self::$token = $this->generate();
  }

  public function getToken() {
    return self::$token;
  }

  private function generate() {
    return self::generateToken(self::$length);
  }

  /** @author http://stackoverflow.com/a/13733588 */
  public static function generateToken($length=9, $strengt=1){
    self::$length = $length;
    $tokenString = "";
    for($i=0;$i<self::$length;$i++){
      $tokenString .= self::$codeAlphabet[self::crypto_rand_secure(0,strlen(self::$codeAlphabet))];
    }
    self::$token = $tokenString;

      return $tokenString;
  }

  private static function crypto_rand_secure($min=0, $max) {
    $range = $max - $min;
    if ($range < 0) return $min; // not so random...
    $log = log($range, 2);
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
      $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
      } while ($rnd >= $range);
      return $min + $rnd;
    }

  }
  ?>