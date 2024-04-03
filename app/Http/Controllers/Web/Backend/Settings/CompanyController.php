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
        // Render the company-information settings index page view located at 'backend.layout.settings.companyInformation.index'.
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
        // Save the favicon image provided in the request.
        // Parameters:
        // 1. $request->favicon: The uploaded favicon image file.
        // 2. 'companyInfo': The directory in which the image will be saved.
        // 3. 'company-favicon': The filename to be used for the saved favicon image.
        // 4. $companyInformation->favicon: The existing favicon filename (if any) to be replaced.
        $image_favicon = saveImage($request->favicon, 'companyInfo', 'company-favicon', $companyInformation->favicon);
        // Save the logo image provided in the request.
        // Parameters:
        // 1. $request->logo: The uploaded logo image file.
        // 2. 'companyInfo': The directory in which the image will be saved.
        // 3. 'company-logo': The filename to be used for the saved logo image.
        // 4. $companyInformation->logo: The existing logo filename (if any) to be replaced.
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
