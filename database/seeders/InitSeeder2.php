<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Permission;
use App\Models\Role;

// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;

class InitSeeder2 extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(2);

        //  $role = Role::find(2);
        $role = Role::create([
            'name' => 'Admin',
            'id_aplicacion' => 3,
        ]);
        setPermissionsTeamId(3);  //id de la apliacacion
        $permiso = Permission::create(['name' => 'o-filtros']);
        // $permiso = Permission::find(1);

        $role->givePermissionTo($permiso);
        $user->assignRole($role);
        return $user;
    }
}
