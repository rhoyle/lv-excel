<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        $users = User::all();
        return view('users.customers', compact('users'));
    }


    public function export()
    {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }

    public function import(Request $request)
    {
         $users =  Excel::toCollection(new UsersImport(), $request->file('import_file'));

         foreach ($users[0] as $user){
             User::where('id', $user[0])->update([
                'name' => $user[1],
                'email' => $user[2],
                'email_verified_at' => $user[3],
             ]);
         }

         return redirect()->route('home');
    }
}
