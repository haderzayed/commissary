<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\Territory;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GovernorateController extends Controller
{

    use \App\Traits\ResponseTrait, ImageUpload;
    public function __construct()
    {
        $this->middleware('permission:index_government|edit_government|delete_government', ['only' => ['index','show']]);
        $this->middleware('permission:create_government', ['only' => ['create','store']]);
        $this->middleware('permission:edit_government', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_government', ['only' => ['destroy']]);

    }

    public function index()
    {

        $govers= Governorate::all();
        return view('admin.pages.govers.index', compact('govers'));
    }

    public function create()
    {
        $countries = Country::all()->sortByDesc('id');
        $territorys = Territory::all()->sortByDesc('id');

        return view('admin.pages.govers.create' , compact('countries' ,'territorys'));
    }
    public function store(Request $request)
    {
//        return $request;
        $validator = Validator::make($request->all(), [
            'name_gover' => 'required|string:field_stores',
            'Country_id' => 'required',
            'Territory_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->returnError($validator->errors()->all());
        }
        try {
            $covers = Governorate::create([
                'name_gover' => $request->name_gover,
                'Country_id' => $request->Country_id,
                'Territory_id' => $request->Territory_id,
            ]);

            return redirect()->route('government.index')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $exception) {

            return redirect()->route('government.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    public function show($id)
    {
        //
    }

    public function edit($gover_id)
    {
        $countries = Country::all()->sortByDesc('id');
        $territorys = Territory::all();
        $govers = Governorate::find($gover_id);

        if (!$govers)
       return redirect()->route('government.index')->with(['error' => 'هذا المحافظه غير موجود ']);

        return view('admin.pages.govers.edit', compact('territorys' ,'countries' ,'govers'));
    }
    public function update($cover, Request $request)
    {
//        return $request;
        try {
            $territorys = Governorate::find($cover);
            if (!$territorys)
                return redirect()->route('government.index')->with(['هذا المحافظه غير موجود ']);
            $territorys->update($request->all());
            return redirect()->route('government.index')->with('تم اضافة المحافظه');
        }
        catch (\Exception $exception) {
            return redirect()->route('government.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($id)
    {
        try {
            $govers = Governorate::find($id);
            if (!$govers)
                return redirect()->route('government.index')->with(['error' => 'هذا المحافظه غير موجود ']);

            $govers->delete();
            return redirect()->route('government.index')->with(['success' => 'تم حذف المحافظه بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('government.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    public function getcityGaver($id){

        $gaver = Territory::where('Country_id',$id)->get();
        return response()->json(['data'=> $gaver]);

    }
}
