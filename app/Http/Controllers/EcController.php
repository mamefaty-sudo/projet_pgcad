<?php

namespace App\Http\Controllers;

use App\Models\Ec;
use App\Http\Requests\StoreEcRequest;
use App\Http\Requests\UpdateEcRequest;

class EcController extends Controller
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
    public function store(StoreEcRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ec $ec)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ec $ec)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEcRequest $request, Ec $ec)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ec $ec)
    {
        //
    }

    public function SuiviEc(Ec $ec , $heure):array
    {

        $ec->nbHeureSuivi += $heure;

        if ($ec->nbHeureSuivi > $ec->nbHeureTotal){
            $ec->nbHeureSuivi = $ec->nbHeureTotal;
        }

        $ec->save();

        $heureRestante = max(0,$ec->nbHeureTotal - $ec->nbHeureSuivi);
        $pourcentage = ($ec->nbHeureTotal >0)? ($ec->nbHeureSuivi / $ec->nbHeureTotal) * 100 : 0;

        return [
            'Cours' => $ec->Intitule,
            'Heure total' => $ec->nbHeureTotal,
            'Heure Suivie' => $ec->nbHeureSuivi,
            'Heure Retante'=> $heureRestante,
            'Progression' => round($pourcentage,2),
            'Statut' => ($ec->nbHeureSuivie >= $ec->nbHeureTotale)
            ? 'Terminé ✅'
            : 'En cours 📘'
        ];

    }

     
}
