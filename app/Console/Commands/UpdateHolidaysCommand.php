<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\HolidayICSService;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class UpdateHolidaysCommand extends Command
{
   
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'holidays:update';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Met à jour les jours fériés depuis le flux ICS';
    protected $holidayICSService;

       public function __construct(HolidayICSService $holidayICSService)
    {
        parent::__construct();
        $this->holidayICSService = $holidayICSService;
    }


    /**
     * Execute the console command.
     */

    public function handle()
    {
        $startPeriod = Carbon::now()->startOfYear()->toDateString();
        $endPeriod   = Carbon::now()->endOfYear()->toDateString();

        $holidays = $this->holidayICSService->getHolidays($startPeriod, $endPeriod);

        // Stockage de la liste en cache pour utilisation dans le calcul des périodes
        Cache::put('senegal_holidays', $holidays, now()->addDays(7));

        $this->info('Les jours fériés ont été mis à jour.');
    }
}
