<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

class UserController extends Controller
{

    function index()
    {
        $users = User::get();
        return response()->json($users);
    }

    function store(Request $request)
    {

        // Convert the requst data to JSON format
        $jsonData = json_encode($request->all());

        // Store the JSON data in a file
        Storage::disk('local')->put('data.json', $jsonData);
        return response()->json(['message' => 'Data stored successfully']);
    }
}
