<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\Neighborhood;
use App\Models\ReasonsNoContract;
use App\Models\Territory;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:index_city|edit_city|delete_city', ['only' => ['index','show']]);
        $this->middleware('permission:create_city', ['only' => ['create','store']]);
        $this->middleware('permission:edit_city', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_city', ['only' => ['destroy']]);

    }

    public function index()
    {
        $cities= City::all();
        return view('admin.pages.cities.index', compact('cities'));
    }

    public function create()
    {
        $countries = Country::all()->sortByDesc('id');
        $territorys = Territory::all()->sortByDesc('id');
        $govers = Governorate::all()->sortByDesc('id');

        return view('admin.pages.cities.create' ,compact('countries','govers', 'territorys'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name_city' => 'required|string|unique:cities',
            'Country_id' => 'required',
            'Territory_id' => 'required',
            'Governorate_id' => 'required'
        ]);

        try {
        $city = City::create([
            'name_city' => $request->name_city,
            'Country_id' => $request->Country_id,
            'Territory_id' => $request->Territory_id,
            'Governorate_id' => $request->Governorate_id,

        ]);

        return redirect()->route('city.index')->with(['success'=>"   تم إضافة مدينة $city->name_city  بنجاح "]);

    } catch (\Exception $exception) {
             return $exception;
            return redirect()->route('city.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $city = City::find($id);
        $countries = Country::all()->sortByDesc('id');
        $territorys = Territory::all()->sortByDesc('id');
        $govers = Governorate::all()->sortByDesc('id');

        if (!$city)
            return redirect()->route('city.index')->with(['error' => 'هذه المدينه غير موجوده']);
        return view('admin.pages.cities.edit', compact('city','countries','territorys','govers'));
    }

    public function update(Request $request,City $city)

    {
        try {
            $city->update($request->all());
            return redirect()->route('city.index')->with(['success' => 'تم تعديل المدينه بنجاح ']);
        } catch (\Exception $exception) {
            return $this->returnError('حدث خطأ ما, الرجاء المحاولة لاحقا');
        }
    }

    public function destroy(City $city)
    {
        try {
            $city->delete();
            return redirect()->route('city.index')->with(['success' => "تم حذف مدينة   $city->name_city بنجاح "  ]);
        }catch (\Exception $exception){
           return redirect()->route('city.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public  function getTerritory($id){

        $territory = Territory::where('Country_id',$id)->get();
        return response()->json(['data'=> $territory]);
    }

    public function getGovernment($id)
    {
        $Government= Governorate::where('Territory_id',$id)->get();
        return response()->json(['data'=> $Government]);
    }

    public function getCity($id)
    {
        $city= City::where('Governorate_id',$id)->get();
        return response()->json(['data'=> $city]);
    }
    public function getNeighborhood($id)
    {
        $neighborhood= Neighborhood::where('City_id',$id)->get();
        return response()->json(['data'=> $neighborhood]);
    }
}

