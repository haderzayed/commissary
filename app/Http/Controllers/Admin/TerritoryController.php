<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\Territory;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TerritoryController extends Controller
{
    use \App\Traits\ResponseTrait, ImageUpload;

    public function __construct()
    {
        $this->middleware('permission:index_territory|create_territory|edit_territory|delete_territory', ['only' => ['index','show']]);
        $this->middleware('permission:create_territory', ['only' => ['create','store']]);
        $this->middleware('permission:edit_territory', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_territory', ['only' => ['destroy']]);

    }
    public function index()
    {

        $terrys= Territory::all();
        return view('admin.pages.territories.index', compact('terrys'));
    }

    public function create()
    {
        $countries = Country::all()->sortByDesc('id');

        return view('admin.pages.territories.create' , compact('countries'));
    }


    public function store(Request $request)
    {
//        return $request;
        $validator = Validator::make($request->all(), [
            'name_terr' => 'required|string:territories',
            'Country_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->returnError($validator->errors()->all());
        }
        try {


            $terris = Territory::create([
                'name_terr' => $request->name_terr,
                'Country_id' => $request->Country_id,

            ]);

      return redirect()->route('territory.index')->with(['success' => 'تم الحفظ بنجاح']);


        } catch (\Exception $exception) {
             return  $exception;
            return redirect()->route('territory.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function show($id)
    {
        //
    }


    public function edit($contr_id)
    {
        $countries = Country::all()->sortByDesc('id');

        $territorys = Territory::find($contr_id);

        if (!$territorys)
            return redirect()->route('territory.index')->with(['error' => 'هذا القسم غير موجود ']);

        return view('admin.pages.territories.edit', compact('territorys' ,'countries'));
    }

    public function update($contr_id, Request $request)

    {
//        return $request;
        try {
            $territorys = Territory::find($contr_id);
            if (!$territorys)
                return redirect()->route('territory.index')->with(['هذا الاقليم غير موجود ']);
            //update data
            $territorys->update($request->all());


            return redirect()->route('territory.index')->with('تم اضافة اقليم');

        }
        catch (\Exception $exception) {

            return redirect()->route('territory.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }
    }

    public function destroy($id)
    {

        try {
            $cites = Territory::find($id);
            if (!$cites)
                return redirect()->route('territory.index')->with(['error' => 'هذا الاقليم غير موجود ']);


            $cites->delete();
            return redirect()->route('territory.index')->with(['success' => 'تم حذف الاقليم بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('territory.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


}
