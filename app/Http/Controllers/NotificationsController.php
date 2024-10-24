<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

use App\Models\Notification;
use App\Models\User;
use App\Models\Player;

use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = User::find(auth()->id());

        // notifications sent to the user and status pending
        $notifications = Notification::where('sender_id', auth()->id())->where('status', 'pending')->get();

        foreach ($notifications as $notification) {
            $notification->player_sent = Player::where('id', $notification->player_sent_id)->first();
            $notification->player_received = Player::where('id', $notification->player_received_id)->first();
            $notification->receiver = User::where('id', $notification->receiver_id)->first();
        }

        

        return Inertia::render('Notifications', [
            'notifications' => $notifications,
        ]);
    }

    public function create(Request $request)
    {
        
        $notification = Notification::create([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'player_sent_id' => $request->player_sent_id,
            'player_received_id' => $request->player_received_id,
        ]);
    }

    public function handleExchange(Request $request)
{
    
    
    // Validar los datos recibidos
    $validated = $request->validate([
        'notification_id' => 'required|exists:notifications,id',
        'player_sent_id' => 'required|exists:players,id',
        'player_received_id' => 'required|exists:players,id',
        'sender_id' => 'required|exists:users,id',
        'receiver_id' => 'required|exists:users,id',
        'action' => 'required|in:accept,reject',
    ]);

    // Obtener la notificación
    $notification = Notification::findOrFail($validated['notification_id']);

    // Procesar la acción
    if ($validated['action'] === 'accept') {
        // Usar una transacción para asegurar que todas las operaciones se completen o ninguna
        DB::transaction(function () use ($validated, $notification) {
            // Obtener los jugadores
            $playerSent = Player::findOrFail($validated['player_sent_id']);
            $playerReceived = Player::findOrFail($validated['player_received_id']);

            $tempUserId = $playerSent->user_id; // 3
            $playerSent->user_id = $playerReceived->user_id; // 1
            $playerReceived->user_id = $tempUserId; // 3

            $tempPosition = $playerSent->role; // titular
            $playerSent->role = $playerReceived->role; // titular
            $playerReceived->role = $tempPosition; // titular

            // Guardar los cambios
            $playerSent->save();
            $playerReceived->save();

            // Actualizar el estado de la notificación
            $notification->status = 'accepted';
            $notification->save();

            // Aquí podrías añadir lógica adicional, como notificar a los usuarios involucrados
        });

        
    } else {
        // Si la acción es rechazar, simplemente actualizamos el estado de la notificación
        $notification->status = 'rejected';
        $notification->save();

        
    }

    // Redirigir a la página de notificaciones
    return redirect()->route('notifications');
}

}
