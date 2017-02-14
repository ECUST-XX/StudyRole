<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\MenuRepository;

class MenuController extends Controller
{
    private $menu;

    public function __construct(MenuRepository $menu)
    {
        $this->menu = $menu;
    }

    public function index()
    {
        $menu = $this->menu->findByField('parent_id',0);
        $menuList = $this->menu->getMenuList();

        return view('admin.menu.list')->with(compact('menu','menuList'));
    }

    public function store(MenuRequest $request)
    {
        $result = $this->menu->create($request->all());

        $this->menu->sortMenuSetCache();

        if ($result) {
            flash('添加菜单成功','success');
        }else{
            flash('添加菜单失败','error');
        }
        return redirect('admin/menu');
    }

    public function edit($id)
    {
        $menu = $this->menu->editMenu($id);
        return response()->json($menu);
    }

    public function update(MenuRequest $request)
    {
        $this->menu->updateMenu($request);
        return redirect('admin/menu');
    }

    public function destroy($id)
    {
        $this->menu->destroyMenu($id);
        return redirect('admin/menu');
    }
}
