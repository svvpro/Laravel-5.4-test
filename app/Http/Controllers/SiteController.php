<?php

namespace App\Http\Controllers;

use App\Repositories\MenuRepository;
use Illuminate\Http\Request;

abstract  class SiteController extends Controller
{
    protected $m_rep;
    protected $a_rep;
    protected $c_rep;
    protected $template;
    protected $vars = [];

    public function __construct(MenuRepository $m_rep)
    {
        $this->m_rep = $m_rep;
    }

    public function renderOutput()
    {

        $menus = $this->m_rep->getAllMenu();
        $navigation = view('partials.navigation')->with('menus', $menus)->render();
        $this->vars = array_add($this->vars, 'navigation', $navigation);


        return view($this->template)->with($this->vars);
    }
}
