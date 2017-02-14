<?php

namespace App\Http\Middleware;

use Closure;
use Route;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  权限列表  $model
     * @return mixed
     */
    public function handle($request, Closure $next, $model)
    {
        $routeName = Route::currentRouteName();
        $permission = '';
        switch ($routeName) {
            case $model.'.index':
            case $model.'.ajaxIndex':
                $permission = config('admin.permissions.'.$model.'.list','');
                break;
            case $model.'.create':
            case $model.'.store':
                $permission = config('admin.permissions.'.$model.'.add','');
                break;
            case $model.'.edit':
            case $model.'.update':
                $permission = config('admin.permissions.'.$model.'.edit','');
                break;

            default:
                $permission = config('admin.permissions.'.$model,'');
                break;
        }
        if (!$request->user()->can($permission)){
            abort(500,trans('没有权限进行操作'));
        }
        return $next($request);
    }
}
