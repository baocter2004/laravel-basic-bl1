<?php

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    //where clasuses
    // $users = DB::table('users')
    //     ->where(
    //         function (Builder $query) {
    //             $query->where('name', 'Abigail')
    //                 ->orWhere('votes', '>', 50);
    //         }
    //     )
    //     ->orWhere('is_vip', true)
    //     ->toRawSql();
    // dd($users);

    // join advance
    // $joinAdvance = DB::table('users')
    //     ->join('contacts', function (JoinClause $join) {
    //         $join->on('users.id', '=', 'contacts.user_id')
    //             ->where('contacts.user_id','>',100);
    //     })
    //     ->where('status',1)
    //     ->toRawSql();
    // dd($joinAdvance);


    // join

    // $users = DB::table('users as u')
    //     ->join('c as c', 'u.id', '=', 'c.user_id')
    //     ->join('o as o', 'u.id', '=', 'o.user_id')
    //     ->select('u.*', 'c.phone as c_phone', 'o.price as o_price')
    //     ->toRawSql();
    // dd($users);


    // raw
    // $users = DB::table('users')
    //     ->selectRaw('count(*) as user_count, status')
    //     ->where('status', '<>', 1)
    //     ->groupBy('status')
    //     ->toRawSql();
    // dd($users);

    // $orders = DB::table('orders')
    //     ->selectRaw('price * ? as price_with_tax', [1.0825])
    //     ->toRawSql();
    // dd($orders);


    // addSElect
    /*
    $query = DB::table('users')->select('name', 'email as user_email');

    $users = $query
        ->limit(10)
        ->get();

    $users2 = $query
        ->addSelect('password')
        ->limit(10)
        ->get();

    dd($users,$users2);
    */

    // Các Hàm Trong laravel
    /* 
    $count = $query->count();
    $sum = $query->sum('id');
    $avg = $query->where('id','>',100)->avg('id');
    $min = $query->min('id');
    $max = $query->max('id');

    dd($count,$sum,$avg,$min,$max);
    */

    //chunk
    /*
    $query->orderBy('id')->chunk(100, function (Collection $users) {
        // dd($users);

        foreach ($users as $user) {
            // ...
        }
    });
    */

    // pluck
    /*
    $name = $query->pluck('name','id');

    dd($name);
    */

    // $first = $query->first(); #trả về 1 stdClass

    // dd($first);


    // $first = $query->findOr(3333, function () {
    //     abort(404);
    // });

    return view('welcome');
});
