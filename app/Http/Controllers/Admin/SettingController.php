<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $logo = Setting::where('key', 'site_logo')->value('value');
        $banner = Setting::where('key', 'site_banner')->value('value');
        
        return view('admin.settings.index', compact('logo', 'banner'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'site_banner' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => $path, 'type' => 'image', 'label' => 'Site Logo']
            );
        }

        if ($request->hasFile('site_banner')) {
            $path = $request->file('site_banner')->store('settings', 'public');
            Setting::updateOrCreate(
                ['key' => 'site_banner'],
                ['value' => $path, 'type' => 'image', 'label' => 'Hero Banner']
            );
        }

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully.');
    }
}
