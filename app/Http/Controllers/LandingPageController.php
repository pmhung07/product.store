<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LandingPageController extends Controller
{
    public function getPreview(){
    	$length = 10;
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }

	    $filename = $_SERVER['DOCUMENT_ROOT']."/public/site-builder/elements/preview_".$randomString.".html";

	    //echo $filename;die();
	
		$previewFile = fopen($filename, "w");
		fwrite($previewFile, stripcslashes($_POST['page']));
		fclose($previewFile);
		
		return view('landingpage.index', ['data' => $filename]);
    }
}
