<?php

namespace App\Services;

use App\Models\ShorteningLink;
use Illuminate\Http\Request;

class ShorteningService
{

    private function shortUrlLogic(Request $request): string
    {
        return unique_short_url(ShorteningLink::class, "shortening_link");
    }

    public function getShorteningLink(Request $request): string
    {

        $linkExist = ShorteningLink::whereOriginal_link($request->originalUrl)->first();

        if (!$linkExist) {
            $shortUrl = $this->shortUrlLogic($request);

            ShorteningLink::create([
                'created_by' => $request->userId,
                'original_link' => $request->originalUrl,
                'shortening_link' => $shortUrl
            ]);
        } else {
            $shortUrl = $linkExist->shortening_link;
        }

        return $shortUrl;
    }
}
