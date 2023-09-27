<?php

namespace App\Http\Controllers;

use App\Models\ShorteningLink;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirect(Request $request,string $url) {
        $getUrl = ShorteningLink::whereShortening_link($url)->value('original_link');
        return redirect()->away($getUrl);
    }
}
