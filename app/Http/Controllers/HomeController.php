<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileUpload;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\File;
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
        // $validatedData = $request->validate([
        //     'file' => 'required|max:2048',
        // ]);
        $name = $request->file('file_share')->getClientOriginalName();
        $type = $request->file('file_share')->getClientOriginalExtension();;
        $path = $request->file('file_share')->move('upload', $name);
        $data['name'] = $name;
        $data['path'] = $path;
        $data['type'] = $type;
        FileUpload::create($data);
        return redirect('/');
    }
    public function download($path)
    {
        $pathToFile = 'upload/'.$path;
        $isExists = File::exists($pathToFile);
        return view('download', compact('path', 'isExists'));
    }
    public function downloadFile(Request $request)
    {
        $pathToFile = 'upload/'.$request->filePath;
        $name = $request->filePath;
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
