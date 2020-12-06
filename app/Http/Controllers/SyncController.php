<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SyncController extends Controller
{
    public function syncbin(Request $request, $id){
		
		 echo "para id".$id;
		 //$getid= $request->id;
		

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://lookup.binlist.net/$id",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_HTTPHEADER => array(
			'Accept-Version: 3'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$fetch_data = json_decode($response);
		
		echo "<pre>";
			print_r($fetch_data);
		echo "</pre>";
		
	}
}
