<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

/**
 *
 */
trait DeleteModelTrait
{
    public function deleteModelTrait($id, $model){
        try {
            $model->find($id)->delete();
            return response()->json(
                [
                    'code' => 200,
                    'message' => 'success',
                ],
                200,
            );
        } catch (\Exception $e) {
            Log::error('msg: ' . $e->getMessage() . 'Line: ' . $e->getLine());
            return response()->json(
                [
                    'code' => 500,
                    'message' => 'fail',
                ],
                500,
            );
        }
    }
}
