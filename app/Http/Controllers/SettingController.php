<?php

namespace App\Http\Controllers;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use AttachFilesTrait;
    public function index()
    {
        $collection = Setting::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        return view('pages.setting.index', $setting);
    }

    public function update(Request $request)
    {
        try{
            $info = $request->except('_token', '_method', 'logo');
            foreach($info as $key=> $value){
                Setting::where('key',$key)->update(['value'=> $value]);
            }

            if($request->hasFile('logo')) {
                $logo_name = $request->file('logo')->getClientOriginalName();
                Setting::where('key', 'logo')->update(['value' => $logo_name]);

                //using trait to save the logo in a folder
                $this->uploadFile($request,'logo','logo');
            }
            return back();
        }
        catch (Exception $e){

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
}