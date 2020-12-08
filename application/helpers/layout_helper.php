<?php
if (!function_exists('layout')) {
    function layout($view, $view_data = array(),$extras = array()) {
        $ci =& get_instance();
        $ci->load->model('MenuModel');
        $username_session = $ci->session->username;
        if(!isset($username_session)){
            redirect('admin', 'refresh');
        }
        $picture_session = $ci->session->picture;
        $id_user = $ci->session->id_user;
        $id_store = $ci->session->id_store;
        $admin = $ci->session->admin;

        $menus = $ci->MenuModel->get_menu($id_store,$id_user,$admin);
        $controller_base = $ci->MenuModel->get_controller($id_store,$id_user,$admin);
        $controller = array();
        foreach ($menus as $menu)
        {
            $id_menu = $menu->id_menu;
            $controller[$id_menu] = array_filter($controller_base, function($controller) use ($id_menu)
            {
                return $controller->id_menu == $id_menu;
            });
        }
        $menu_data = array(
            'menus'=>$menus,
            'controller'=>$controller,
            'username_session' => $username_session,
            'picture_session' => $picture_session,
            'admin'=>$admin,
        );

        $ci->load->view('template/header',$extras);
        $ci->load->view('template/menu',$menu_data);
        $ci->load->view($view, $view_data);
        $ci->load->view('template/footer');
        $ci->load->view('template/scripts',$extras);
        return true;
    }
}
if(!function_exists("user_permission")){
    function user_permission(){
        
    }
}