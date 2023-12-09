<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\StackOverflowModel;

class StackOverflowController extends Controller
{
    //
    public function getDataFromAPI(Request $request){
        // Validar que el filtro 'tagged' sea obligatorio
        $request->validate([
            'tagged' => 'required',
        ]);

        // Ver si contiene los filtros todate y fromdate y guardarlos en el formato que se requiere en la API de StackOverflow
        $toDate = $request->has('todate') ? strtotime($request->input('todate')) : null;
        $fromDate = $request->has('fromdate') ? strtotime($request->input('fromdate')) : null;

        // Construir la URL de la API Stack Exchange con los filtros
        $apiUrl = 'https://api.stackexchange.com/2.3/questions';
        $apiParams = [
            'order' => 'desc',
            'site' => 'stackoverflow',
            'tagged' => $request->input('tagged'),
        ];

        // Agregar 'todate' y 'fromdate' solo si están presentes en la solicitud
        if ($toDate !== null) {
            $apiParams['min'] = $toDate;
        }

        if ($fromDate !== null) {
            $apiParams['fromdate'] = $fromDate;
        }
        
        // Realizar la consulta a la API de Stack Overflow
        $apiResponse = Http::get($apiUrl, $apiParams);

        return $apiResponse;
    }
}
