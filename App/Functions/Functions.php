<?php


namespace App\Functions;

class Functions
{
	public static function str_aleatory($number)
	{
		$caracters = "a,b,c,d,f,e,r,t,y,u,h,A,S,D,F,G,H,J,K,L,Z,X,E,R,T,Y,U,I,1,2,3,4,5,6,7";
	$newCaracters = explode(',', $caracters);
	for ($i=0; $i < $number ; $i++) { 
		$x = rand(0, $number);
		$tab [] = $newCaracters[$x];
	}
	$res = implode('', $tab);
	return $res;
	}
}
