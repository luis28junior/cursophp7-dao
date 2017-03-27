<?php 
spl_autoload_register(function ($nameClass){
	$fileName = 'class' . DIRECTORY_SEPARATOR . $nameClass . '.php';

	if(file_exists($fileName)){
		require_once($fileName);
	}


});

?>