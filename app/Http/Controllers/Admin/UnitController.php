<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::withCount('products')->get();
        return view('admin.catalog.units', compact('units'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_uz' => 'required|string|max:100',
            'name_ru' => 'nullable|string|max:100',
            'name_en' => 'nullable|string|max:100',
            'symbol'  => 'required|string|max:20',
        ]);
        Unit::create($data);
        return back()->with('success', 'Birlik qo\'shildi.');
    }

    public function update(Request $request, Unit $unit)
    {
        $data = $request->validate([
            'name_uz' => 'required|string|max:100',
            'name_ru' => 'nullable|string|max:100',
            'name_en' => 'nullable|string|max:100',
            'symbol'  => 'required|string|max:20',
        ]);
        $unit->update($data);
        return back()->with('success', 'Yangilandi.');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();
        return back()->with('success', 'O\'chirildi.');
    }
}
