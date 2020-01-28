<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LocalizationController extends Controller {

    public function index($locale) {

        app()->setLocale($locale);

        //Gets the translated message and displays it
        echo trans('flash.comment_checked');
    }
}
