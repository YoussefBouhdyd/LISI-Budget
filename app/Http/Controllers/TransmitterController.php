<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TransmitterController extends Controller
{
    public function loadTransmitters () {
        $users = User::where('role','user')->get();
        return view('transmitter')
                ->with('users',$users);
    }

    public function createNewTransmitter (Request $request) {
        $newTransmitter = new User();
        $newTransmitter->name = $request['name'];
        $newTransmitter->email = $request['email'];
        $newTransmitter->budget = $request['budget'];
        $newTransmitter->password = "Yoissef";
        $newTransmitter->profession = $request['profession'];
        $newTransmitter->save();

        return redirect('/transmitter')->with('success', 'Émetteur créé avec succès');
    }

    public function deleteTransmitter(Request $request) {
        $id = $request->input('id');
        $transmitter = User::find($id);

        if ($transmitter) {
            $transmitter->delete();
            return response()->json(['message' => 'Transmitter deleted successfully']);
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
