<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

abstract class AdminController extends Controller
{
    protected $title;
    protected $template;
    protected $vars = [];
    protected $content;

    public function __construct()
    {

    }

    protected function renderOutput()
    {

        $navigation = view('partials.admin-navigation')->render();
        $this->vars = array_add($this->vars, 'navigation', $navigation);

        $this->vars = array_add($this->vars, 'title', $this->title);

        $this->vars = array_add($this->vars, 'content', $this->content);

        return view($this->template)->with($this->vars);
    }
}
