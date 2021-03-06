<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDataRequest;
use App\Models\Attachment;
use App\Models\City;
use App\Models\Country;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        $countries = Country::all()->sortByDesc('id');
        return view('admin.pages.storedata.create' ,compact('resontract' ,'corporatefiels','countries'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'activestore' => 'required',
            'mob' => 'required',
            'tel' => 'required',
            'email' => 'required|between:3,64|email|unique:store_data',
            'Country_id' => 'required',
            'Territory_id' => 'required',
            'Governorate_id' => 'required',
            'City_id' => 'required',
            'neighborhood_id' => 'required',
            'adress' => 'required',
            'timework' => 'required',
            'mangeer' => 'required',
            'owner' => 'required',
            'employ' => 'required',
            'telemploy' => 'required',
            'numbranches' => 'required',
            'levelstore' => 'required',
            'holidays' => 'required',
            'datevisite' => 'required',
            'firstvisit' => 'required',
            'anothervisite' => 'required',
            'contract' => 'required',
            'noncontract' => 'required',
            'opinions' => 'required',
            'nots' => 'required',
            'papers.*' => 'mimes:png,jpg,jpeg,gif,svg|max:2048',
        ]);


        try {
            DB::beginTransaction();

            $store=StoreData::Create($request->except('papers'));
            $files=$request->file('papers');
            if($request->hasFile('papers')){
                foreach ($files as $file){
                   $file_name=$file->store("stores/$store->name",'public');
                   Attachment::create([
                       'file_name'=>$file_name,
                       'store_id'=>$store->id
                   ]);
                }
            }

            DB::commit();

            return redirect()->route('store.index')->with(['success' => " ???? ?????????? ?????? ???????? ??????????"]);

        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
            return $this->returnError('?????? ?????? ????, ???????????? ???????????????? ??????????');
        }
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
            return $this->returnError('???? ?????? ???????????? ?????? ??????');
        }
        return view("admin.pages.storedata.edit",compact('stordata' ,'resontract' ,'corporatefiels'));
    }



    public function update($user_id, Request $request)
    {

//         return $request;
//        try {

        $users = StoreData::find($user_id);
        if (!$users)
            return redirect()->route('store.index')->with([ '?????? ???????????????? ?????? ?????????? ']);
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
            return redirect()->route('store.index')->with(['success' => '???? ?????????????? ??????????']);
        } else {
            return redirect()->route('store.index')->with(['error' => '?????? ?????? ???? ?????????? ???????????????? ??????????']);
        }

//        } catch (\Exception $exception) {
//            DB::rollback();
//            return redirect()->route('Representative.index')->with(['error' => '?????? ?????? ???? ?????????? ???????????????? ??????????']);
//        }

    }

    public function destroy($id){
//        try{
        $student = StoreData::find($id);
        if ($student === false){
            return redirect()->route('store.index')->with(['error' => '?????????????? ?????? ??????????']);
        }
        $student->delete();

        return redirect()->route('store.index')->with(['success' => '???? ?????? ?????????????? ??????????']);
//        } catch (\Exception $ex) {
//            DB::rollback();
//            return redirect()->route('Representative.index')->with(['error' => '?????? ?????? ???? ?????????? ???????????????? ??????????']);
//        }
    }


}
