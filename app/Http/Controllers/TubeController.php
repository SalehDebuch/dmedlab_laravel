<?php

namespace App\Http\Controllers;

use App\Models\Tube;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TubeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all tubes
        $tubes = Tube::all();

        // Return the tubes as a JSON response
        return response()->json($tubes);
    }


   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check if the authenticated user is an admin
        if (Auth::user()->is_admin) {
            // Validate the request data
            $validatedData = $request->validate([
                'tube_name' => 'required|string',
                'language_id' => 'required|exists:languages,id',
                'color' => 'required|string|max:25',
                'color_name' => 'nullable|string|max:255',
                'img' => 'nullable|string',
            ]);

            
            // Create a new tube with the validated data
            $tube = Tube::create($validatedData);

            // Return the newly created tube as a JSON response
            return response()->json($tube, 201);
        } else {
            // Return an unauthorized error response
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tube  $tube
     * @return \Illuminate\Http\Response
     */
    public function show(Tube $tube)
    {
        /// Return the tube as a JSON response
        return response()->json($tube);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tube  $tube
     * @return \Illuminate\Http\Response
     */
    public function edit(Tube $tube)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tube  $tube
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tube $tube)
    {
        // Check if the authenticated user is an admin
        if (Auth::user()->is_admin) {
            // Validate the request data
            $validatedData = $request->validate([
                'tube_name' => 'required|string',
                'language_id' => 'required|exists:languages,id',
                'color' => 'required|string|max:25',
                'color_name' => 'nullable|string|max:255',
                'img' => 'nullable|string',
            ]);

            // Update the tube with the validated data
            $tube->update($validatedData);

            // Return the updated tube as a JSON response
            return response()->json($tube);
        } else {
            // Return an unauthorized error response
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tube  $tube
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tube $tube)
    {
        // Check if the authenticated user is an admin
        if (Auth::user()->is_admin) {
            // Delete the tube
            $tube->delete();

            // Return a success message as a JSON response
            return response()->json(['message' => 'Tube deleted successfully']);
        } else {
            // Return an unauthorized error response
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
