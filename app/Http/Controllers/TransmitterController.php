<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPasswordMail;
use App\Models\Budget;
Use Illuminate\Support\Str;

class TransmitterController extends Controller
{
    public function loadTransmitters () {
        $users = User::where('role','user')->get();
        $notAllocatedBudget = Budget::first()->amount - User::where('role', 'user')->sum('budget');
        return view('transmitter')
                ->with('users',$users)
                ->with('notAllocatedBudget',$notAllocatedBudget);
    }

    public function createNewTransmitter (Request $request) {
        try {
            $newTransmitter = new User();
            $newTransmitter->name = $request['name'];
            $newTransmitter->email = $request['email'];
            $newTransmitter->budget = $request['budget'];
            $password = Str::random(10);
            $newTransmitter->password = $password;
            $newTransmitter->profession = $request['profession'];
            $newTransmitter->role = 'user';

            try {
                Mail::to($request->email)->send(new SendPasswordMail($password, $request->email));
            } catch (\Exception $e) {
                return redirect('/transmitter')->with('error', 'Erreur lors de l\'envoi de l\'email: ');
            }

            $newTransmitter->save();

            // Budget Line Proposal

            return redirect('/transmitter')->with('success', 'Émetteur créé avec succès');
        } catch (\Exception $e) {
            return redirect('/transmitter')->with('error', 'Erreur lors de la création de l\'émetteur: ');
        }
    }

    public function deleteTransmitter(Request $request) {
        $id = $request->input('id');
        $transmitter = User::find($id);
        if ($transmitter) {
            $transmitter->delete();
            return response()->json(['message' => 'Émetteur supprimé avec succès']);
        }

        return response()->json(['error' => 'Transmitter not found'], 404);
    }

    public function updateTransmitter(Request $request) {
        $id = $request->input('id');
        $transmitter = User::find($id);

        if ($transmitter) {
            $transmitter->name = $request->input('name');
            $transmitter->email = $request->input('email');
            $transmitter->budget = $request->input('budget');
            $transmitter->profession = $request->input('profession');
            $transmitter->save();

            return redirect('/transmitter')->with('success', 'Émetteur mis à jour avec succès');
        }

        return redirect('/transmitter')->with('error', 'Émetteur non trouvé');
    }

}
