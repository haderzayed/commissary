<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralKhatma;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RolesController extends Controller
{
    use \App\Traits\ResponseTrait, ImageUpload;
    public function __construct()
    {
        $this->middleware('permission:index_role|create_role|edit_role|delete_role', ['only' => ['index','show']]);
        $this->middleware('permission:create_role', ['only' => ['create','store']]);
        $this->middleware('permission:edit_role', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_role', ['only' => ['destroy']]);

    }

    public function index()
    {
       // Gate::authorize('management_roles');
        $roles = Role::all();
        return view("admin.pages.roles.index",compact('roles'));
    }

    public function create(Role $roles)
    {
        $permissions = Permission::all();
        return view("admin.pages.roles.create",compact('permissions'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'permissions' => 'required',

        ]);
        if ($validator->fails()) {
            return $this->returnError($validator->errors()->all());
        }
        try {
            $item = Role::create([
                'name' => $request->name,
                'permissions' =>json_encode($request->permissions) ,

            ]);
            $item = Role::findOrFail($item->id);
            $data = [
                'id' => $item->id,
                'name' => $item->title,
                'permissions' => $item->permissions,
            ];

            return redirect()->route('roles.index')->with(['success' => 'تم الاضافة بنجاح ']);

        } catch (\Exception $exception) {
             return redirect()->route('roles.index')->with(['error' => 'هذا الصلاحية غير موجود ']);
        }
    }


    public function show($id)
    {

    }

        public function edit(int $id)
    {

        $roles = Role::whereId($id)->first();
        if ($roles == null) {
            return $this->returnError('لم يتم العثور على صلاحية');
        }
        $permissions = Permission::all();
        $rolePermissions = $roles->permissions->pluck('id')->toArray();


        return view("admin.pages.roles.edit",compact('roles','permissions','rolePermissions'));
    }

    public function update(Request $request, int $id)
    {
        try {
            $role = Role::whereId($id)->first();
            if ( $role == null) {
                return $this->returnError('لم يتم العثور على صلاحية');
            }

            if($request->has('permissions')){
                $rolePermissions =  $role->permissions()->pluck('name')->toArray();
                foreach($rolePermissions as $permission){
                    $role->revokePermissionTo($permission);
                }
                $role->givePermissionTo($request->permissions);
            }
            $role->save();

            return redirect()->route('roles.index')->with(['success' => 'تم الاضافة بنجاح ']);

        } catch (\Exception $exception) {

            return redirect()->route('roles.index')->with(['error' => 'هذا الصلاحية غير موجود ']);
        }

    }

//    public function update(Request $request, Role $role)
//    {
//        $validator = Validator::make($request->all(), [
//            'name' => [
//                'required',
//                'regex:/^[\pL\s\-]+$/u',
//                'min:3',
//                Rule::unique('roles')->ignore($role)
//            ],
//        ]);
//
//        $attributeNames =  [
//            'name' => __('dashboard.roles.name'),
//        ];
//
//        $validator->setAttributeNames($attributeNames);
//
//        if($validator->fails()){
//            return response()->json([
//                "msg"=>[
//                    "type"=>"error",
//                    "body"=>$validator->messages()->first()
//                ]
//            ]);
//        }
//
//        $permissions = $request->get("permissions",[]);
//        $role->name = $request->name;
//        $role->save();
//        $role->syncPermissions($permissions);
//        return response()->json(["redir"=>route('roles.index')]);
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): JsonResponse
    {
        Gate::authorize('management_roles');

     $role = Role::whereId($id)->first();
        if ($role == null) {
            return $this->returnError('لم يتم العثور على صلاحية');
        }
        try {
         $role->delete();
            return $this->returnSuccess('تم حذف صلاحية بنجاح');
        } catch (\Exception $exception) {
            return $this->returnError('حدث حطأ ما, الرجاء المحاولة لاحقا');
        }
    }


}

