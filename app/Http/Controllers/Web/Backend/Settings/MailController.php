<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMailSettingRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class MailController extends Controller
{
    public function index()
    {
        // Render the mail settings index page view located at 'backend.layout.settings.mailSettings.index'.
        return view('backend.layout.settings.mailSettings.index');
    }

    public function update(StoreMailSettingRequest $request)
    {

        // Retrieve the form data
        $mail_transport = $request->input('mail_transport');
        $mail_host = $request->input('mail_host');
        $mail_port = $request->input('mail_port');
        $mail_username = $request->input('mail_username');
        $mail_password = $request->input('mail_password');
        $mail_encryption = $request->input('mail_encryption');
        $address = $request->input('mail_from');
        // Retrieve other email settings similarly

        // Update the .env file
        $envFile = base_path('.env');

        // Update existing entries or append new ones
        $envContent = File::get($envFile);
        $envContent = Str::replaceMatches('/(MAIL_MAILER=).*/', '$1' . $mail_transport, $envContent);
        $envContent = Str::replaceMatches('/(MAIL_HOST=).*/', '$1' . $mail_host, $envContent);
        $envContent = preg_replace('/^MAIL_PORT=.*/m', 'MAIL_PORT=' . $mail_port, $envContent);
        $envContent = Str::replaceMatches('/(MAIL_USERNAME=).*/', '$1' . $mail_username, $envContent);
        $envContent = Str::replaceMatches('/(MAIL_PASSWORD=).*/', '$1' . $mail_password, $envContent);
        $envContent = Str::replaceMatches('/(MAIL_ENCRYPTION=).*/', '$1' . $mail_encryption, $envContent);
        $envContent = Str::replaceMatches('/(MAIL_FROM_ADDRESS=).*/', '$1' . $address, $envContent);

        File::put($envFile, $envContent);

        return redirect()->route('mail-settings.index')->with("success", "Updated Successfully");
    }
}
