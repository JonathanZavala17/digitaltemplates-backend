<?php
if(!function_exists("upload_image")){

    function upload_image($file, $path)
    {
        $ci =& get_instance();
        $_FILES['file']['name'] = $_FILES[$file]['name'];
        $_FILES['file']['type'] = $_FILES[$file]['type'];
        $_FILES['file']['tmp_name'] = $_FILES[$file]['tmp_name'];
        $_FILES['file']['error'] = $_FILES[$file]['error'];
        $_FILES['file']['size'] = $_FILES[$file]['size'];

        $config['upload_path'] = $path;
        $config['allowed_types'] = 'jpg|jpeg|png|bmp';

        $info = new SplFileInfo( $_FILES[$file]['name']);
        $name = uniqid(date("dmYHi")).".".$info->getExtension();
        $config['file_name'] = $name;
        $ci->upload->initialize($config);
        $ci->load->library('upload', $config);
        if ($ci->upload->do_upload('file')) return $path.$name;
        else return null;
    }

}