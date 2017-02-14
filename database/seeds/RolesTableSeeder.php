<?php

use Illuminate\Database\Seeder;
use \App\Models\Role;
use App\Models\Permission;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = '超级管理员';
        $admin->description = '超级管理员';
        $admin->save();

        $owner = new Role();
        $owner->name = 'user';
        $owner->display_name = '普通管理员';
        $owner->description = '普通管理员';
        $owner->save();

        $allPermission = array_column(Permission::all()->toArray(),'id');
//        等价下一句
        $admin->perms()->sync($allPermission);
//        $admin->attachPermission($allPermission);

        $createUser = Permission::where('display_name','添加菜单')->first();
        $loginBackend = Permission::where('name','system.login')->first();
        $owner->attachPermission($createUser,$loginBackend);
    }
}
