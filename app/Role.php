<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];

    public function perms()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function hasPermission($permission)
    {
        foreach ($this->perms as $permsItem) {
            if ($permsItem->name === $permission) {
                return TRUE;
            }
        }
    }

    public function savePermission($inputPermissions)
    {
        if (!empty($inputPermissions)){
            $this->perms()->sync($inputPermissions);
        }else {
            $this->perms()->detach();
        }
    }
}
