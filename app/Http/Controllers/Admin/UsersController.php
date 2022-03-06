<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\FieldStore;
use App\Models\Governorate;

use App\Models\Village;
use App\Traits\ImageUpload;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    use \App\Traits\ResponseTrait, ImageUpload;

    public function __construct()
    {
        $this->middleware('permission:index_user|create_user|edit_user|delete_user', ['only' => ['index', 'show']]);
        $this->middleware('permission:create_user', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_user', ['only' => ['destroy']]);

    }

    public function index()
    {
        //$users = User::latest()->where('id', '<>', auth()->id ())->where('role', 'user')->get();
        $users = User::orderBy('id', 'DESC')->paginate(5);

        return view("admin.pages.usersadmin.index", compact('users'));
    }

    public function create()
    {
        $cites = City::all()->sortByDesc('id');
        $gavers = Governorate::all()->sortByDesc('id');
        $roles = Role::get();
        $permissions = Permission::all();
        return view("admin.pages.usersadmin.create", compact('cites', 'gavers', 'roles', 'permissions'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'user_name' => 'required',
            'phone' => 'required',
            'email' => 'required|between:3,64|email|unique:users',
            'government' => 'required',
            'City_id' => 'required',
            'representative_city_id' => 'required',
            'password' => 'required',
            'id_number' => 'required',
            'role_id' => 'required',
        ]);


        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'user_name' => $request->user_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'government' => $request->government,
                'city' => $request->City_id,
                'representative_city_id' => $request->representative_city_id,
                'password' => Hash::make($request->password),
                'id_number' => $request->id_number,

            ]);
            $user->assignRole($request->input('role_id'));
            if ($request->has('permissions')) {
                $permissions = $request->input('permissions');
                foreach ($permissions as $permission) {
                    $user->givePermissionTo($permission);
                }
            }

            DB::commit();

            return redirect()->route('users.index')->with(['success' => " تم اضافة مستخدم جديد بنجاح"]);

        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
            return $this->returnError('حدث خطأ ما, الرجاء المحاولة لاحقا');
        }
    }


    public function show($id)
    {

    }

    public function edit(int $id)
    {

        $cites = City::all()->sortByDesc('id');
        $gavers = Governorate::all()->sortByDesc('id');
        $roles = Role::get();
        $user = User::findOrFail($id);
        $userRole = $user->getRoleNames()->first();
        $userPermissions = $user->permissions->pluck('id')->toArray();

        $permissions = Permission::all();

        return view("admin.pages.usersadmin.edit", compact('cites', 'user', 'roles', 'gavers', 'userPermissions', 'permissions', 'userRole'));
    }


    public function update($user_id, Request $request)
    {

        try {
            DB::beginTransaction();
            $user = User::find($user_id);

            $user->name = $request->name;
            $user->user_name = $request->user_name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->government = $request->government;
            $user->city = $request->City_id;
            $user->representative_city_id = $request->representative_city_id;
            $user->id_number = $request->id_number;


            if ($request->has('password') && $request->password !== null) {
                $user->password = bcrypt($request->password);
            } else {
                $user->password = $user->password;
            }



            if ($request->has('role_id')) {
                $userRole = $user->getRoleNames();
                foreach ($userRole as $role) {
                    $user->removeRole($role);
                }
                $user->assignRole($request->role_id);
            }

            if ($request->has('permissions')) {
                $userPermissions = $user->getPermissionNames();
                $permissions = $request->input('permissions');
                foreach ($userPermissions as $permission) {
                    $user->revokePermissionTo($permission);
                }
                foreach ($permissions as $permission) {
                    $user->givePermissionTo($permission);
                }
              //  $user->givePermissionTo($request->permissions);
            }
            $user->save();


            DB::commit();
            return redirect()->route('users.index')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $exception) {
            return $exception;
            DB::rollback();
            return redirect()->route('users.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function destroy($id)
    {
        try {
            $student = User::findOrfail($id);

            $student->delete();

            return redirect()->route('users.index')->with(['success' => 'تم حذف المستخدم بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('users.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function getcityGaver($id)
    {

        $gaver = City::where('governorate_id', $id)->get();

        return response()->json(['data' => $gaver]);

    }

}
