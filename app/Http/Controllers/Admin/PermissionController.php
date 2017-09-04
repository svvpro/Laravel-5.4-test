<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends AdminController
{

    protected $p_rep;
    protected $r_rep;

    public function __construct(PermissionRepository $p_rep, RoleRepository $r_rep)
    {
        parent::__construct();
        $this->p_rep = $p_rep;
        $this->r_rep = $r_rep;
        $this->template = 'admin.index';
    }

    public function index()
    {
        $this->title = 'Permission manager';

        $permissions = $this->p_rep->getAllPermissions();
        $roles = $this->r_rep->getAllRoles();

        $this->content = view('admin.permissions.form', compact('permissions', 'roles'));

        return $this->renderOutput();
    }

    public function store(Request $request)
    {
        $result = $this->p_rep->changePermission($request);

        if (is_array($result) && !empty($result['error'])) {
            return redirect()->back()->with($result);
        }

        return redirect()->back()->with($result);
    }
}
