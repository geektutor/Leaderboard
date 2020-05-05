<?php

function cg($heads, $legs){
	$goat = ($legs - ($heads*2))/2;
	$chicken = $heads - $goat;

	echo "We have " . $goat . " goats and " . $chicken . " chickens";
}

function gg($heads, $legs){
	$goat = ($legs/2) - $heads;
	echo "We have " . $goat . " goats";

}

gg(20,20);