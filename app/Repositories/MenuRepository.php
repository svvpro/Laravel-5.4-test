<?php
/**
 * Created by PhpStorm.
 * User: SVV
 * Date: 31.08.2017
 * Time: 15:24
 */

namespace App\Repositories;
use App\Menu;


class MenuRepository extends Repository
{
    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }

    public function getAllMenu()
    {
        return $this->getAll();
    }
}