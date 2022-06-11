<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	protected $table = 'permissions';
	protected $guarded = [];

	public function permission_roles()
	{
		return $this->hasMany(PermissionRole::class);
	}

	public function parent()
	{
		return $this->hasOne('App\Models\Permission', 'id', 'parent_id');
	}
}
