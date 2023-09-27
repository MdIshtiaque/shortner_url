<?php

namespace App\Http\Controllers;

use App\Models\ClickCount;
use App\Models\ShorteningLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirectToUrl(Request $request, $url): RedirectResponse
    {
        try {
            $getUrl = ShorteningLink::with('user')->where('shortening_link', $url)->first();
            if (auth()->check()) {
                $clickExist = ClickCount::whereShortening_link_id($getUrl->id)->whereUser_id(auth()->user()->id)->first();
            } else {
                $clickExist = ClickCount::whereShortening_link_id($getUrl->id)->whereUser_id(NULL)->first();
            }

            $clickCounter = 1;
            if (!$clickExist) {
                ClickCount::create([
                    'shortening_link_id' => $getUrl->id,
                    'user_id' => auth()->user() ? auth()->user()->id : NULL,
                    'count' => $clickCounter
                ]);
            } else {
                $clickCounter = $clickExist->count + 1;
                $clickExist->update([
                    'count' => $clickCounter
                ]);
            }


        } catch (\Exception $exception) {

        }

        return redirect()->away($getUrl->original_link);
    }

}
