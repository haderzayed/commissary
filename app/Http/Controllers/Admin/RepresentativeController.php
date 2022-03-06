<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Representative;
use App\Models\Role;
use App\Traits\ImageUpload;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RepresentativeController extends Controller
{
    use \App\Traits\ResponseTrait, ImageUpload;
    public function __construct()
    {
        $this->middleware('permission:index_representative|edit_representative|delete_representative', ['only' => ['index','show']]);
        $this->middleware('permission:create_representative', ['only' => ['create','store']]);
        $this->middleware('permission:edit_representative', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_representative', ['only' => ['destroy']]);

    }
    public function index()
    {
//        $users = Representative::latest()
//            ->where('id', '<>', auth()->id ())
//            ->where('role', 'representative')
//            ->get();
        $users=User::role('representative')->get();
        //dd($users);
        return view("admin.pages.usersrpesentavies.index",compact('users'));
    }

    public function create( )
    {
        $cites = City::all()->sortByDesc('id');
        $gavers = Governorate::all()->sortByDesc('id');
        $roles = Role::get();
        return view("admin.pages.usersrpesentavies.create" , compact('cites' ,'gavers' ,'roles'));
    }

    public function store(Request $request)
    {
//        dd($request);

//        $validator = Validator::make($request->all(), [
//            'name' => 'required',
//            'username' => 'required',
//            'mobile' => 'required',
//            'email' => 'required|between:3,64|email|unique:users',
//            'gavers' => 'required',
//            'city' => 'required',
//            'password' => 'required',
//            'id_number' => 'required',
////            'role_id' => 'required',
//
//        ]);
//        if ($validator->fails()) {
//            return $this->returnError($validator->errors()->all());
//        }
        try {
            $item = Representative::create([
                'role' => 'representative',
                'name' => $request->name,
                'username' => $request->username,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'gavers' => $request->gavers,
                'city' => $request->city,
                'password' => bcrypt($request->password),
                'id_number' => $request->id_number,

            ]);
//            $item = Representative::findOrFail($item->id);
//            $data = [
//                'id' => $item->id,
//                'name' => $item->name,
//                'username' => $item->username,
//                'role' => $item->representative,
//                'mobile' => $item->mobile,
//                'email' => $item->email,
//                'gavers' => $item->gavers,
//                'city' => $item->city,
//                'id_number' => $item->id_number,
//                'password' => $item->password,
//            ];
            return redirect()->route('representative.index')->with(['success' => 'تم التحديث بنجاح']);

//            return $this->returnData('تم اضافة عضو', $data, 201);
        } catch (\Exception $exception) {

            return $this->returnError($exception->getMessage(), 200);
            return redirect()->route('representative.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function show($id)
    {
        //
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
        return view("admin.pages.usersrpesentavies.edit",compact('allusers' ,'cites','gavers','roles' ));
    }



    public function update($user_id, Request $request)
    {

//         return $request;
//        try {

            $users = Representative::find($user_id);
            if (!$users)
                return redirect()->route('representative.index')->with([ 'هذا المستخدم غير موجود ']);
            $users->update($request->all());
            $users->role = 'representative';
            $users->name = $request->name;
            $users->username = $request->username;
            $users->mobile = $request->mobile;
            $users->email = $request->email;
            $users->gavers = $request->gavers;
            $users->city = $request->city;
            $users->id_number = $request->id_number;
            $users->password = !empty($request->password) ? $request->password : $users->password;


            if ($users->save()){
                return redirect()->route('representative.index')->with(['success' => 'تم التحديث بنجاح']);
            } else {
                return redirect()->route('representative.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
            }

//        } catch (\Exception $exception) {
//            DB::rollback();
//            return redirect()->route('Representative.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
//        }

    }

    public function destroy($id){
//        try{
            $student = Representative::find($id);
            if ($student === false){
                return redirect()->route('representative.index')->with(['error' => 'المندوب غير موجود']);
            }
        $student->delete();

            return redirect()->route('representative.index')->with(['success' => 'تم حذف المندوب بنجاح']);
//        } catch (\Exception $ex) {
//            DB::rollback();
//            return redirect()->route('Representative.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
//        }
    }

    public function getcityGaver($id){

        $gaver = City::where('governorate_id',$id)->get();

        return response()->json(['data'=> $gaver]);

    }

}
