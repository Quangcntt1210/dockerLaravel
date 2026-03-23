<?php
use App\Jobs\NewJob;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');

});
Route::get('/test-db', function () {
    return DB::table('users')->get();
});

Route::get('/send-mail', function () {
    $users = User::get();
    foreach ($users as $user) {
        NewJob::dispatch($user->email, $user->name);
    }
    return 'Đã đưa ' . count($users) . ' job vào Redis queue!';
});