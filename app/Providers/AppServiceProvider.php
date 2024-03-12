<?php

namespace App\Providers;

use App\Models\UserGroup;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {

            // $cart = Cart::where('user_id', Auth::user()->id);
            // var_dump(Auth::user());
            $user_login =  Auth::user();
            // var_dump($user_login );
            // $permission = UserGroup::where('id', '=', $user_login->user_group_id)->first()['permissions'];
            if ($user_login) {

                // Menu
                $menus[] = array(
                    'id'       => 'menu-dashboard',
                    'icon'       => 'fa-dashboard',
                    'name'       =>  'Dashboard',
                    'href'     =>   url('/dashboard'),
                    'children' => array()
                );

                // Product item - lv1
                $product_menu = [];

                // Manufacturer list item - lv2
                if ($user_login->hasPermission("/manufacturer/list")) {
                    $product_menu[] = array(
                        'id'       => 'manufacturer-list',
                        'icon'       => 'fa-cogs',
                        'name'       =>  'Manufacturer',
                        'href'     =>   url('/manufacturer/list'),
                        'children' => array()
                    );
                }



                // Item  - lv2
                if ($user_login->hasPermission("/item/list")) {
                    $product_menu[] = array(
                        'id'       => 'user',
                        'icon'       => 'fa-box',
                        'name'       =>  'Item',
                        'href'     =>   url('/item/list'),
                        'children' => array()
                    );
                }


                $menus[] = array(
                    'id'       => 'product-menu',
                    'icon'       => 'fa-box',
                    'name'       =>  'Product',
                    'href'     =>   "#",
                    'children' => $product_menu,
                );

                if ($user_login->hasPermission("/user/list")) {
                    // User item
                    $user_menu = [];
                    if ($user_login->hasPermission("/user/list")) {
                        $user_menu[] = array(
                            'id'       => 'user',
                            'icon'       => 'fa-user',
                            'name'       =>  'User',
                            'href'     =>   url('/user/list'),
                            'children' => array()
                        );
                    }

                    if ($user_login->hasPermission("/user-group/list")) {
                        $user_menu[] = array(
                            'id'       => 'user-group',
                            'icon'       => 'fa-users',
                            'name'       =>  'User Group',
                            'href'     =>   url('/user-group/list'),
                            'children' => array()
                        );
                    }

                    $menus[] = array(
                        'id'       => 'user-menu',
                        'icon'       => 'fa-user',
                        'name'       =>  'User',
                        'href'     =>   "#",
                        'children' => $user_menu,
                    );
                }

                $menus[] = array(
                    'id'       => 'logout',
                    'icon'       => 'fa-dashboard',
                    'name'       =>  'Logout',
                    'href'     =>   url('/logout'),
                    'children' => array(),
                );

                // var_dump($menus);

                // var_dump( $permission );
                //...with this variable
                $view->with('menu', $menus);
            }
        });
    }
}
