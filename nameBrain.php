<?php
// this function will write output
// to the console, and takes in some
// data, as either array or variable.
function debug_to_console( $data ) {
    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data ) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
    echo $output;
}
// this function generates a name
function generateName($incArray) {
	// the type of name is the first variable
	$nameType = $incArray['size'];
	// set up the syllable arrays.
	$firstSyllables = array("Mon","Fay","Shi","Gar","Bli","Tem","Scar","Qo","Tar","Mlip","Munk","Qi","Qhi","Phi","Sar","Ral","Sal","Var");
	$secondSyllables = array("malo","zak","abo","won","al","ap","la","phe","ia","fa","ep","el","iil","yl");
	$lastSyllables = array("shi","lm","us","le","ir","lax","for","eam","im","lak");
	// title array
	$titles = array("Viscount","The Glorious","The Heavenly","The Majestic","Duke","Escount","Crowle");
	// return variable
	$theName = "";
	// if it's a person...
	if(strtolower($nameType) == "person") {
		$tempName =array();
		// we're going to do this twice
		for($y=0;$y<2;$y++) {
			// we'll have 1-5 syllables.
			$numSyllables = rand(1,30)>2 ? rand(2,4) : rand(1,5);
			// build the name
			for($i=1;$i<$numSyllables;$i++) {
				if($i==1) {
					$tempName[$y] = $firstSyllables[mt_rand(0,count($firstSyllables)-1)];
				}
				elseif($i==2) {
					if($numSyllables > 2) {
						$tempName[$y] .= $secondSyllables[mt_rand(0,count($secondSyllables)-1)];
					}
					else {
						$tempName[$y] .= $lastSyllables[mt_rand(0,count($lastSyllables)-1)];
					}
				}
				else {
						$tempName[$y] .= $lastSyllables[mt_rand(0,count($lastSyllables)-1)];
				}
			}
		}
		// create our name
		$theName = $tempName[0] . ' ' . $tempName[1];
		// chance to append title
		if(mt_rand(1,100)<50) {
			$theName .=  ", ".$titles[mt_rand(0,count($titles)-1)];
		}
	}
	elseif(strtolower($nameType) == "place") {
		$firstWords = "The";
		$secondWords = array("Trembling","Dim","Familiar","Mundane","Lawful","Lively","Arduous","Mammoth","Oblong","Overlooked","Tame","Somber","Silent","Secret","Scarce","Dry","Arid","Ambiguous","Wretched","Windy","Viscous","Vicious","Torn");
		$thirdWords = array("Plains","Scape","Dominion","Ego","Truth","Falsity","Domain","Arboretum","Aviary");
		// 50% chance it will be a 2 word title
		if(mt_rand(1,100)<50) {
			// we are a 2-word title
			$theName .= $firstWords.' '.$secondWords[mt_rand(0,count($secondWords)-1)];
		}
		// 50% chance it will be a 3 word title
		else {
			$theName .= $firstWords.' '.$secondWords[mt_rand(0,count($secondWords)-1)].' '.$thirdWords[mt_rand(0,count($thirdWords)-1)];
		}
		
	}
	elseif(strtolower($nameType) == "thing") {
		$objects = array("Broadsword","Mace","Sword","Scimitar","Naginata","Spear","Sceptre","Rapier","Whip","Axe","Greataxe","Greatsword","Scythe","Orb");
		$statuses = array("Poison","Corrosion","Confusion","Might","Earthshaking","Dragonfyre","Frost","Fire","Slime","Erosion");
		// get a random name just in case
		// we'll have 1-5 syllables.
		$numSyllables = rand(1,30)>2 ? rand(2,4) : rand(1,5);
		// build the name
		for($i=1;$i<$numSyllables;$i++) {
			if($i==1) {
				$randomName = $firstSyllables[mt_rand(0,count($firstSyllables)-1)];
			}
			elseif($i==2) {
				if($numSyllables > 2) {
					$randomName .= $secondSyllables[mt_rand(0,count($secondSyllables)-1)];
				}
				else {
					$randomName .= $lastSyllables[mt_rand(0,count($lastSyllables)-1)];
				}
			}
			else {
					$randomName .= $lastSyllables[mt_rand(0,count($lastSyllables)-1)];
			}
		}
		// $randomName has a generated name
		// 50% chance to have a 2 word title, with made up name
		$preName = false;
		if(mt_rand(1,100)<50) {
			$theName = $randomName.', ';
			$preName = true;
		}
		if($preName == true) {
			$theName .= "The ".$objects[mt_rand(0,count($objects)-1)];
			if(mt_rand(1,100)<50) {
				if(mt_rand(1,100)<33) {
					$theName .= " of Dark ".$statuses[mt_rand(0,count($statuses)-1)];
				}
				elseif(mt_rand(1,100)<66) {
					$theName .= " of Holy ".$statuses[mt_rand(0,count($statuses)-1)];
				}
				else {
					$theName .= " of ".$statuses[mt_rand(0,count($statuses)-1)];
				}
			}
		}
		else {
			$theName .= "The ".$objects[mt_rand(0,count($objects)-1)];
			if(mt_rand(1,100)<33) {
				$theName .= " of Dark ".$statuses[mt_rand(0,count($statuses)-1)];
			}
			elseif(mt_rand(1,100)<66) {
				$theName .= " of Holy ".$statuses[mt_rand(0,count($statuses)-1)];
			}
			else {
				$theName .= " of ".$statuses[mt_rand(0,count($statuses)-1)];
			}
		}
	}
	return $theName;
}
?>
