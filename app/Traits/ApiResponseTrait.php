<?php

namespace App\Traits;

trait ApiResponseTrait
{
    public function returnResponse($data, $code)
    {
        if (isset($data->resource) && $data->resource instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            return response()->json(
                [
                    'data'       => $data,
                    'pagination' => [
                        'currentPage' => $data->currentPage(),
                        'perPage'     => $data->perPage(),
                        'lastPage'    => $data->lastPage(),
                        'total'       => $data->total()
                    ]
                ],
                $code
            );
        } else {
            return response()->json(['data' => $data], $code);
        }
    }
}
