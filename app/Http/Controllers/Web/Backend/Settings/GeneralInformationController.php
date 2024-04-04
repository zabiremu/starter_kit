<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use Illuminate\Http\Request;
use App\Models\GeneralInformation;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGeneralInformationRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GeneralInformationController extends Controller
{
    public function index()
    {
        // Retrieve the first general information record
        $generalInformation = GeneralInformation::first();
        // Render the general-information settings index page view located at 'backend.layout.settings.generalInformation.index'.;
        return view('backend.layout.settings.generalInformation.index', compact('generalInformation'));
    }

    public function update(StoreGeneralInformationRequest $request)
    {

        // Check if an ID is provided in the request
        if ($request->id) {
            // Update existing general information
            $generalInformation = GeneralInformation::find($request->id);
        } else {
            // Create new general information
            $generalInformation = new GeneralInformation();
        }
        // Update the .env file
        $envFile = base_path('.env');
        $envContent = File::get($envFile);
        $envContent = Str::replaceMatches('/(APP_NAME=).*/', '$1"' . $request->app_title . '"', $envContent);
        File::put($envFile, $envContent);
        // Assign values from the request to the company information object
        $generalInformation->app_title = $request->app_title;
        $generalInformation->author_name = $request->author_name;
        $generalInformation->meta_keywords = $request->meta_keywords;
        $generalInformation->meta_description = $request->meta_description;
        $generalInformation->copyright = $request->copyright;
        // Save the changes or new record
        $generalInformation->save();

        // Redirect to the index page
        return redirect()->route('admin.general-information.index')->with("success", "Updated Successfully");
    }
}
