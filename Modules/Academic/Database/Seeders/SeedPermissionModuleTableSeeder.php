<?php

namespace Modules\Academic\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Entities\SetModule;
use Modules\Setting\Entities\SetModulePermission;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class SeedPermissionModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $module = SetModule::create([
            'uuid' => Str::uuid(),
            'logo' => 'academic',
            'label' => 'Academico',
            'destination_route' => 'academic_dashboard',
            'status' => true
        ]);

        $permissions = [];
        
        array_push($permissions,Permission::create(['name' => 'academico']));
        array_push($permissions,Permission::create(['name' => 'academico_cursos']));
        array_push($permissions,Permission::create(['name' => 'academico_cursos_nuevo']));
        array_push($permissions,Permission::create(['name' => 'academico_cursos_editar']));
        array_push($permissions,Permission::create(['name' => 'academico_cursos_eliminar']));
        array_push($permissions,Permission::create(['name' => 'academico_tipo_contenido']));
        array_push($permissions,Permission::create(['name' => 'academico_tipo_contenido_nuevo']));
        array_push($permissions,Permission::create(['name' => 'academico_tipo_contenido_editar']));
        array_push($permissions,Permission::create(['name' => 'academico_tipo_contenido_eliminar']));
        array_push($permissions,Permission::create(['name' => 'academico_secciones']));
        array_push($permissions,Permission::create(['name' => 'academico_secciones_nuevo']));
        array_push($permissions,Permission::create(['name' => 'academico_secciones_editar']));
        
        $role = Role::find(1);
        foreach($permissions as $permission){
            SetModulePermission::create([
                'module_id' => $module->id,
                'permission_id' => $permission->id
            ]);
            $role->givePermissionTo($permission->name);
        }
    }

}
