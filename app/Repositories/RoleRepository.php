<?php
/**
 * Created by svv.one
 * User: Slobodyanik Vladimir
 * Date: 04.09.2017
 * Time: 18:03
 */

namespace App\Repositories;


use App\Role;

class RoleRepository extends Repository
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function getAllRoles()
    {
        return $this->getAll();
    }
}