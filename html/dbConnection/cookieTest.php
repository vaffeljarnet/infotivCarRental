<?php

	if(isset($_COOKIE['previousLocation'])){
		echo $_COOKIE['previousLocation'];
	}else{
		echo "not set";
	}
	

?>

