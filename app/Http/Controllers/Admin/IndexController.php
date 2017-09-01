<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->template = 'admin.index';
    }

    public function index()
    {

        $this->title = 'Admin manager';
        $this->content = 'Admin panel';

        return $this->renderOutput();
    }
}
