<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    use \App\Traits\ResponseTrait, ImageUpload;
    public function __construct()
    {
        $this->middleware('permission:index_country|create_country|edit_country|delete_country', ['only' => ['index','show']]);
        $this->middleware('permission:create_country', ['only' => ['create','store']]);
        $this->middleware('permission:edit_country', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_country', ['only' => ['destroy']]);

    }

    public function index()
    {
        $country= Country::all();
        return view('admin.pages.country.index', compact('country'));
    }
    public function create()
    {
        return view('admin.pages.country.create');
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name_coun' => 'required|string:countries',
            'decs' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->returnError($validator->errors()->all());
        }

        try {
           $countires = Country::create([
                'name_coun' => $request->name_coun,
                'decs' => $request->decs,
            ]);

            return redirect()->route('country.index')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $exception) {
             return  $exception;
            return redirect()->route('country.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($contr_id)
    {
        $country = Country::find($contr_id);
        if (!$country)
       return redirect()->route('country.index')->with(['error' => 'هذا القسم غير موجود ']);

        return view('admin.pages.country.edit', compact('country'));
    }
    public function update($contr_id, Request $request)
    {
//        return $request;
        try {
            $country = Country::find($contr_id);
            if (!$country)
                return redirect()->route('country.index')->with(['error' => 'الدوله غير موجوده']);
            $country->update($request->all());
            return redirect()->route('country.index')->with(['success' => 'تم دوله دوله']);
        }
            catch (\Exception $exception) {

            return redirect()->route('country.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

     public function destroy($id)
        {
            try {
                $cites = Country::find($id);
                if (!$cites)
                    return redirect()->route('country.index')->with(['error' => 'هذا الدوله غير موجود ']);
                $cites->delete();
                return redirect()->route('country.index')->with(['success' => 'تم حذف الدوله بنجاح']);
            }
            catch (\Exception $ex) {
                return redirect()->route('country.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
            }
        }
        }


