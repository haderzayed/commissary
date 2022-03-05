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
        $this->middleware('permission:index_user|create_user|edit_user|delete_user', ['only' => ['index','show']]);
        $this->middleware('permission:create_user', ['only' => ['create','store']]);
        $this->middleware('permission:edit_user', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_user', ['only' => ['destroy']]);

    }

    public function index()
    {
        //$users = User::latest()->where('id', '<>', auth()->id ())->where('role', 'user')->get();
        $users =  User::orderBy('id','DESC')->paginate(5);

        return view("admin.pages.usersadmin.index",compact('users'));
    }

    public function create( )
    {
        $cites = City::all()->sortByDesc('id');
        $gavers = Governorate::all()->sortByDesc('id');
        $roles = Role::get();
        $permissions=Permission::all();
        return view("admin.pages.usersadmin.create" , compact('cites' ,'gavers' ,'roles','permissions'));
    }

    public function store(Request $request)
    {


//        $validator = Validator::make($request->all(), [
//            'name' => 'required',
//            'username' => 'required',
//            'mobile' => 'required',
//            'email' => 'required|between:3,64|email|unique:users',
//            'gavers' => 'required',
//            'city' => 'required',
//            'representative_city_id' => 'required',
//            'password' => 'required',
//            'id_number' => 'required',
//            'role_id' => 'required',
//
//        ]);
//        if ($validator->fails()) {
//            return $this->returnError($validator->errors()->all());
//        }

        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'user_name' => $request->user_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'government' => $request->government,
                'city' => $request->city,
                'representative_city_id' => $request->representative_city_id,
                'password' => Hash::make($request->password),
                'id_number' => $request->id_number,

            ]);
            $user->assignRole($request->input('role_id'));

            $permissions=$request->input('permissions');
            foreach( $permissions as  $permission){
                $user->givePermissionTo($permission);
            }
            DB::commit();
            $item = User::findOrFail($user->id);
            $data = [
                'id' => $item->id,
                'name' => $item->name,
                'user_name' => $item->user_name,
                'role' => $item->user,
                'mobile' => $item->mobile,
                'email' => $item->email,
                'gavers' => $item->gavers,
                'city' => $item->city,
                'id_number' => $item->id_number,
                'role_id' => $item->role_id,
                'password' => $item->password,
            ];
            return redirect()->route('users.index')->with('تم اضافة عضو', $data, 201);

//            return $this->returnData('تم اضافة عضو', $data, 201);
        } catch (\Exception $exception) {
             return $exception;
             DB::rollBack();
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
        $allusers = User::whereId($id)->first();
        if ($allusers == null) {
            return $this->returnError('لم يتم العثور على مستخدم');
        }
        return view("admin.pages.usersadmin.edit",compact('allusers' ,'cites','gavers','roles' ));
    }



    public function update($user_id, Request $request)
    {


        try {

            $users = User::find($user_id);
            if (!$users)
                return redirect()->route('users.index')->with([ 'هذا القسم غير موجود ']);
            $users->update($request->all());

            $users->role = role;
            $users->name = $request->name;
            $users->username = $request->username;
            $users->mobile = $request->mobile;
            $users->email = $request->email;
            $users->gavers = $request->gavers;
            $users->city = $request->city;
            $users->representative_city_id = $request->representative_city_id;
            $users->role_id = $request->role_id;
            $users->id_number = $request->id_number;
            $users->password = !empty($request->password) ? $request->password : $users->password;


            if ($users->save()){
                return redirect()->route('users.index')->with(['success' => 'تم التحديث بنجاح']);
            } else {
                return redirect()->route('users.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
            }

        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->route('users.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function destroy($id){
        try{
            $student = User::find($id);
            if ($student === false){
                return redirect()->route('users.index')->with(['error' => 'الطالب غير موجود']);
            }
            $student->delete();

            return redirect()->route('users.index')->with(['success' => 'تم حذف المستخدم بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('users.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function getcityGaver($id){

        $gaver = City::where('governorate_id',$id)->get();

        return response()->json(['data'=> $gaver]);

    }

}
