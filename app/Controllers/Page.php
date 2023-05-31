<?php

namespace App\Controllers;

class Page extends BaseController
{
    public function index()
    {
        $data = array(
            'title' => 'Home',
            'isi' => 'layout/page/main_page'
        );
        return view('layout/page/v_wrapper', $data);
    }
}
