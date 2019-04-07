<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    return 'upload images to /upload by posting them and putting them into a file attributte';
});

Route::post('/upload', function (Request $request) {
    Log::info('This is some useful information.');
    // i disabled csrf in order for the post to run from anywhere
    $validator = Validator::make($request->all(), [
        'file'=>'required|image|mimes:jpeg,png,jpg,pmp|max:100000'
    ])->validate();
    
    $hash = hash_file ('md5', $request->file);
    $file = $request->file('file');
    $file_name = $hash.'.'.$file->getClientOriginalExtension();
    Storage::disk('public')->putFileAs('files', $file, $file_name);

    return response()->json(['hash'=>$file_name]);
});
