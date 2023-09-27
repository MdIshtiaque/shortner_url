<?php

namespace App\Http\Controllers\Shortner;

use App\Http\Controllers\Controller;
use App\Services\ShorteningService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShorteningController extends Controller
{
    public function getShorteningLink(Request $request): JsonResponse
    {
        try {
            $shorteningService = new ShorteningService();
            $getShorteningLink = $shorteningService->getShorteningLink($request);

            return sendSuccessResponse(
                "URL Short Successfully",
                200,
                $getShorteningLink
            );
        } catch (Exception $exception) {
            return sendErrorResponse("ShorteningController.getShorteningLink: " . $exception->getMessage());
        }
    }
}
