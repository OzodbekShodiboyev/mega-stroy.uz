<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Texture;
use Illuminate\Http\Request;

class TextureController extends Controller
{
    public function index()
    {
        $textures = Texture::withCount('products')->orderBy('sort_order')->get();
        return view('admin.catalog.textures', compact('textures'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_uz'    => 'required|string|max:100',
            'name_ru'    => 'nullable|string|max:100',
            'name_en'    => 'nullable|string|max:100',
            'sort_order' => 'integer|min:0',
            'is_active'  => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);
        Texture::create($data);
        return back()->with('success', 'Faktura qo\'shildi.');
    }

    public function update(Request $request, Texture $texture)
    {
        $data = $request->validate([
            'name_uz'    => 'required|string|max:100',
            'name_ru'    => 'nullable|string|max:100',
            'name_en'    => 'nullable|string|max:100',
            'sort_order' => 'integer|min:0',
            'is_active'  => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $texture->update($data);
        return back()->with('success', 'Yangilandi.');
    }

    public function destroy(Texture $texture)
    {
        $texture->delete();
        return back()->with('success', 'O\'chirildi.');
    }
}
