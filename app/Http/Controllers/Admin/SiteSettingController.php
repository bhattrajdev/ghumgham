<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteSettingUpdateRequest;
use App\Models\SiteSetting;
use App\Traits\UploadFileTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SiteSettingController extends Controller
{
    use UploadFileTrait;

    public function index()
    {
        $site_setting = SiteSetting::first();
        return view("admin.siteSetting.edit", compact("site_setting"));
    }


    // public function update(SiteSettingUpdateRequest $request, SiteSetting $site_setting)
    // {
    //     $a = $site_setting->update($request->safe()->except('image'));
    //     Log::info($a);
    //     if ($request->hasFile('image')) {
    //         $data =   $site_setting->updateFeatureImage($site_setting->site_title, $request->file('image'));
    //     }
    //     return redirect()->route('admin.sitesettings.index')->with('success', 'SiteSetting Updated Successfully!');
    // }

    public function update(SiteSettingUpdateRequest $request, SiteSetting $site_setting)
    {
        $data = $site_setting->updateFeatureImage($site_setting->site_title, $request->file('image'));
        Log::info('Feature Image Update Data: ', ['data' => $data]);

        if ($request->hasFile('image')) {
            $data = $site_setting->updateFeatureImage($site_setting->site_title, $request->file('image'));
            Log::info('Feature Image Update Data: ', ['data' => $data]);
        }
        return redirect()->route('admin.sitesettings.index')->with('success', 'SiteSetting Updated Successfully!');
    }
}
