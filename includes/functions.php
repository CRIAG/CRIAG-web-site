<?php

function escape($var)
{
	return htmlEntities($var, ENT_QUOTES);
}

function reduce_name($name)
{
	$length=strlen($name);
	if($length<=10) return $name;
	
	return substr($name,0,7)."..";	
}

?>