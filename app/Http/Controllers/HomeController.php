<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    private $menu;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function test()
    {
//        $a = Redis::set('name2', 'Taylor');
//        $a = User::select('name')->get()->toArray();
//        var_dump($a);
//        $a = Role::where('name','admin')->first();
//        $u = User::where('name','admin')->first();
//        $a->getKey();
//        dd($u);
//        $w = $u->each(
//            function($u) use ($a){
//                // $u->roles()->attach([$admin->id]);
//                $u->attachRoles($a);
//            });

//        $a = $a->getKey();
//        var_dump($a);
//        $a = $a['id'];
//
//        dd($a);

//        dd(auth()->user()->hasRole('a'));

//        dd(auth()->user()->can('*users'));
//        dd(auth()->user()->can(['create users','asdasd'],true));

//        dd(auth()->user()->hasRole(['admin','user']));
//        dd(auth()->user()->ability('user','edit users',['validate_all' => false,'return_type'  => 'both']));
//abort(404);
//        dd(config('admin.permissions.menu.add'));
        dd(config('admin.permissions.permission.show'));
    }
}
