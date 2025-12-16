<?php

use Illuminate\Http\Request;
use App\Utils\GeographicPointUtil;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::get('/user', function (Request $request) {
//     dd(auth()->user());
// return ["id"=> auth()->user()->id, "name"=>"tamer"];
// });
Route::post('/user', function (Request $request) {
    $search = $request->get("search");
    $users = \App\Models\User::orderby('name','asc')->select('id','name as text');
    if ($search) {
        $users = $users->where('name', 'like', '%' . $search . '%')->get();
    }
    return $users;
})->name('users.api');

Route::post('/coord/utm', function (Request $request) {
    $easting = $request->get("easting");
    $northing = $request->get("northing");

    if ($easting && $northing) {
        $result = GeographicPointUtil::createXYPoint($easting,$northing);
    }
    return $result;

})->name('coord.GetUTM');

Route::get('/coord/utm/{easting}/{northing}', function ($easting , $northing) {
    // $easting = $request->get("easting");
    // $northing = $request->get("northing");

    if ($easting && $northing) {
        $result = GeographicPointUtil::createXYPoint($easting,$northing);
    }
    return $result;

})->name('coord.utm');
