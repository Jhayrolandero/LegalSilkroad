<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class testController extends Controller
{


    /**
     * Example of putting files as 'local' disk
     * @return void
     */
    public function putFiles() {
        Storage::disk('local')->put('example.txt', 'Holaa');
        Storage::disk('local')->put('dir/dir.txt', 'Directory file');
        Storage::disk('public')->put('public.txt', 'this is public');
    }

    /**
     * Getting File
     * 
     * @return mixed|string|\Illuminate\Http\JsonResponse|null
     */
    public function getFile() {
        $image = Storage::disk('local');
        if ($image->exists('dir.txt')) {
            return $image->get('example.txt');
        } else {
            return response()->json($image->exists('dir.txt'));
        }
    }

    /**
     * Download a file
     * 
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadFile() {
        // skipcq: PHP-E1002
        return Storage::disk('public')->download('public.txt');
    }

    public function getFileUrl() {
        return response(Storage::disk('public')->url('example.txt'));
    }


    public function fileUpload(Request $request) {

        // Put the file into avatas folder
        // $path = $request->file('photo')->store('avatas');
        
        
        // SPecifying what the uploaded file name
        $path = $request->file('photo')->storeAs('avatas',"Lollers");

        return response($path);
    }

}
