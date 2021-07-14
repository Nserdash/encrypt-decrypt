<?php 

class Decrypt {

    public static $set = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public static function reverseTiny($str)
    {
        $set = self::$set;
        $radix = strlen($set);
        $strlen = strlen($str);
        $N = 0;
        for($i=0;$i<$strlen;$i++)
        {
            $N += strpos($set,$str[$i])*pow($radix,($strlen-$i-1));
        }
        return "{$N}";
    }
  
       
    public static function decryptUrl($url,$params) {

         $fullurl = explode("?", $url); //разбиваю url на 2 части         
         $tokens = explode("&", $fullurl[1]); //получаю массив пар параметр=значение
                 
         $encrypted_url = '';
         $counter = 0;
         $tokenname = '';
         $tokenvalue = '';

         foreach($tokens as $token) {
            
            $tokenarray = explode('=',$token);
            
            $tokenname = $tokenarray[0];
            $tokenvalue = $tokenarray[1];                        
            $tokenname = self::reverseTiny($tokenname); //расшифровка
            $tokenname = substr($tokenname, 2);            
            $tokenname = $params[$tokenname]; //заменяем название параметра на обозначение из словаря            
            $encrypted_url = ($counter == 0) ? $tokenname.'='.$tokenvalue : $encrypted_url = $encrypted_url.'&'.$tokenname.'='.$tokenvalue;            

            $counter++;

         }         

         return $fullurl[0].'?'.$encrypted_url;
    } 

}

?>