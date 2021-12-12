<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProvinces()
    {
        $provinces = DB::table('provinces')->get();
        return response()->json($provinces);
    }

    public function getDistricts(Request $request)
    {
        $districts = DB::table('districts')->where('province_id', $request->id)->get();
        return response()->json($districts);
    }
    public function getWards(Request $request)
    {
        $wards = DB::table('wards')->where('district_id', $request->id)->get();
        return response()->json($wards);
    }
}
