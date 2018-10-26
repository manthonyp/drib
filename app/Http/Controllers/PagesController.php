<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    /**
     * Pages home
     *
     * @return void
     */
    public function index()
    {
        return view('pages.home');
    }

    /**
     * Pages about
     *
     * @return void
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Pages terms and agreement
     *
     * @return void
     */
    public function terms()
    {
        return view('pages.terms');
    }

    /**
     * Pages privacy and policy
     *
     * @return void
     */
    public function privacy()
    {
        return view('pages.privacy');
    }
}
