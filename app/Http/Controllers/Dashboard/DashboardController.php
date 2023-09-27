<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ShorteningLink;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $userId = auth()->user()->id;

            $datas = ShorteningLink::with(['click' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }])
                ->whereHas('click', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->get();
        } catch (\Exception $exception) {

        }

        return view('pages.dashboard', ['datas' => $datas]);
    }
}
