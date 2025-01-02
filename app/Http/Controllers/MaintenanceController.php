<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    private $maintenanceCredentials = [
        'username' => 'Admin',
        'password' => 'OpenSkillRoom2025'
    ];

    public function showLoginForm()
    {
        return view('maintenance.login');
    }

    public function login(Request $request)
    {
        if ($request->username === $this->maintenanceCredentials['username'] && 
            $request->password === $this->maintenanceCredentials['password']) {
            
            $request->session()->put('maintenance_auth', true);
            return redirect('/');
        }
        
        return back()->withErrors(['message' => 'Identifiants incorrects']);
    }
}
