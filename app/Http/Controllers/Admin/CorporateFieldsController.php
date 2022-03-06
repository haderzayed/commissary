<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\FieldStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CorporateFieldsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:index_fields|edit_fields|delete_fields', ['only' => ['index','show']]);
        $this->middleware('permission:create_fields', ['only' => ['create','store']]);
        $this->middleware('permission:edit_fields', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_fields', ['only' => ['destroy']]);

    }

    public function index()
    {
        $corfield = FieldStore::all();
        return view('admin.pages.fieldstore.index', compact('corfield'));
    }

    public function create()
    {
        return view('admin.pages.fieldstore.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string:field_stores',
            'desc' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->returnError($validator->errors()->all());
        }
        try {
            $corfield = FieldStore::create([
                'title' => $request->title,
                'desc' => $request->desc,
            ]);
            return redirect()->route('fields.index')->with(['success' => 'تم اضافة مجال جديد']);
        }
        catch (\Exception $exception)
        {
            return redirect()->route('fields.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
            }

    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $filed = FieldStore::find($id);

        return view('admin.pages.fieldstore.edit', compact('filed'));
    }

    public function update($corop_id, Request $request)

    {
        try {
            $abouts = FieldStore::find($corop_id);
            if (!$abouts)
                return redirect()->route('fields.index')->with([ 'error' =>'هذا القسم غير موجود ']);
            $abouts->update($request->all());
            return redirect()->route('fields.index')->with(['success' => 'تم تعديل المجال بنجاح']);
        } catch (\Exception $exception)
        {
            return redirect()->route('fields.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($id)
    {

        try {
            $field = FieldStore::find($id);

            $field->delete();
            return redirect()->route('fields.index')->with(['success' => 'تم حذف المجال بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('fields.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}

