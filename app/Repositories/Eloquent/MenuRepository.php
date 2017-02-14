<?php
namespace App\Repositories\Eloquent;

use App\Models\Menu;
use App\Repositories\Eloquent\Repository;
use Cache;

class MenuRepository extends Repository
{
    public function model()
    {
        return Menu::class;
    }

    public function sortMenu($menus,$pid=0)
    {
        $arr = [];

        if (empty($menus)){
            return '';
        }

        foreach ($menus as $k => $v){
            if($v['parent_id'] == $pid){
                $arr[$k] = $v;
                $arr[$k]['child'] = self::sortMenu($menus,$v['id']);
            }
        }

        return $arr;
    }

    public function sortMenuSetCache()
    {
        $menus = $this->model->orderBy('sort','desc')->get()->toArray();

        if ($menus){
            $menuList = $this->sortMenu($menus);
            foreach ($menuList as $key => &$v) {
                if ($v['child']) {
                    $sort = array_column($v['child'],'sort');
                    array_multisort($sort,SORT_DESC,$v['child']);
                }
            }

            Cache::forever(config('admin.globals.cache.menuList'),$menuList);
            return $menuList;
        }
        return '';
    }

    public function getMenuList()
    {
        if (Cache::has(config('admin.globals.cache.menuList'))){
            return Cache::get(config('admin.globals.cache.menuList'));
        }
        return $this->sortMenuSetCache();
    }

    public function updateMenu($request)
    {
        $menu = $this->model->find($request->id);
        if ($menu){
            $isUpdate = $menu->update($request->all());
            if ($isUpdate){
                $this->sortMenuSetCache();
                flash('修改菜单成功','success');
                return true;
            }
            flash('修改菜单失败','error');
            return false;
        }
        abort(404,'菜单数据找不到');
    }

    public function destroyMenu($id){
        $isDelete = $this->model->destroy($id);
        if ($isDelete) {
            // 更新缓存数据
            $this->sortMenuSetCache();
            flash('删除菜单成功', 'success');
            return true;
        }
        flash('删除菜单失败', 'error');
        return false;
    }

    public function editMenu($id)
    {
        $menu = $this->model->find($id)->toArray();
        if ($menu) {
            $menu['update'] = url('admin/menu/'.$id);
            $menu['msg'] = '加载成功';
            $menu['status'] = true;
            return $menu;
        }
        return ['status' => false,'msg' => '加载失败'];
    }
}