<?php
namespace App\Http\Controllers;

use App\Models\Radiology;
use App\Http\Requests\RadiologyRequest;
use Illuminate\Http\Request;

class RadiologyController extends Controller
{
    public function index()
    {
        $radiologies = Radiology::latest()->paginate(20);
        return view('radiologies.index', compact('radiologies'));
    }

    public function create()
    {
        return view('radiologies.create');
    }

    public function store(RadiologyRequest $request)
    {
        Radiology::create($request->validated());
        return redirect()->route('radiologies.index')->with('success', 'تمت الإضافة بنجاح');
    }

    public function edit(Radiology $radiology)
    {
        return view('radiologies.edit', compact('radiology'));
    }

    public function update(RadiologyRequest $request, Radiology $radiology)
    {
        $radiology->update($request->validated());
        return redirect()->route('radiologies.index')->with('success', 'تم التعديل بنجاح');
    }

    public function destroy(Radiology $radiology)
    {
        $radiology->delete();
        return redirect()->route('radiologies.index')->with('success', 'تم الحذف بنجاح');
    }
}
