<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class PermissionSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Permission::truncate();

        //user
        $permissionIndexUser = Permission::create(['name' => 'index_user', 'view_name' => 'كل المستخدمين']);
        $permissionCreateUser = Permission::create(['name' => 'create_user', 'view_name' => 'إنشاء مستخدم']);
        $permissionEditUser = Permission::create(['name' => 'edit_user', 'view_name' => 'تعديل المستخدم']);
        $permissionDeleteUser = Permission::create(['name' => 'delete_user', 'view_name' => 'حذف المستخدم']);

        //Role
        $permissionIndexRole = Permission::create(['name' => 'index_role','view_name' => 'كل الصلاحيات']);
        $permissionCreateRole = Permission::create(['name' => 'create_role','view_name' => 'إنشاء صلاحيه']);
        $permissionEditRole = Permission::create(['name' => 'edit_role','view_name' => 'تعديل الصلاحيه']);
        $permissionDeleteRole = Permission::create(['name' => 'delete_role','view_name' => 'حذف الصلاحيه']);

        $permissionIndexRole = Permission::create(['name' => 'index_city','view_name' => 'كل المدن']);
        $permissionCreateRole = Permission::create(['name' => 'create_city','view_name' => 'إنشاء مدينه']);
        $permissionEditRole = Permission::create(['name' => 'edit_city','view_name' => 'تعديل المدينه']);
        $permissionDeleteRole = Permission::create(['name' => 'delete_city','view_name' => 'حذف المدينه']);

        $permissionIndexRole = Permission::create(['name' => 'index_neighborhood','view_name' => 'كل الاحياء']);
        $permissionCreateRole = Permission::create(['name' => 'create_neighborhood','view_name' => 'إنشاء حى']);
        $permissionEditRole = Permission::create(['name' => 'edit_neighborhood','view_name' => 'تعديل الحى']);
        $permissionDeleteRole = Permission::create(['name' => 'delete_neighborhood','view_name' => 'حذف الحى']);

        $permissionIndexRole = Permission::create(['name' => 'index_government','view_name' => 'كل المحافظات']);
        $permissionCreateRole = Permission::create(['name' => 'create_government','view_name' => 'إنشاء محافظه']);
        $permissionEditRole = Permission::create(['name' => 'edit_government','view_name' => 'تعديل المحافظه']);
        $permissionDeleteRole = Permission::create(['name' => 'delete_government','view_name' => 'حذف المحافظه']);

        $permissionIndexRole = Permission::create(['name' => 'index_country','view_name' => 'كل البلاد']);
        $permissionCreateRole = Permission::create(['name' => 'create_country','view_name' => 'إنشاء بلد']);
        $permissionEditRole = Permission::create(['name' => 'edit_country','view_name' => 'تعديل البلد']);
        $permissionDeleteRole = Permission::create(['name' => 'delete_country','view_name' => 'حذف البلد']);

        $permissionIndexRole = Permission::create(['name' => 'index_territory','view_name' => 'كل الاقاليم']);
        $permissionCreateRole = Permission::create(['name' => 'create_territory','view_name' => 'إنشاء اقليم']);
        $permissionEditRole = Permission::create(['name' => 'edit_territory','view_name' => 'تعديل الاقليم']);
        $permissionDeleteRole = Permission::create(['name' => 'delete_territory','view_name' => 'حذف الاقليم']);

        $permissionIndexRole = Permission::create(['name' => 'index_representative','view_name' => 'كل المندوبين']);
        $permissionCreateRole = Permission::create(['name' => 'create_representative','view_name' => 'إنشاء مندوب']);
        $permissionEditRole = Permission::create(['name' => 'edit_representative','view_name' => 'تعديل المندوب']);
        $permissionDeleteRole = Permission::create(['name' => 'delete_representative','view_name' => 'حذف المندوب']);

        $permissionIndexRole = Permission::create(['name' => 'index_store','view_name' => 'كل المحلات ']);
        $permissionCreateRole = Permission::create(['name' => 'create_store','view_name' => 'إنشاء محل']);
        $permissionEditRole = Permission::create(['name' => 'edit_store','view_name' => 'تعديل المحل']);
        $permissionDeleteRole = Permission::create(['name' => 'delete_store','view_name' => 'حذف المحل']);

        $permissionIndexRole = Permission::create(['name' => 'index_contract','view_name' => 'كل التعافدات']);
        $permissionCreateRole = Permission::create(['name' => 'create_contract','view_name' => 'إنشاء تعاقد']);
        $permissionEditRole = Permission::create(['name' => 'edit_contract','view_name' => 'تعديل التعاقد']);
        $permissionDeleteRole = Permission::create(['name' => 'delete_contract','view_name' => 'حذف التعاقد']);

        $permissionIndexRole = Permission::create(['name' => 'index_fields','view_name' => 'كل المجلات']);
        $permissionCreateRole = Permission::create(['name' => 'create_fields','view_name' => 'إنشاء مجال']);
        $permissionEditRole = Permission::create(['name' => 'edit_fields','view_name' => 'تعديل المجال']);
        $permissionDeleteRole = Permission::create(['name' => 'delete_fields','view_name' => 'حذف المجال']);



//        Permission::create(['name' => 'بيانات المستخدمين']);
//        Permission::create(['name' => 'بيانات المحلات']);
//        Permission::create(['name' => 'التقارير']);
//        Permission::create(['name' => 'المندوبين']);
//        Permission::create(['name' => 'المسئولين']);
//        Permission::create(['name' => 'الأدوار']);
//        Permission::create(['name' => 'انشطه المحلات']);
//        Permission::create(['name' => 'اسباب التعاقد']);
//        Permission::create(['name' => 'رسائل الموقع']);
//        Permission::create(['name' => 'إعدادات الموقع']);
//        Permission::create(['name' => 'ادارة اﻹحصائيات']);

    }
}
