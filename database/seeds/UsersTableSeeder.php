<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name','admin')->first();
        $usersRole = Role::where('name','user')->first();

        $admin = factory('App\User')->create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => '13673460778@163.com',
            'password' => bcrypt('123456')
        ])->each(
            function($u) use ($adminRole){
                //注意attachRole与attachRoles的区别,一个单，一个双(详见源码)
                $u->attachRole($adminRole);
        });

        $users = factory('App\User',3)->create([
            'password' => bcrypt('123456')
        ])->each(
            function ($u) use ($usersRole){
                $u->attachRole($usersRole);
            }
        );

    }
}
