<?php

namespace App\Http\Controllers;

use App\Helpers\FacebookHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $socialAccount = Auth::user()->socialAccount;
        $token = $request->session()->get('fb_token')[0];

        $helper = new FacebookHelper();
        $posts = $helper->getPosts($socialAccount->provider_user_id, $token);
        dd($posts);

        return view('home', [
            'posts' => $posts
        ]);
    }
}
