<?php

use Illuminate\Http\JsonResponse;

function sendSuccessResponse(string $message, int $statusCode = 200, $payload = []): JsonResponse
{
    return response()->json([
        'success' => true,
        'message' => $message,
        'data'    => $payload
    ], $statusCode);
}

function sendErrorResponse(string $message, int $statusCode = 200, $payload = []): JsonResponse
{
    return response()->json([
        'success' => false,
        'message' => $message,
        'data'    => $payload
    ], $statusCode);
}


if (!function_exists('unique_short_url')) {
    function unique_short_url($model, $column, $url): string
    {
        $size = 3;
        while (true) {


            // Generate SHA-256 hash of the original URL
            $hash = hash('sha256', $url);

            // Encrypt the hash using AES-256 with a secret key
            $iv = openssl_random_pseudo_bytes(16); // Initialization Vector
            $encryptedHash = openssl_encrypt($hash, 'aes-256-cbc', "shortify", 0, $iv);

            // Encode the encrypted hash in Base64
            $base64EncodedHash = base64_encode($encryptedHash);

            // Add a random component (e.g., timestamp)
            $randomComponent = date('s') . date('i') . date('dmY');

            // Combine with a custom prefix
            $shortenedUrl = $base64EncodedHash . $randomComponent;
            $finalShortenedUrl = bin2hex($base64EncodedHash) . $shortenedUrl;
            // Ensure it's exactly three characters in hexadecimal
            if (strlen($finalShortenedUrl) < $size) {
                $finalShortenedUrl = str_pad($finalShortenedUrl, $size, '0', STR_PAD_RIGHT);
            } elseif (strlen($finalShortenedUrl) > $size) {
                $finalShortenedUrl = substr($finalShortenedUrl, 10, $size);
            }
            $finalShortenedUrl = base_convert($finalShortenedUrl, 16, 36);



            $existingModel = $model::query()->where($column, $finalShortenedUrl)->first();

            if (!$existingModel) {
                return $finalShortenedUrl;
            }else {
                if($existingModel->matched != true) {
                    $existingModel->update([
                        'matched' => true
                    ]);
                }
            }
            $combinationExceed = $model::query()->where('matched', true)->get();
            if ($combinationExceed == '') {
                $size++;
            }
        }
    }

}



?>
