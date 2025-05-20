<?php

namespace App\Observers;

use App\Models\AcademicPeriode;
use App\Models\DateExtreme;
use App\Services\AcademicPeriodeService;
use Carbon\Carbon;

class AcademicPeriodeObserver
{
    /**
     * Handle the AcademicPeriode "created" event.
     */
    protected $academicPeriodeService;

    public function __construct(AcademicPeriodeService $academicPeriodeService) 
    {
        $this->acadenicPeriodeService = $academicPeriodeService;
    }

    /*avant la creation de periode academique , il faut calculer la fin en tenant compte des jour ferier
    et aussi la periode d'examens dans les deux derniers semaine
    
    @param AcademicPeriode $academicPeriode
    @return void
    */

    public function creating(AcademicPeriode $academicPeriode): void
    {
        $holidays = $this->academicPeriodeService->getHolidaysDatesForPeriode($academicPeriode->date_debut, $academicPeriode->semaine);

        if($academicPeriode->type === 'examen') {
            $academicPeriode->semaine = 2;

            //rechercher le semestre correspndant et a l'annee academique
            $semestre = AcademicPeriode::where('annee_academique_id', $academicPeriode->annee_academique_id)
                ->where('niveau_id', $academicPeriode=niveau_id)
                ->where('type', 'semestre')
                ->where('date_debut', 'asc')
                ->first();

            if($semestre){
                $finSemestre = Carbon::parse($semestre->date_fin);
                 // Positionner la période d'examen sur les deux dernières semaines du semestre.
                $academicPeriode->date_debut =$finSemestre->subWeeks(2)->toDateString();
                $academicPeriode->date_fin = $finSemestre->toDateSting();

            }else{
                  // En cas d'absence de semestre identifié, appliquer le calcul standard.
                $academicPeriod->end_date = $this->academicPeriodService
                    ->calculDateFinEffective($academicPeriod->start_date, $academicPeriod->weeks, $holidays);
            }
        }else{
              // Pour les autres types de périodes, calcul standard du terme effectif.
            $academicPeriode->date_fin = $this->academicPeriodeService
                ->calculDateFinEffective($academicPeriod->date_debut, $academicPeriod->semaine, $holidays);
        }
    }
     /**
     * Après création d'une période, mettre à jour les dates extrêmes.
     *
     * @param AcademicPeriod $academicPeriod
     */

    public function created(AcademicPeriode $academicPeriode): void
    {
        $this->updateDateExtremes($academicPeriod);
    }

    /**
     * Handle the AcademicPeriode "updated" event.
     */
    public function updated(AcademicPeriode $academicPeriode): void
    {
         $this->updateDateExtremes($academicPeriod);
    }

    /**
     * Handle the AcademicPeriode "deleted" event.
     */
    public function deleted(AcademicPeriode $academicPeriode): void
    {
        $this->updateDateExtremes($academicPeriod);
    }

    /**
     * Handle the AcademicPeriode "restored" event.
     */
    public function restored(AcademicPeriode $academicPeriode): void
    {
        //
    }

    /**
     * Handle the AcademicPeriode "force deleted" event.
     */
    public function forceDeleted(AcademicPeriode $academicPeriode): void
    {
        //
    }

    /**
     * Recalcule et met à jour les dates extrêmes (date de début la plus ancienne et date de fin la plus tardive)
     * pour l'année académique associée.
     *
     * @param AcademicPeriod $academicPeriod
     */
     protected function updateDateExtremes(AcademicPeriod $academicPeriod)
    {
        $academicYearId = $academicPeriod->academic_year_id;

        // Récupère la date de début la plus ancienne et la date de fin la plus tardive pour l'année académique.
        $dateDebut = AcademicPeriode::where('annee_academique_id', $anneeAcademiqueId)->min('date_debut');
        $dateFin   = AcademicPeriode::where('annee_academique_id', $anneeAcademiqueId)->max('date_fin');

        // Met à jour ou crée l'enregistrement dans la table "date_extremes".
        DateExtreme::updateOrCreate(
            ['annee_academique_id' => $anneeAcademiqueId],
            [
                'date_debut' => $dateDebut,
                'date_fin'   => $dateFin,
            ]
        );
    }
}
