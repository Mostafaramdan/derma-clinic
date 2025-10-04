<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function toggle(Service $service)
    {
        $service->is_active = !$service->is_active;
        $service->save();
        return redirect()->route('services.index')->with('success', 'تم تحديث حالة الخدمة بنجاح');
    }
    public function index()
    {
        $services = Service::orderByDesc('id')->get();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'default_price' => 'required|integer|min:0',
            'is_active' => 'nullable',
        ]);
        $service = Service::create([
            'name' => json_encode(['ar' => $data['name_ar'], 'en' => $data['name_en']]),
            'default_price' => $data['default_price'],
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('services.index')->with('success','تم إضافة الخدمة بنجاح');
    }

    public function edit(Service $service)
    {
        $name = $service->name; // Already array due to casts
        return view('services.edit', compact('service','name'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'default_price' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        $service->update([
            'name' => json_encode(['ar' => $data['name_ar'], 'en' => $data['name_en']]),
            'default_price' => $data['default_price'],
            'is_active' => (bool) $request->input('is_active', false),
        ]);
        return redirect()->route('services.index')->with('success','تم تحديث الخدمة بنجاح');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success','تم حذف الخدمة بنجاح');
    }
}
