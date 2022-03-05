<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();

        $adminRole = Role::create(['name' => 'admin','view_name' => 'أدمن']);
        $supervisor_Role = Role::create(['name' => 'supervisor','view_name' => 'مشرف']);
        $representative_Role = Role::create(['name' => 'representative','view_name' => 'مندوب']);


        $permissions = Permission::get(['id'])->toArray();
        $adminRole->syncPermissions($permissions);



        $admin = User::updateOrCreate(
                ['id'=>1],
                [
                    'name'=>'admin',
                    'user_name'=>'admin',
                    'phone'=>'01234567891',
                    'government'=>'الدقهليه',
                    'city'=>'المنصوره',
                    'representative_city_id'=>'1',
                    'id_number'=>'12345678901234',
                    'email'=>'admin@admin.com',
                    'password'=>Hash::make('admin') //password

                ]);

        $admin->assignRole($adminRole);


    }
}
