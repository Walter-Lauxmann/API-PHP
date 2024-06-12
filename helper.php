<?php
class UtilHelper {
    /* Crea un string codificado a partir de un array
    * @param Array array: array asociativo clave => valor
    * @return cadena de texto con el array listo para insertarse en BD
    */
    static function arrayEncode($array){
       return base64_encode(json_encode($array));
    }
  
    /* Crea un array a partir de un string codificado
    * @param String array_texto : string codificado de un array asociativo clave => valor
    * @return Array php
    */
    static function arrayDecode($array_texto){
       return json_decode((base64_decode($array_texto)),true);
    }
 }
?>