<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ConnectionController extends Controller
{
    public function connect(User $user)
    {
        $user->connections()->sync(auth()->user()->id);
        return response()->json([
            'success' => true,
        ]);
    }
    // Accept connection request by connection ID
    public function accept(Request $request, $connectionId)
    {
        $connections = Connection::find($connectionId);

        if ($connections) {
            $connections->status = 'accepter';
            $connections->save();

            return response()->json(['message' => 'Connection accepted']);
        }

        return response()->json(['message' => 'Connection not found'], 404);
    }

    // Reject connection request by connection ID (delete it)

       public function reject(Request $request, $connectionId)
       {
           $connection = Connection::find($connectionId);

           if ($connection) {
               $connection->delete();

               return response()->json(['message' => 'Connection rejected']);
           }

           return response()->json(['message' => 'Connection not found'], 404);
       }
    // Delete a connection by connection ID
    //    public function delete(Request $request, $connectionId)
    //    {
    //        $connection = Connection::find($connectionId);

    //        if ($connection) {
    //            $connection->delete();

    //            return response()->json(['message' => 'Connection deleted']);
    //        }

    //        return response()->json(['message' => 'Connection not found'], 404);
    //    }
    public function index()
    {
        $connections = auth()->user()->connections;
        // dd($connections);
        return view('listeConnections', compact('connections'));
    }
    // public function mesDemandes(){
    //     return view('accepter');
    // }
    public function showDemande()
    {
        $demandes = Connection::where('connected_user_id', auth()->id())->where('status', 'en attente')->get();

        return view('accepter', compact('demandes'));
    }
}
