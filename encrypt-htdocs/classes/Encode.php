<?php

class Encode { //заготовка на дешифратор
    
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
}


 



?>