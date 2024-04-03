<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function index()
    {
        // Render the  index page view located at 'backend.layout.settings.mailSettings.index'.
        return view('backend.layout.settings.mailSettings.index');
    }
}
