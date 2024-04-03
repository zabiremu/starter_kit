<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Http\Controllers\Controller;
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

    public function update(Request $request)
    {

        // Validate the incoming request
        $request->validate([
            'company_name'              => 'required|string',
            'company_phone_number'      => 'required|string',
            'company_email'             => 'required|string',
            'favicon'                   => 'nullable|image',
            'logo'                      => 'nullable|image',
            'address'                   => 'required|string',
            'company_description'       => 'required|string',
        ]);

        // Check if an ID is provided in the request
        if ($request->id) {
            // Update existing company information
            $companyInformation = CompanyInformation::findOrFail($request->id);
        } else {
            // Create new company information
            $companyInformation = new CompanyInformation();
        }

        // Assign values from the request to the company information object
        $companyInformation->company_name = $request->company_name;
        $companyInformation->company_phone_number = $request->company_phone_number;
        $companyInformation->company_email = $request->company_email;
        $companyInformation->address = $request->address;
        $companyInformation->company_description = $request->company_description;
        // Delete old logo and favicon images if new ones are provided
        deleteImage($companyInformation->logo,$request->logo);
        deleteImage($companyInformation->favicon,$request->favicon);
        // Save new logo and favicon images and get their paths
        $image_logo= saveImage($request->logo,'companyInfo','company-logo',$companyInformation->logo);
        $image_favicon= saveImage($request->favicon,'companyInfo','company-favicon',$companyInformation->favicon);
        $companyInformation->logo = $image_logo;
        $companyInformation->favicon = $image_favicon;
        // Assign other fields as needed


        // Save the changes or new record
        $companyInformation->save();

        // Redirect to the index page
        return redirect()->route('companyinformation.index')->with("success", "Updated Successfully");
    }
}
