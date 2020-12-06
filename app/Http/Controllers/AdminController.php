<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\BinList;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard(){
		return view('admin.dashboard_view');
	}
	
	public function allbin(Request $request){
		$BinList = new BinList();
		
		if($request->isMethod('post')){
			$data = $request->input();
			$binprefix = $data['binprefix'];
			
			$allbin = $BinList->where('binprefix',$binprefix)->orderBy('created_at', 'DESC')->paginate(3);
		}else{
			$allbin = $BinList->orderBy('created_at', 'DESC')->paginate(50);
		}
		
		
		return view('admin.allbin_view')->with(compact('allbin'));
	}
	
// Insert Bin	
	public function insertBin(Request $request){
		
		 $current_date_time = Carbon::now()->toDateTimeString(); 
	
		if($request->isMethod('post')){
			
			 $rules = [
				'binprefix' => 'required|unique:bin_lists'
				];
				$validator = Validator::make($request->all(),$rules);
				if ($validator->fails()) {
					return back()->withInput()->withErrors($validator);
				}else{
					$data = $request->input();
					
					$binprefix = $data['binprefix'];
					$country = $data['country'];
					
					$bin_array = explode(PHP_EOL, $binprefix);
					$bin_count = count($bin_array);
					
					for($i=0; $i < $bin_count; $i++){
						$single_bin = $bin_array[$i];
						
						$clean_bin = (int) filter_var($single_bin, FILTER_SANITIZE_NUMBER_INT);
						
						if($clean_bin!=null || $clean_bin!=0){
							
							$bin_exist = DB::table('bin_lists')->where('binprefix',$clean_bin)->count();

							if($bin_exist){
								$bin_update_data[] = array('created_at'=>$current_date_time,'updated_at'=>$current_date_time);
								
								DB::table('bin_lists')->where('binprefix', $clean_bin)->update(['created_at' => $current_date_time,'updated_at' =>  $current_date_time]);
							}else{
								$bin_insert_data[] = array('country'=>$country,'binprefix'=>$clean_bin,'created_at'=>$current_date_time,'updated_at'=>$current_date_time);
							}
						}
					}
					if(!empty($bin_insert_data)){
						DB::table('bin_lists')->insert($bin_insert_data);
					}
	
					return redirect('admin/insertBin')->with('success',"Bin Added Successfully");
				}
		}else{
			
			return view('admin.insertbin_view');
		}
		
	}
	
// Bin lookup //	
	public function syncbin(Request $request){
		
		$bin_list = DB::table('bin_lists')->select('binprefix')->where('binlist','unchecked')->get();

		foreach($bin_list as $bins){
			
			$bin_prefix = $bins->binprefix;
			
			$clean_bin = substr($bin_prefix, 0, 6); 
		
		 	$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://lookup.binlist.net/$clean_bin",
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
			
			@$country = $fetch_data->country->name;
			@$type = $fetch_data->scheme;
			@$bank = $fetch_data->bank->name;
			@$brand = $fetch_data->type;
			@$sub_brand = $fetch_data->brand;
			@$prepaid = $fetch_data->prepaid;
			
			if($prepaid==0 || $prepaid==null || $prepaid==false){
				$prepaid_status = "no";
			}else{
				$prepaid_status = "yes";
			}
		
			DB::table('bin_lists')
							->where('binprefix', $bin_prefix)
							->update(['country' =>$country,'bank'=>$bank,'brand'=>$brand,'type'=>$type,'sub_brand'=>$sub_brand,'prepaid'=>$prepaid_status,'binlist'=>'yes']); 
		}
		

		return redirect('admin/allbin')->with('success',"Bin Sync Successfully");
	}
	
	
	
}
