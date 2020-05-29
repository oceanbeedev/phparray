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

	
#read data using where

```php 
<?php 


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
	
	ObArray::where($array,function($item,$params){
		$status = false ;
		if($item->name == $param->name){
			$stauts = true ;
		}
		return ['status'=>$status];
	},$params)
	
