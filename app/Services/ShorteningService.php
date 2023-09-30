<?php

namespace App\Services;

use App\Models\ShorteningLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

            DB::beginTransaction();

            $shortLink = ShorteningLink::create([
                'created_by' => $request->userId,
                'original_link' => $request->originalUrl,
                'shortening_link' => $shortUrl
            ]);

            $shortLink->click()->create([
                'shortening_link_id' => $shortLink->id,
                'user_id' => $request->userId,
                'count' => 0
            ]);

            DB::commit();

        } else {
            $shortUrl = $linkExist->shortening_link;
        }

        return $shortUrl;
    }
}
