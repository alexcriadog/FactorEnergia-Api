<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Domain\Queries\StackOverflowQueryService;

class StackOverflowController extends Controller
{
    protected $queryService;

    public function __construct(StackOverflowQueryService $queryService)
    {
        $this->queryService = $queryService;
    }
    //
    public function getDataFromAPI(Request $request){
        // Validar que el filtro 'tagged' sea obligatorio
        $request->validate([
            'tagged' => 'required',
        ]);

        // Ver si contiene los filtros todate y fromdate y guardarlos en el formato que se requiere en la API de StackOverflow
        $toDate = $request->has('todate') ? strtotime($request->input('todate')) : null;
        $fromDate = $request->has('fromdate') ? strtotime($request->input('fromdate')) : null;

        $existingQuery = $this->queryService->getStoredResult($request->input('tagged'), $toDate, $fromDate);

        // Si la consulta ya existe, devolver los resultados almacenados
        if ($existingQuery) {
            $decodedResult = json_decode($existingQuery->result, true);
            return response()->json($decodedResult);
        }

        $apiResponse = $this->queryService->executeQuery($request->input('tagged'), $toDate, $fromDate);

        // Almacenar la consulta y sus resultados en la base de datos
        $this->queryService->saveQueryResult($request->input('tagged'), $toDate, $fromDate, $apiResponse->json());

        return $apiResponse;
    }
}
