<?php

namespace App\Helpers;



class jsonPrint
{
    public static function prints($data)
    {
        return response()->json($data,200,[],JSON_PRETTY_PRINT);  
    }
}
