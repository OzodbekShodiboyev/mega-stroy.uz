<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::withCount('products')->orderBy('sort_order')->get();
        return view('admin.catalog.colors', compact('colors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_uz'    => 'required|string|max:100',
            'name_ru'    => 'nullable|string|max:100',
            'name_en'    => 'nullable|string|max:100',
            'hex_code'   => 'required|string|max:10',
            'sort_order' => 'integer|min:0',
            'is_active'  => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);
        Color::create($data);
        return back()->with('success', 'Rang qo\'shildi.');
    }

    public function update(Request $request, Color $color)
    {
        $data = $request->validate([
            'name_uz'    => 'required|string|max:100',
            'name_ru'    => 'nullable|string|max:100',
            'name_en'    => 'nullable|string|max:100',
            'hex_code'   => 'required|string|max:10',
            'sort_order' => 'integer|min:0',
            'is_active'  => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $color->update($data);
        return back()->with('success', 'Yangilandi.');
    }

    public function destroy(Color $color)
    {
        $color->delete();
        return back()->with('success', 'O\'chirildi.');
    }
}
