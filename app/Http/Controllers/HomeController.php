<?php

namespace App\Http\Controllers;

use App\Modules\Time\Repositories\Interfaces\TimeLogRepositoryInterface as TimeLogRepository;

class HomeController extends Controller
{
    /**
     * Show the profile config page.
     *
     * @param  App\Modules\Time\Repositories\Interfaces\TimeLogRepositoryInterface $timeLogRepository
     * @return \Illuminate\Http\Response
     */
    public function index(TimeLogRepository $timeLogRepository)
    {
        $weekly_summary = $timeLogRepository->weeklySummary();
        return view('welcome', compact('weekly_summary'));
    }
}
