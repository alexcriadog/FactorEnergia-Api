<?php

namespace App\Domain\Queries;

use Illuminate\Support\Facades\Http;
use App\Models\StackOverflowQuery;

class StackOverflowQueryService
{
    public function executeQuery($tagged, $toDate, $fromDate)
    {
        // Construir la URL de la API Stack Exchange con los filtros
        $apiUrl = 'https://api.stackexchange.com/2.3/questions';
        $apiParams = [
            'order' => 'desc',
            'site' => 'stackoverflow',
            'tagged' => $tagged,
        ];

        // Agregar 'todate' y 'fromdate' solo si están presentes en la solicitud
        if ($toDate !== null) {
            $apiParams['min'] = $toDate;
        }

        if ($fromDate !== null) {
            $apiParams['fromdate'] = $fromDate;
        }
        
        // Realizar la consulta a la API de Stack Overflow
        return Http::get($apiUrl, $apiParams);

    }

    public function getStoredResult($tagged, $toDate, $fromDate)
    {
        // Verificar si la consulta ya existe en la base de datos
        return StackOverflowQuery::where('tagged', $tagged)
            ->where('to_date', $toDate)
            ->where('from_date', $fromDate)
            ->first();
    }

    public function saveQueryResult($tagged, $toDate, $fromDate, $result)
    {
        StackOverflowQuery::create([
            'tagged' => $tagged,
            'to_date' => $toDate,
            'from_date' => $fromDate,
            'result' => json_encode($result),
        ]);
    }
}
