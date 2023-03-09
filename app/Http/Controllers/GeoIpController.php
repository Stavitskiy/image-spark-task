<?php

namespace App\Http\Controllers;

use App\Models\GeoIp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GeoIpController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function requestInfo(Request $request): JsonResponse
    {
        $data = Cache::has((string) $request->ip) ? Cache::get((string) $request->ip) : null;

        if ($data) {
            return response()->json($data);
        }

        $model = GeoIp::where('ip', (string) $request->ip)->first();

        if ($model) {
            $data = $this->dataPreparation($model);
            Cache::put((string) $request->ip, $data, now()->addMinutes(30));

            return response()->json($data);
        }

        return response()->json([$this->dataPreparation()]);
    }


    /**
     * @param GeoIp|null $model
     * @return array
     */
    protected function dataPreparation(GeoIp $model = null): array
    {
        if ($model) {
            return [
                'code' => 200,
                'ip' => $model->ip,
                'latitude' => $model->latitude,
                'longitude' => $model->longitude,
                'country' => $model->country,
                'city' => $model->city
            ];
        }

        return [
            'code' => 404
        ];
    }
}
