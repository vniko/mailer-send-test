<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendResponse($data, $message = '', $code = 200)
    {
        return Response::json([
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ], $code);
    }

    public function sendError($error, $data = null, $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return Response::json($response, $code);
    }

    public function sendSuccess($message, $data = null, $code = 200)
    {
        $this->sendResponse($data, $message, $code);
    }

    protected function resolveResourceName($model)
    {
        $class = 'App\Http\Resources\\'. $model .'Resource';
        if (!class_exists($class)) {
            return 'App\Http\Resources\GenericResource';
        }

        return $class;
    }
}
