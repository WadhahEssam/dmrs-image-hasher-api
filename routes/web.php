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

Route::post('/test', function (Request $request) {
    if ($request->hasFile('image')) {

        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = storage_path('/public/images');
        $image->move($destinationPath, $name);

        return response()->json(['data'=>"image is uploaded"]);
    } else {
        return 0;
    }

    exit();
    

    return 'looks good';
    $file_name = generateRandomString();
    $content = $request->input('content');
    Storage::disk('public')->put($file_name.'.txt', $content);
    return $file_name;
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