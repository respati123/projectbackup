<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriSejarah;
use App\Sejarah;
use Session;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [

            'sejarah'   => Sejarah::count(),
            'kategori'  => KategoriSejarah::count()

        ];

        return view('partials.dashboard')->with('data', $data);
    }
}
