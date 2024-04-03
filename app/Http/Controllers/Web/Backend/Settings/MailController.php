<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index()
    {
        $mail_settings = [];

        return view('backend.layout.settings.mailSettings.index', compact('mail_settings'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'mail_transport'              => 'required|string',
            'mail_host'                   => 'required|string',
            'mail_port'                   => 'required|string',
            'mail_username'               => 'required|string',
            'mail_password'               => 'required|string',
            'mail_encryption'             => 'required|string',
            'mail_from'                   => 'required|string',
        ]);
        // Check if an ID is provided in the request

        return redirect()->route('mailsettings.index')->with("success", "Updated Successfully");
    }
}
