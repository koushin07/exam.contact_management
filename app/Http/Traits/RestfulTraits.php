<?php

namespace App\Http\Traits;


trait RestfulTraits
{
    public function ok($data){
        return response()->json($data, 200);
    }
    public function error($data = null){
        return response()->json($data, 500);
    }
    public function created($data){
        return response()->json($data, 201);
    }
    public function unauthorize($data=null){
        return response()->json($data, 401);
    }
}
