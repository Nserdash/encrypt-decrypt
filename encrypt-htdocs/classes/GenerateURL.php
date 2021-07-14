<?php 

class GenerateURL {

    public static function genereteURL($rand_keys, $params) {        
        $url = '';
        for($i=0;$i<count($rand_keys);$i++) {
            $url .=   ($i==0) ? "http://google.com?".$params[$rand_keys[$i]]."={".$params[$rand_keys[$i]]."}" : "&".$params[$rand_keys[$i]]."={".$params[$rand_keys[$i]]."}";
        }    
        
        return $url;
    }

}

?>