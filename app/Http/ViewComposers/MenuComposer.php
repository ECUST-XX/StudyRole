<?php
namespace App\Http\ViewComposers;


use App\Repositories\Eloquent\MenuRepository;
use Illuminate\Contracts\View\View;

class MenuComposer
{
    Protected $menu;

    public function __construct(MenuRepository $menu)
    {
        $this->menu = $menu;
    }

    public function compose(View $view){
        $view->with('sidebarMenus', $this->menu->getMenuList());
    }
}