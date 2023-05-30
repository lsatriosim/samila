<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UploadController extends Controller
{
    public function view(){
        $suspiciousAccounts = DB::table('suspiciousAccounts')->where("is_sus", 1)->get();
        return view('main', compact("suspiciousAccounts"));
    }

	public function proses_upload(Request $request){
		$this->validate($request, [
			'file' => 'required',
		]);

		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');

        $nama_file = time()."_".$file->getClientOriginalName();

		$tujuan_upload = 'file_analysist';

                // upload file
		$file->move($tujuan_upload,$file->getClientOriginalName());

        File::create([
            'file'=> $nama_file,
        ]);
	}
}
