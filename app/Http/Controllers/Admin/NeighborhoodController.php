<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\Neighborhood;
use App\Models\Territory;
use Illuminate\Http\Request;

class NeighborhoodController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:index_neighborhood|edit_neighborhood|delete_neighborhood', ['only' => ['index','show']]);
        $this->middleware('permission:create_neighborhood', ['only' => ['create','store']]);
        $this->middleware('permission:edit_neighborhood', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_neighborhood', ['only' => ['destroy']]);

    }

    public function index()
    {
        $neighborhoods = Neighborhood::all();
        return view('admin.pages.neighborhoods.index', compact('neighborhoods'));
    }

    public function create()
    {
        $countries = Country::all()->sortByDesc('id');
        $territorys = Territory::all()->sortByDesc('id');
        $govers = Governorate::all()->sortByDesc('id');
        $cities = City::all()->sortByDesc('id');

        return view('admin.pages.neighborhoods.create', compact('countries', 'govers', 'territorys', 'cities'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|unique:neighborhoods',
            'Country_id' => 'required',
            'Territory_id' => 'required',
            'Governorate_id' => 'required',
            'City_id'=> 'required',
        ]);

        try {
            $Neighborhood = Neighborhood::create([
                'name' => $request->name,
                'Country_id' => $request->Country_id,
                'Territory_id' => $request->Territory_id,
                'Governorate_id' => $request->Governorate_id,
                'City_id' => $request->City_id,
            ]);

            return redirect()->route('neighborhood.index')->with(['success' => "   تم إضافة حي $Neighborhood->name  بنجاح "]);

        } catch (\Exception $exception) {

            return redirect()->route('neighborhood.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function edit(Neighborhood $neighborhood)
    {
        $countries = Country::all()->sortByDesc('id');
        $territorys = Territory::all()->sortByDesc('id');
        $govers = Governorate::all()->sortByDesc('id');

        return view('admin.pages.neighborhoods.edit', compact('neighborhood','countries','territorys','govers'));
    }
    public function update(Request $request,Neighborhood $neighborhood)

    {
        try {
            $neighborhood->update($request->all());
            return redirect()->route('neighborhood.index')->with(['success' => 'تم تعديل الحي بنجاح ']);
        } catch (\Exception $exception) {
            return redirect()->route('neighborhood.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    public function destroy(Neighborhood $neighborhood)
    {
        try {
            $neighborhood->delete();
            return redirect()->route('neighborhood.index')->with(['success' => " تم حذف حي    $neighborhood->name  بنجاح "  ]);
        }catch (\Exception $exception){
            return redirect()->route('neighborhood.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
