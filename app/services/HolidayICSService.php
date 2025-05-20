<?php
// app/Services/HolidayICSService.php

namespace App\Services;

use Carbon\Carbon;
use ICal\ICal; // Vous pouvez utiliser une librairie externe pour parser ICS (ex: iCalcreator)

class HolidayICSService
{
    protected $icsUrl;

    public function __construct()
    {
        // URL du flux ICS pour le Sénégal (option 1 de Office Holidays, par exemple)
        $this->icsUrl = 'https://www.officeholidays.com/ics/senegal';
    }

    /**
     * Récupère les jours fériés entre deux dates.
     *
     * @param string $debut
     * @param string $fin
     * @return array Liste des dates (format 'Y-m-d')
     */
    public function getHolidays(string $debut, string $fin): array
    {
        $ical = new ICal($this->icsUrl, [
            'defaultSpan'           => 2,     // la durée par défaut (en jours) pour les événements non durés
            'defaultTimeZone'       => 'Africa/Dakar',
            'eventsArrayAs'         => 'array'
        ]);

        $holidays = [];
        foreach ($ical->events() as $event) {
            $eventStart = Carbon::parse($event['DTSTART']);
            // On s'assure que l'événement se situe dans l'intervalle souhaité
            if ($eventStart->between(Carbon::parse($debut), Carbon::parse($fin))) {
                $holidays[] = $eventStart->format('Y-m-d');
            }
        }
        return $holidays;
    }
}

