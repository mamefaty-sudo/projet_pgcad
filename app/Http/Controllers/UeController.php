<?php

namespace App\Http\Controllers;

use App\Models\Ue;
use App\Http\Requests\StoreUeRequest;
use App\Http\Requests\UpdateUeRequest;

class UeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ue = Ue::all();  
        return view('uesindex', 
        compact('ue'));
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
    public function store(StoreUeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ue $ue)
    {
         $module = Ue:: find($ue);
         return view('ues.show',compact('ue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ue $ue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUeRequest $request, Ue $ue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ue $ue)
    {
        //
    }

    
}
