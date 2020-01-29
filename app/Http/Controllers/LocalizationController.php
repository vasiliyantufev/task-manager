<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LocalizationController extends Controller
{

    public function index($locale)
    {
        \App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
