<?php 

class Encrypt {

    public static $set = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public static function toTiny($id)
    {
        $set = self::$set;

        $HexN="";
        $id = floor(abs(intval($id)));
        $radix = strlen($set);
        while (true)
        {
            $R=$id%$radix;
            $HexN = $set[$R].$HexN;
            $id=($id-$R)/$radix;
            if ($id==0) break;
        }
        return $HexN;
    }

    public static function generateKey($length){
        $chars = '1234567890';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }    
       
    public static function encryptUrl($url,$params,$key) {

         $fullurl = explode("?", $url); //разбиваю url на 2 части
         $tokens = explode("&", $fullurl[1]); //получаю массив пар параметр=значение
         
         $encrypted_url = '';
         $counter = 0;
         $tokenname = '';
         $tokenvalue = '';
         $keysl = str_split($key);

         foreach($tokens as $token) {
            
            $tokenarray = explode('=',$token);
            
            $tokenname = $tokenarray[0];
            $tokenvalue = $tokenarray[1];
            $tokenname = array_search($tokenname, $params); //заменяем название параметра на обозначение из словаря            
            $tokenname = self::toTiny($keysl[$counter].$tokenname); //шифровка

            if ($counter == 0) {
             $encrypted_url = $tokenname.'='.$tokenvalue;
            } else {
             $encrypted_url = $encrypted_url.'&'.$tokenname.'='.$tokenvalue;
            }

            $counter++;

         }

         return $fullurl[0].'?'.$encrypted_url;
    } 

}

?>