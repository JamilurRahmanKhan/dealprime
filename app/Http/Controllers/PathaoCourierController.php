<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Services\PathaoCourierService;
use Illuminate\Http\Request;
use App\Models\Order;

class PathaoCourierController extends Controller
{
    protected $pathaoService;

    public function __construct(PathaoCourierService $pathaoService)
    {
        $this->pathaoService = $pathaoService;
    }

    public function getZonesByCity($cityId)
    {
        $zones = $this->pathaoService->getZones($cityId);
        return response()->json($zones);
    }

    public function getAreasByZone($zoneId)
    {
        $areas = $this->pathaoService->getAreas($zoneId);
        return response()->json($areas);
    }

}
