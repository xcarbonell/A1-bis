<?php
/**
     * returns url route
     * 
     */
function getRoute():string{
    if(isset($_REQUEST['url'])){
        $url = $_REQUEST['url'];
    }else{
        $url='home';
    }
    switch($url){
        //acceso a vista
        case 'login':
            return 'login';
        case 'register':
            return 'register';
        //acceso a proceso login
        case 'register_action';
            return 'registerAction';
        case 'loginAction':
            return 'loginAction';
        //acceso a dashboard
        case 'dashboard':
            return 'dashboard';
        default:
        return 'home';
    }
}