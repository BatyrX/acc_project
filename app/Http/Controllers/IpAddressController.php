<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampusResource;
use App\Models\Campus;
use Illuminate\Http\Request;

class IpAddressController extends Controller
{
    public function index()
    {
        $campuses = Campus::with('users')->get();
        return CampusResource::collection($campuses);
    }

    public function show($id)
    {
        $campus = Campus::with('users')->findOrFail($id);
        return new CampusResource($campus);
    }

}
