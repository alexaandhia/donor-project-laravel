<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\Donor;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($donor_id)
    {
        $donor = Response::where('donor_id', $donor_id)->first();
        $donorId = $donor_id;
        return view('response', compact('donor', 'donorId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $donor_id)
    {
        $request->validate(
            [
                'status' => 'required',
            ]);

            if($request->status == "denied"){
                $dated = null;
            }else{
                $dated = $request->date;
            }

        Response::updateOrCreate(
            ['donor_id' => $donor_id, ],
            [
                'status' => $request->status,
                'date' => $dated,
            ]);
        
            return redirect()->route('officer')->with('successResponse', 'Responding succeed');
    }

    public function sortType(Request $request){
        $select = $request->sort;
        $donors = Donor::whereHas('response', function ($query) use ($select) {
            $query->where('status', $select);
        })->with('response')->get();
    
        return view('officer', compact('select', 'donors'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Response $response)
    {
        //
    }
}
