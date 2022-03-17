<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use App\Models\Visit;
use Response;

class FileUpload extends Controller
{
	public function index(){
		return view('file-upload');
	}
	
	public function upload_file(Request $req){
		$req->validate([
			'file' => 'required|mimes:png,jpg,jpeg,zip,rar,ini,webm,mp4,avi,exe,gif,jar,csv,txt,xlx,xls,pdf|max:4096'
		]);
		$fileModel = new File();
		if($req->file()) {
			$fileName = time().'_'.$req->file->getClientOriginalName();
			$filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
			$fileModel->name = time().'_'.$req->file->getClientOriginalName();
			$fileModel->file_path = $filePath;
			$fileModel->save();
			return redirect()->route('url_file', $fileModel->id);
		}
	}
	
	public function get_file(Request $req, $id) {
		$file = File::find($id);
		if ($file === null) return abort(404);
        $file_content = Storage::disk('public')->get($file->file_path);
        $type = Storage::disk('public')->mimeType($file->file_path);
		$v = new Visit();
		$v->file_id = $file->id;
		$v->ip = $req->ip();
		$v->save();
        return Response::make($file_content, 200)->header("Content-Type", $type);
	}
	
	public function get_visits($id) {
		$file = File::find($id);
		if ($file === null) return abort(404);
		$ips = $file->visits;
		return '<pre>'.json_encode($ips, JSON_PRETTY_PRINT).'</pre>';
	}
}
