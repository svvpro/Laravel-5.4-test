<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class IndexController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->template = 'admin.index';

    }

    public function index()
    {
        if (Gate::denies('SHOW_ADMIN')) {
            echo 'You have no-permission';
            exit();
        }

        $this->title = 'Admin manager';
        $this->content = 'Admin panel';

        return $this->renderOutput();
    }
}
