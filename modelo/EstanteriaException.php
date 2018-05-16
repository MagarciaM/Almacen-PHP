<?php
/**
 * Description of EstanteriaException
 *
 * @author migue
 */
class EstanteriaException extends Exception{
    
    private $mymsj;
    
    public function __construct($message, $code, $mymsj) {
        parent::__construct($message, $code, null); // Como el 3º valor siempre es null, le ponemos el valor directamente
        $this->mymsj = $mymsj;
    }

    public function __toString() {
        return __CLASS__ . " // MsjSQL: " . $this->message . " //  Code: " . $this->code . " // Msj: " . $this->mymsj;
    }
}
