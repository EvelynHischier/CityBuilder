<?php
function __autoload($class){
	include_once __DIR__."../model/Class.".$class."php";
}
class Historic{
	
}