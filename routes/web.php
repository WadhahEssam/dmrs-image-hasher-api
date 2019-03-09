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
    // i disabled csrf in order for the post to run from anywhere
    $validator = Validator::make($request->all(), [
        'file'=>'required|image|mimes:jpeg,png,jpg,pmp|max:100000'
    ])->validate();
    
    $file = $request->file('file');
    $file_name = generateRandomString().'.'.$file->getClientOriginalExtension().'';
    Storage::disk('public')->putFileAs('files', $file, $file_name);

    return response()->json(['hash'=>$file_name]);
});

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}