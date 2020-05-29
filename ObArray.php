<?php 

class ObArray {


    /**
     * this function return slice of array 
     * 
     * @param array $array 
     * @param int $limit 
     * @param int $page
     * 
     * @return array
     */
    public static function limit($array,$limit,$page) {
      
        $offset = ($limit*$page) - $limit  ;

        return array_slice($array,$offset,$limit) ;

    }


    /**
     * this function search in array by property(column of array)
     * 
     * @param array $array 
     * @param string $property 
     * @param mixed $value
     * 
     * @return array
     */
    public static function findBy($array,$property,$value) {

        $results = [] ;

        foreach($array as $key=>$item) {
            $item = (object)$item ;
            if(isset($item->$property)){
                if($item->$property === $value){
                    $item->_key = $key ;
                    $results[] = $item ;
                }
            }
        }
        return $results ;
    }



    /**
     * this function return end item of array
     * 
     * @param array $array 
     * 
     * @return array
     */
    public static function endItem($array) {
        return end($array);
    }



    /**
     * this function order by array items
     * 
     * @param array $array 
     * @param string $property 
     * 
     * @return array
     */
    public static function orderBy($array,$property,$type='asc') {

        $array = array_values($array) ;
        for ($outer = 0; $outer < count($array); $outer++) {
            
            $array[$outer] = (object) $array[$outer] ;
            
            for ($inner = 0; $inner < count($array); $inner++) {
                
                $array[$inner] = (object) $array[$inner] ;

                if (isset($array[$outer]->$property)) {

                    if (isset($array[$inner]->$property)) {

                        if($type == 'desc') {
                            if ($array[$outer]->$property > $array[$inner]->$property) {
                                $tmp = $array[$outer];
                                $array[$outer] = $array[$inner];
                                $array[$inner] = $tmp;
                            }
                        }else{
                            if ($array[$outer]->$property < $array[$inner]->$property) {
                                $tmp = $array[$outer];
                                $array[$outer] = $array[$inner];
                                $array[$inner] = $tmp;
                            }
                        }
                       
                    }
                    
                }
            }
        }

        return $array ;

    }



    /**
     * this function group by value by property (column) of array
     * 
     * @param array $array 
     * @param string $property
     * 
     * @return array
     */
    public static function groupBy($array,$property){

        $results = [] ;
        foreach($array as $item){
            $item = (object) $item ;
            if(isset($item->$property)) {

                if(!isset($results[$item->$property])){
                    $results[$item->$property] = (object) [] ;
                    $results[$item->$property]->count = 0 ;
                    $results[$item->$property]->value = $item->$property ;
                }
                $results[$item->$property]->count++;
            }

        }
        return $results ;
    }


    /**
     * this function return result bu custom conditoin 
     * 
     * @param array $array
     * @param callback $where 
     * @param array $params
     * 
     * @return array
     */
    public static function where($array,$where,$params=null) {

        $results = [] ;

        foreach($array as $key=>$item) {
            $item = (object) $item ;
            $result  = (object) $where($item,$params);

            if($result->status == true) {
               
                if(isset($result->properties)){
                    foreach($result->properties as $name=>$value){
                        $item->$name = $value ;
                    }
                    
                    
                }
                $item->_key = $key ;
                $results[] = $item ;
            }

        }
        return $results ;

    }


    /**
     * this function edit array item
     * 
     * @param array $selected
     * this param relation with where function
     * 
     * @param array $array 
     * @param array data
     * 
     * @return array
     */
    public static function update($array,$selected,$data) {

        foreach($selected as $item) {
            foreach($data as $name=>$value){
                $array[$item->_key]->$name = $value ;
               
            }
            $array[$item->_key]->_updated_at = time() ;
        }
        return $array ;
    }


    /**
     * this function remove array item
     * 
     * @param array $array 
     * @param array $selected 
     * this function related with where function
     * 
     * @return array
     */
    public static function delete($array,$selected) {

        foreach($selected as $item) {
            unset($array[$item->_key]);
        }

        return array_values($array) ;

    }






    /**
     * this function push item in array
     * 
     * @param array $array 
     * @param array $data 
     * 
     * @return object 
     */
    public static function push($array,$data) {

        if(count($array) > 0){
            $insertId = end($array)->_id ;
        }else{
            $insertId = 0 ;
        }
        $insertData = [];
        foreach($data as $item) {
            $item = (object) $item ;
            $insertId++ ;
            $item->_id = $insertId ;
            $item->_created_at = time() ;
            $item->_updated_at = time() ;
            $array[] = $item ;
            $insertData[] = $item ;
        }

        return (object)[
            'insertData'=>$insertData ,
            'array'=>$array
        ] ;

    }


}
