<?php

namespace app\lib;

class UserOperation{
    const RoleGuest='guest';
    const RoleAdmin='admin';
    const RoleUser='user';

    const RoleSeller='seller';

    public static function getRoleUser(){
        $result=self::RoleGuest;
        if (isset($_SESSION['user']['id'])&& isset($_SESSION['user']['is_admin'])){
            $result=self::RoleAdmin;
        } elseif (isset($_SESSION['user']['id'])){
            $result=self::RoleUser;
        }elseif (isset($_SESSION['user']['is_seller'])){
            $result=self::RoleSeller;
        }
        return $result;
    }
    public static function getMenuLinks(){
        $role=self::getRoleUser();
        $list[]=[
            'title'=>'My profile',
            'link'=>'/user/profile'
        ];
//        $list[]=[
//            'title'=>'Новости',
//            'link'=>'/news/list'
//        ];
//        if ($role === self::RoleAdmin){
//            $list[]=[
//                'title'=>'Пользователи',
//                'link'=>'/user/users'
//            ];
//        }
        if ($_SERVER['REQUEST_URI'] != '/main/index'){
            $list[] = [
                'title' => 'Magazine',
                'link' => '/magazineBlock/listStock'
            ];
        }
        $list[]=[
            'title'=>'Exit',
            'link'=>'/user/logout'
        ];
        return $list;
    }
}
