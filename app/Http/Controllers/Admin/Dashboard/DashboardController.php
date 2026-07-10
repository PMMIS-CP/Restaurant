<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_reservations' => 0,
            'total_orders' => 0,
            'total_menu_items' => 0,
            'recent_reservations' => [],
            'recent_orders' => [],
        ];

        return view('admin.dashboard.index', compact('stats'));
    }
}