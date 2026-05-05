<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->keyBy('key');
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        foreach ($request->settings ?? [] as $key => $value) {
            SiteSetting::where('key', $key)->update(['value' => $value]);
        }
        SiteSetting::flush();
        return redirect()->route('admin.settings')->with('success', 'Sozlamalar saqlandi.');
    }
}
