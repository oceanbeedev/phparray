# PHP Array CRUD Operation




# Setup

inclue ObArray.php to your project

## how to use ?

very simple !


## Example

#push in array 

```php

<?php 
    
    	inclue "ObArray.php" ;
		
	$array = [
		[
		  'nmae'=>'..' ,
		  'family'=>'..'
		]
      	] ;
      
      	$data = ObArray::push($array,[
		[
		  'name'=>'hadi' ,
		  'family'=>'hosseini'
		],
		[
		  'name'=>'ali' ,
		  'family'=>'karimi'
		]
      	]);	
	
	
	
#read data using where -----------------

	$array = [
		  'name'=>'hadi' ,
		  'family'=>'hosseini'
		],
		[
		  'name'=>'ali' ,
		  'family'=>'karimi'
		]
	];
	
	$params = (object)[
		'name'=>'hadi'
	] ;
	
	$data = ObArray::where($array,function($item,$params){
		$status = false ;
		if($item->name == $param->name){
			$stauts = true ;
		}
		return ['status'=>$status];
	},$params) ;
	
	
#or :

$data = ObArray::findBy($array,'name','hadi');



#order by array---------------
$data = ObArray::orderBy($array,'name','asc');

#group by array -------------------
$data = ObArray::groupBy($array,'name');

#update array---------------
$data = ObArray::update($array,ObArray::where(function($item,$params){
	$status = false ;
		if($item->name == $param->name){
			$stauts = true ;
		}
		return ['status'=>$status];
},(object)[
	'name'=>'hadi'
]),[
	'name'=>'hadi 2'
]);



#delete from array ----
$data = ObArray::delete($array,ObArray::where(function($item,$params){
	$status = false ;
		if($item->name == $param->name){
			$stauts = true ;
		}
		return ['status'=>$status];
},(object)[
	'name'=>'hadi'
]);



#pagination array data 

$limit = 2 ;
$page = 1 ;

$data = ObArray::limit($array,$limit,$page);











	
