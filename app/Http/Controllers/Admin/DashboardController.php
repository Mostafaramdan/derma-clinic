<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Visit;
use App\Models\Medication;
use App\Models\Radiology;
use App\Models\Lab;
use App\Models\Advice;
use App\Models\Service;
use App\Models\ChronicDisease;
use App\Models\User;
use App\Models\Prescription;

class DashboardController extends Controller
{
    public function index()
    {
        $patientsCount = Patient::count();
        $visitsCount = Visit::count();
        $medicationsCount = Medication::count();
        $radiologiesCount = class_exists('App\\Models\\Radiology') ? Radiology::count() : 0;
        $labsCount = class_exists('App\\Models\\Lab') ? Lab::count() : 0;
        $advicesCount = class_exists('App\\Models\\Advice') ? Advice::count() : 0;
        $servicesCount = class_exists('App\\Models\\Service') ? Service::count() : 0;
        $chronicDiseasesCount = class_exists('App\\Models\\ChronicDisease') ? ChronicDisease::count() : 0;
    $adminsCount = User::role('admin')->count();
        $prescriptionsCount = class_exists('App\\Models\\Prescription') ? Prescription::count() : 0;

        return view('admin.dashboard', compact(
            'patientsCount',
            'visitsCount',
            'medicationsCount',
            'radiologiesCount',
            'labsCount',
            'advicesCount',
            'servicesCount',
            'chronicDiseasesCount',
            'adminsCount',
            'prescriptionsCount',
        ));
    }
}
