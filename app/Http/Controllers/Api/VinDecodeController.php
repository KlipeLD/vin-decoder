<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VinDecodeRequest;
use App\Services\VinDecoderService;

class VinDecodeController extends Controller
{
    public function __construct(
        private readonly VinDecoderService $decoder
    ) {}

    public function __invoke(VinDecodeRequest $request)
    {
        $vin = $request->validated()['vin'];

        $result = $this->decoder->decode($vin);

        return response()->json([
            'data' => $result,
        ]);
    }
}
