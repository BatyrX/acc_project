<?php

namespace App\Http\Controllers;

use App\Http\Resources\IpAddressResource;
use App\Models\IpAddress;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    public function index()
    {
        $ipAddresses = IpAddress::all(); 
        return IpAddressResource::collection($ipAddresses);
    }

    public function show($id)
    {
        $ipAddress = IpAddress::findOrFail($id); 
        return new IpAddressResource($ipAddress);
    }

}
