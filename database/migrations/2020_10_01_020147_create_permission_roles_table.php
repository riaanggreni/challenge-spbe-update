<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_roles', function (Blueprint $table) {
			$table->collation = 'utf8mb4_general_ci';
			$table->integer('role_id');
			$table->integer('permission_id');
			
			$table->foreign('permission_id')->references('id')->on('permissions');
			$table->unique(['role_id', 'permission_id'], 'unique_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_roles');
    }
}
