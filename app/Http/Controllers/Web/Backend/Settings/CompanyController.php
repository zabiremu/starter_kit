<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyInformation;
use App\Models\CompanyInformation;
use Illuminate\Http\Request;


class CompanyController extends Controller
{
    public function index()
    {
        // Retrieve the first company information record
        $companyInformation = CompanyInformation::first();

        return view('backend.layout.settings.companyInformation.index', compact('companyInformation'));
    }

    public function update(StoreCompanyInformation $request)
    {
        // Check if an ID is provided in the request
        if ($request->id) {
            // Update existing company information
            $companyInformation = CompanyInformation::findOrFail($request->id);
        } else {
            // Create new company information
            $companyInformation = new CompanyInformation();
        }
        $image_favicon = saveImage($request->favicon, 'companyInfo', 'company-favicon', $companyInformation->favicon);
        $image_logo = saveImage($request->logo, 'companyInfo', 'company-logo', $companyInformation->logo);

        // Assign values from the request to the company information object
        $companyInformation->company_name = $request->company_name;
        $companyInformation->company_phone_number = $request->company_phone_number;
        $companyInformation->company_email = $request->company_email;
        $companyInformation->address = $request->address;
        $companyInformation->company_description = $request->company_description;
        // Delete old logo and favicon images if new ones are provided

        // Save new logo and favicon images and get their paths

        $companyInformation->logo = $image_logo;
        $companyInformation->favicon = $image_favicon;
        // Assign other fields as needed


        // Save the changes or new record
        $companyInformation->save();

        // Redirect to the index page
        return redirect()->route('company-information.index')->with("success", "Updated Successfully");
    }
}
