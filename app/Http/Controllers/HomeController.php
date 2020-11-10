<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {

        $test = Order::distinct()->get(['user_id']);

        $user_statistique_order = DB::table('orders')->join('users', 'users.id', '=', 'orders.user_id')
            ->select('users.name as name', DB::raw('count(user_id) as total') ,)
            ->orderBy('user_id', 'desc')
            ->groupBy('user_id')
            ->limit(3)
            ->get();

        $user_count = User::all()->count();
        $product_count = Product::all()->count();
        $order_count = Order::all()->count();
        $total_order = Order::all()->sum('total');;

        $data = array(
            'user_statistique_order' => $user_statistique_order,
            'count_user' => $user_count,
            'product_count' => $product_count,
            'order_count' => $order_count,
            'total_order' => $total_order,

        );

        return view('dashboard.dashboardv1', $data);
    }

}

