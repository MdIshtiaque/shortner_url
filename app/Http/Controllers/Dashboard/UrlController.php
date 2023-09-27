<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ShorteningLink;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function makeCustomUrl(Request $request)
    {

        try {
            $customUrl = ShorteningLink::whereid($request->url_id)->first();

            $customUrl->update([
                'shortening_link' => $request->new_url
            ]);
            toastr()->addSuccess('Custom Link Created');
        } catch (\Exception $exception) {
            toastr()->addError('Error :'. $exception->getMessage());
        }


        return back();
    }
}
