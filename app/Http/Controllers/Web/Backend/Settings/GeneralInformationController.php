<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGeneralInformationRequest;
use App\Models\GeneralInformation;
use Illuminate\Http\Request;

class GeneralInformationController extends Controller
{
    public function index()
    {
        // Render the general-information settings index page view located at 'backend.layout.settings.generalInformation.index'.
        return view('backend.layout.settings.generalInformation.index', ['generalInformation' => GeneralInformation::first()]);
    }

    public function update(StoreGeneralInformationRequest $request)
    {
        // Check if an ID is provided in the request
        if ($request->id) {
            // Update existing general information
            $companyInformation = GeneralInformation::findOrFail($request->id);
        } else {
            // Create new general information
            $companyInformation = new GeneralInformation();
        }
        // Assign values from the request to the company information object
        $companyInformation->company_name = $request->company_name;
        $companyInformation->company_phone_number = $request->company_phone_number;
        $companyInformation->company_email = $request->company_email;
        $companyInformation->address = $request->address;
        $companyInformation->company_description = $request->company_description;
        // Save the changes or new record
        $companyInformation->save();

        // Redirect to the index page
        return redirect()->route('company-information.index')->with("success", "Updated Successfully");
    }
}
