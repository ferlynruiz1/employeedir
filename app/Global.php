<?php

use Carbon\Carbon;

// *********** COSTUME METHOD ***********************************
function getNameFromNumber($num) {
    $numeric = ($num - 1) % 26;
    $letter = chr(65 + $numeric);
    $num2 = intval(($num - 1) / 26);
    if ($num2 > 0) {
        return getNameFromNumber($num2) . $letter;
    } else {
        return $letter;
    }
}
function genderValue($gender)
{
	if ($gender == 'Female' || $gender == 'F' || $gender == 'FEMALE') {
		return 2;
	} else if ($gender == 'Male' || $gender == 'M' || $gender == 'MALE') {
		return 1;
	} else {
		return 0;
	}
}
function genderStringValue($gender)
{
	switch ($gender) {
		case '1':
			return "MALE";
		case 1:
			return "MALE";
		case '2';
			return "FEMALE";
		case 2:
			return "FEMALE";
		default:
			return "";
	}
}
function joinGrammar($prod_date)
{
	$prod_date_timestamp = strtotime($prod_date);
	$current_timestamp = time();

	if($prod_date_timestamp > $current_timestamp){
		return "Will join";
	}
	return "Joined";
}
function monthDay($prod_date)
{
	if (isset($prod_date)) {
        $dt = Carbon::parse($prod_date);
        return $dt->format('M d');
    } else {
        return "";
    } 
}
function slashedDate($prod_date)
{
	if (isset($prod_date)) {
        $dt = Carbon::parse($prod_date);
        return $dt->format('m/d/Y');
    } else {
        return "";
    } 
}

function truncate($string, $length, $html = true)
{
    if (strlen($string) > $length) {
        if ($html) {
            // Grabs the original and escapes any quotes
            $original = str_replace('"', '\"', $string);
        }

        // Truncates the string
        $string = substr($string, 0, $length);

        // Appends ellipses and optionally wraps in a hoverable span
        if ($html) {
            $string = '<span title="' . $original . '">' . $string . '&hellip;</span>';
        } else {
            $string .= '...';
        }
    }

    return $string;
}
function curl_get_contents($url)
{
	$ch = curl_init();
	$timeout = 5;

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

	$data = curl_exec($ch);

	curl_close($ch);

	return $data;
}
