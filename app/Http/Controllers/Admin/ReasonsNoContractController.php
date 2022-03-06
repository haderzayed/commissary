<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FildstoreRequest;
use App\Models\FieldStore;
use App\Models\ReasonsNoContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReasonsNoContractController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:index_contract|edit_contract|delete_contract', ['only' => ['index','show']]);
        $this->middleware('permission:create_contract', ['only' => ['create','store']]);
        $this->middleware('permission:edit_contract', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_contract', ['only' => ['destroy']]);

    }
    public function index()
    {
        $resontract = ReasonsNoContract::all();
        return view('admin.pages.reasonNconreact.index', compact('resontract'));
    }
    public function create()
    {
        return view('admin.pages.reasonNconreact.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string:field_stores',
            'desc' => 'required',

        ]);
        if ($validator->fails()) {
            return $this->returnError($validator->errors()->all());
        }        try {

        $corfield = ReasonsNoContract::create([
            'title' => $request->title,
            'desc' => $request->desc,
        ]);

        return redirect()->route('contract.index')->with(['susses'=>'تم اضافة سبب عدم التعاقد']);
        } catch (\Exception $exception) {

            return redirect()->route('contract.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }

    }

    public function show($id)
    {
        //
    }
    public function edit($reason_id)
    {
        $abouts = ReasonsNoContract::find($reason_id);

        if (!$abouts)
            return redirect()->route('contract.index')->with(['error' => 'هذا السبب غير موجود ']);

        return view('admin.pages.reasonNconreact.edit', compact('abouts'));
    }

    public function update($about_id, Request $request)

    {
//        return $request;
        try {
            $abouts = ReasonsNoContract::find($about_id);
            if (!$abouts)
                return redirect()->route('contract.index')->with(['error' =>  'هذا السبب غير موجود ']);
            $abouts->update($request->all());

            return redirect()->route('contract.index')->with(['success'=>'تم أضافة السبب']);

          } catch (\Exception $exception) {
            return redirect()->route('contract.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);


        }
    }

    public function destroy($id)
    {
        try {
            $abouts = ReasonsNoContract::find($id);
            if (!$abouts)
                return redirect()->route('contract.index')->with(['error' => 'هذا القسم غير موجود ']);


            $abouts->delete();
            return redirect()->route('contract.index')->with(['success' => 'تم حذف القسم بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('contract.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}

