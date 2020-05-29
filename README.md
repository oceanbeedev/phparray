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

	
