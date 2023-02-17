<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ShortUrl;
use Illuminate\Support\Facades\Redirect;

class URLShorterController extends Controller
{
    public function index(Request $request)
    {
        $urls = ShortUrl::orderBy('created_at', 'desc')->limit(10)->get();

        return response()->json([
            'status' => 'success',
            'urls' => $urls
        ]);
    }

    public function store(Request $request)
    {

        #validate data
        $this->validate($request, [
            'destination' => 'required|url',
        ]);

        #generate slug
        $slug = Str::random(5);

        #save data in DB
        $url = new ShortUrl();
        $url->destination = $request->destination;
        $url->slug = $slug;
        $url->save();

        return response()->json([
            'status' => 'success',
            'url' => $url
        ]);
    }

    public function redirectToUrl($slug)
    {
        $req_url = ShortUrl::where('slug', $slug)->first();
        if (!$req_url) {
            abort(404, 'The record does not exist on our system');
        }

        #redirect to actual url
        return Redirect::to($req_url->destination);
    }
}
