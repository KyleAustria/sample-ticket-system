<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use App\Models\User;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        // var_dump($request->user()->id);
        // var_dump($request->query());
        $searchbox = $request->query('searchbox');
        if($searchbox == ''){
            $tickets = Ticket::where('submitter_id',$request->user()->id)->get();
        }else{
            $tickets = Ticket::where('name','like','%'.$searchbox.'%')->where('submitter_id',$request->user()->id)->get();
        }
        return view('dashboard' , ['tickets'=>$tickets]);
    }

}
