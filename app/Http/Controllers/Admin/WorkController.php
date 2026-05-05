<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkController extends Controller
{
    public function index()
    {
        $works = Work::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.works.index', compact('works'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'images'      => 'required|array|min:1',
            'images.*'    => 'required|image|max:4096',
            'caption_uz'  => 'nullable|string|max:200',
            'caption_ru'  => 'nullable|string|max:200',
            'caption_en'  => 'nullable|string|max:200',
        ]);

        foreach ($request->file('images') as $file) {
            $path = $file->store('works', 'public');
            Work::create([
                'image'      => $path,
                'caption_uz' => $request->caption_uz,
                'caption_ru' => $request->caption_ru,
                'caption_en' => $request->caption_en,
                'sort_order' => Work::max('sort_order') + 1,
            ]);
        }

        return back()->with('success', 'Rasm(lar) muvaffaqiyatli qo\'shildi.');
    }

    public function destroy(Work $work)
    {
        if (!str_starts_with($work->image, 'http')) {
            Storage::disk('public')->delete($work->image);
        }
        $work->delete();
        return back()->with('success', 'Rasm o\'chirildi.');
    }
}
