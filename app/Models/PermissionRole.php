<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class PermissionRole extends Model
{
    protected $table = 'permission_roles';
	protected $guarded = [];
	public $timestamps = false;

	public static function get_permission_role($parent_id, $role_id)
    {
        return DB::select(DB::raw("
            SELECT a.`id`, a.is_parent, a.parent_id, a.`name`, a.`display_name`, b.role_id 
            FROM permissions a
            LEFT JOIN (
            SELECT * FROM `permission_roles` WHERE role_id = {$role_id}
            ) b ON a.id = b.permission_id
            WHERE a.parent_id = {$parent_id}
        "));
    }
}
