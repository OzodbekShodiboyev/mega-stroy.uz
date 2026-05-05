<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Texture;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private function formData(): array
    {
        return [
            'categories' => Category::active()->get(),
            'units'      => Unit::orderBy('id')->get(),
            'colors'     => Color::active()->get(),
            'textures'   => Texture::active()->get(),
        ];
    }

    public function index()
    {
        $products = Product::with('categoryRel', 'unitRel')
            ->orderBy('sort_order')->orderBy('id')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create', $this->formData());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_uz'       => 'required|string|max:200',
            'name_ru'       => 'nullable|string|max:200',
            'name_en'       => 'nullable|string|max:200',
            'category_id'   => 'nullable|exists:categories,id',
            'desc_uz'       => 'nullable|string',
            'desc_ru'       => 'nullable|string',
            'desc_en'       => 'nullable|string',
            'price'         => 'required|integer|min:0',
            'old_price'     => 'nullable|integer|min:0',
            'unit_id'       => 'nullable|exists:units,id',
            'badge'         => 'nullable|in:top,new,popular,sale',
            'sku'           => 'nullable|string|max:30',
            'specs'         => 'nullable|string',
            'in_stock'      => 'boolean',
            'is_active'     => 'boolean',
            'new_images.*'  => 'nullable|file|image|max:5120',
        ]);

        $data['slug']      = Str::slug($request->name_uz) . '-' . Str::random(5);
        $data['specs']     = $this->parseSpecs($request->input('specs'));
        $data['in_stock']  = $request->boolean('in_stock');
        $data['is_active'] = $request->boolean('is_active');

        $images = [];
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $file) {
                $path = $file->store('products', 'public');
                $images[] = asset('storage/' . $path);
            }
        }
        $data['images'] = $images;

        if (!empty($data['unit_id'])) {
            $data['unit'] = Unit::find($data['unit_id'])?->symbol ?? '';
        }
        if (!empty($data['category_id'])) {
            $data['category'] = Category::find($data['category_id'])?->slug ?? '';
        }

        $product = Product::create($data);

        $product->colors()->sync($request->input('color_ids', []));
        $product->textures()->sync($request->input('texture_ids', []));

        return redirect()->route('admin.products.index')->with('success', 'Mahsulot qo\'shildi.');
    }

    public function edit(Product $product)
    {
        $product->load('colors', 'textures');
        return view('admin.products.edit', array_merge(['product' => $product], $this->formData()));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name_uz'       => 'required|string|max:200',
            'name_ru'       => 'nullable|string|max:200',
            'name_en'       => 'nullable|string|max:200',
            'category_id'   => 'nullable|exists:categories,id',
            'desc_uz'       => 'nullable|string',
            'desc_ru'       => 'nullable|string',
            'desc_en'       => 'nullable|string',
            'price'         => 'required|integer|min:0',
            'old_price'     => 'nullable|integer|min:0',
            'unit_id'       => 'nullable|exists:units,id',
            'badge'         => 'nullable|in:top,new,popular,sale',
            'sku'           => 'nullable|string|max:30',
            'specs'         => 'nullable|string',
            'in_stock'      => 'boolean',
            'is_active'     => 'boolean',
            'new_images.*'  => 'nullable|file|image|max:5120',
        ]);

        $data['specs']     = $this->parseSpecs($request->input('specs'));
        $data['in_stock']  = $request->boolean('in_stock');
        $data['is_active'] = $request->boolean('is_active');

        // Keep existing images the user didn't remove
        $images = $request->input('existing_images', []);

        // Upload new images
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $file) {
                $path = $file->store('products', 'public');
                $images[] = asset('storage/' . $path);
            }
        }

        // Delete removed images from storage
        $storageBase = asset('storage/');
        foreach (($product->images ?? []) as $old) {
            if (!in_array($old, $images) && str_starts_with($old, $storageBase)) {
                Storage::disk('public')->delete(str_replace($storageBase, '', $old));
            }
        }

        $data['images'] = $images;

        if (!empty($data['unit_id'])) {
            $data['unit'] = Unit::find($data['unit_id'])?->symbol ?? '';
        }
        if (!empty($data['category_id'])) {
            $data['category'] = Category::find($data['category_id'])?->slug ?? '';
        }

        $product->update($data);

        $product->colors()->sync($request->input('color_ids', []));
        $product->textures()->sync($request->input('texture_ids', []));

        return redirect()->route('admin.products.index')->with('success', 'Mahsulot yangilandi.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Mahsulot o\'chirildi.');
    }

    private function parseSpecs(?string $raw): array
    {
        if (!$raw) return [];
        $specs = [];
        foreach (explode("\n", $raw) as $line) {
            $line = trim($line);
            if (!$line) continue;
            $parts = array_map('trim', explode('|', $line));
            if (count($parts) >= 2) {
                $specs[] = [
                    'label_uz' => $parts[0],
                    'label_ru' => $parts[1] ?? $parts[0],
                    'value'    => $parts[2] ?? '',
                ];
            }
        }
        return $specs;
    }
}
