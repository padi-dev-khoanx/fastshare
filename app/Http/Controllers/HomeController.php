<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileUpload;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function upload(Request $request)
    {
        $now = strtotime(Carbon::now());
        $data['name'] = $request->file('file_share')->getClientOriginalName();
        $data['type'] = $request->file('file_share')->getClientOriginalExtension();
        $data['size'] = $request->file('file_share')->getSize();
        $data['path'] = $request->file('file_share')->move('upload', $data['name'].$now);
        $data['path_download'] = '';

        $dataCreated = FileUpload::create($data);
        $path_download = trim(base64_encode(str_pad($dataCreated->id, 6, '.')), '=');

        $data['path_download'] = $path_download;
        $query = FileUpload::find($dataCreated->id);
        $query['path_download'] = $path_download;
        $query->save();

        return response()->json(['path_download'=> $path_download]);
    }
    public function download($path)
    {
        $idFile = trim(base64_decode($path), '.');
        $file = FileUpload::find($idFile);
        $isExists = File::exists($file->path);
        return view('download', compact('file', 'isExists'));
    }
    public function downloadFile(Request $request)
    {
        $pathToFile = 'upload/' . substr($request->filePath,7);
        $name = $request->fileName;
        return response()->download($pathToFile, $name)->deleteFileAfterSend(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
