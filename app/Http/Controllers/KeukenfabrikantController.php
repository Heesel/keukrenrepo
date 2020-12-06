<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Keukenfabrikant;
use App\User;
use Auth;
use DB;

class KeukenfabrikantController extends Controller
{
    public function index()
    {
        return view('auth.keukenfabrikant');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'bedrijfsnaam' => 'required',
            'bedrijfswebsite' => 'required',
            'plaats' => 'required',
            'straatnaam' => 'required',
            'huisnummer' => 'required',
            'postcode' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);

        $keukenfabrikant = new Keukenfabrikant;
        $keukenfabrikant->bedrijfsnaam = $request->input('bedrijfsnaam');
        $keukenfabrikant->bedrijfswebsite = $request->input('bedrijfswebsite');
        $keukenfabrikant->plaats = $request->input('plaats');
        $keukenfabrikant->straatnaam = $request->input('straatnaam');
        $keukenfabrikant->huisnummer = $request->input('huisnummer');
        $keukenfabrikant->postcode = $request->input('postcode');
        $keukenfabrikant->email = $request->input('email');
        $keukenfabrikant->password = $request->input('password');
        $keukenfabrikant->approved = 0;
        $keukenfabrikant->save();
        return redirect('keukenfabrikant')->with('succes', 'Aanvraag succesvol verzonden');
    }


    public function adminview()
    {

        $approveUser = DB::select('select * from keukenfabrikant');
        $results = DB::table('keukenfabrikant')->where('approved', '0' )->get();
        return view('panel.aanvragen', ['approveUser' => $results]);
    }

    public function accept($id)
    {
        $bedrijf = Keukenfabrikant::find($id);

        if(auth()->user()->role == 'admin') {
            DB::table('keukenfabrikant')->where('id', $id)->update(['approved' => '1']);
            DB::table('users')->where('email', $bedrijf->email)->update(['keukenzaak' => $bedrijf->id]);
            return redirect('/admin/aanvragen')->with('succes', 'Goedgekeurd');

        } 
        else if(auth()->user()->id !== $user->id) {
            return redirect('/')->with('error', 'Unauthorized page');
        } 


    
    }

    public function destroy($id)
    {
        $bedrijf = Keukenfabrikant::find($id);

        if(auth()->user()->role == 'admin') {} 
        else if(auth()->user()->id !== $user->id) {
            return redirect('/')->with('error', 'Unauthorized page');
        } 

        $bedrijf->delete();
        return redirect('/admin/aanvragen')->with('success', 'Afgekeurd');

    }
}


