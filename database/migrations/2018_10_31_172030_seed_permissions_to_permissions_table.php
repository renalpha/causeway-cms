<?php

use Illuminate\Database\Migrations\Migration;

class SeedPermissionsToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permission = \Spatie\Permission\Models\Permission::create([
            'name' => 'manage.group',
        ]);

        $role = \Spatie\Permission\Models\Role::where('name', 'user')->first();
        if (isset($role)) {
            $role->givePermissionTo($permission);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Not implemented...
    }
}
