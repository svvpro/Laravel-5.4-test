<?php
/**
 * Created by svv.one
 * User: Slobodyanik Vladimir
 * Date: 04.09.2017
 * Time: 17:59
 */

namespace App\Repositories;


use App\Permission;

class PermissionRepository extends Repository
{
    protected $r_rep;

    public function __construct(Permission $permission, RoleRepository $r_rep)
    {
        $this->model = $permission;
        $this->r_rep = $r_rep;
    }

    public function getAllPermissions()
    {
        return $this->getAll();
    }

    public function changePermission($request)
    {
        $data = $request->except('_token');

        $roles = $this->r_rep->getAllRoles();

        foreach ($roles as $role) {
            if (isset($data[$role->id])) {
                $role->savePermission($data[$role->id]);
            } else {
                $role->savePermission([]);
            }
        }

        return ['status' => 'Permissions updated'];
    }
}