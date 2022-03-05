<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDataRequest;
use App\Models\City;
use App\Models\FieldStore;
use App\Models\Governorate;
use App\Models\ReasonsNoContract;
use App\Models\Representative;
use App\Models\Role;
use App\Models\StorData;
use App\Models\StoreData;
use App\Traits\ImageUpload;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StoreDataController extends Controller
{
    use \App\Traits\ResponseTrait, ImageUpload;
    public function __construct()
    {
        $this->middleware('permission:index_store|edit_store|delete_store', ['only' => ['index','show']]);
        $this->middleware('permission:create_store', ['only' => ['create','store']]);
        $this->middleware('permission:edit_store', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_store', ['only' => ['destroy']]);

    }
    public function index()
    {
        $storsdata = StoreData::all();
//        dd($storsdata);
        $corporatefiels = FieldStore::all();
        return view('admin.pages.storedata.index', compact('storsdata' ,'corporatefiels'));
    }

    public function create()
    {
        $resontract = ReasonsNoContract::all();
        $corporatefiels = FieldStore::all();
        return view('admin.pages.storedata.create' ,compact('resontract' ,'corporatefiels'));
    }


    public function store(Request $request)
    {
//        dd($request);
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|string:field_stores',
//            'activestore' => 'required',
//            'mob' => 'required',
//            'tel' => 'required',
//            'email' => 'required',
//            'mangeer' => 'required',
//            'adress' => 'required',
//            'owner ' => 'required',
//            'employ ' => 'required',
//            'telemploy ' => 'required',
//            'datevisite ' => 'required',
//            'firstvisit ' => 'required',
//            'anothervisite ' => 'required',
//            'numbranches ' => 'required',
//            'levelstore ' => 'required',
//            'timework ' => 'required',
//            'holidays ' => 'required',
//            'papers ' => 'required',
//            'opinions ' => 'required',
//            'nots' => 'required',
//
//        ]);
//        if ($validator->fails()) {
//            return $this->returnError($validator->errors()->all());
//        }
//        try {


        $corfield = StoreData::create([
            'name' => $request->name,
            'activestore' => $request->activestore,
            'mob' => $request->mob,
            'tel' => $request->tel,
            'email' => $request->email,
            'mangeer' => $request->mangeer,
            'adress' => $request->adress,
            'owner' => $request->owner,
            'employ' => $request->employ,
            'telemploy' => $request->telemploy,
            'datevisite' => $request->datevisite,
            'contract' => $request->contract,
            'rcontract' => $request->rcontract,
            'firstvisit' => $request->firstvisit,
            'anothervisite' => $request->anothervisite,
            'numbranches' => $request->numbranches,
            'levelstore' => $request->levelstore,
            'timework' => $request->timework,
            'holidays' => $request->holidays,
            'papers' => $request->papers,
            'opinions' => $request->opinions,
            'nots' => $request->nots,
//            'title' => $request->title,
//            'desc' => $request->desc,

        ]);

//        dd($sliders);
            return redirect()->route('store.index')->with(['success' => 'تم التحديث بنجاح']);



//            return $this->returnData('تم اضافة عضو', $data, 201);
//    } catch (\Exception $exception) {
//
////return $this->returnError($exception->getMessage(), 200);
//            return redirect()->route('storedata.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
//    }
//            return redirect()->route('admin.storedata')->with(['success' => 'تم الحفظ بنجاح']);
//        } catch (\Exception $ex) {
//            return redirect()->route('admin.storedata')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
//
//        }
    }

    public function show($id)
    {
        //
    }

    public function edit(int $id)
    {
        $stordata = StoreData::whereId($id)->first();
        $resontract = ReasonsNoContract::all();
        $corporatefiels = FieldStore::all();

        if ($stordata == null) {
            return $this->returnError('لم يتم العثور على محل');
        }
        return view("admin.pages.storedata.edit",compact('stordata' ,'resontract' ,'corporatefiels'));
    }



    public function update($user_id, Request $request)
    {

//         return $request;
//        try {

        $users = StoreData::find($user_id);
        if (!$users)
            return redirect()->route('store.index')->with([ 'هذا المستخدم غير موجود ']);
        $users->update($request->all());
//        $users->role = 'representative';
//        $users->name = $request->name;
//        $users->username = $request->username;
//        $users->mobile = $request->mobile;
//        $users->email = $request->email;
//        $users->gavers = $request->gavers;
//        $users->city = $request->city;
//        $users->id_number = $request->id_number;
//        $users->password = !empty($request->password) ? $request->password : $users->password;


        if ($users->save()){
            return redirect()->route('store.index')->with(['success' => 'تم التحديث بنجاح']);
        } else {
            return redirect()->route('store.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

//        } catch (\Exception $exception) {
//            DB::rollback();
//            return redirect()->route('Representative.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
//        }

    }

    public function destroy($id){
//        try{
        $student = StoreData::find($id);
        if ($student === false){
            return redirect()->route('store.index')->with(['error' => 'المندوب غير موجود']);
        }
        $student->delete();

        return redirect()->route('store.index')->with(['success' => 'تم حذف المندوب بنجاح']);
//        } catch (\Exception $ex) {
//            DB::rollback();
//            return redirect()->route('Representative.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
//        }
    }


}
