<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function markAsRead(Request $request){
        $notificationId = $request->input('id');

        $notification = DB::table('notifications')->where('id', $notificationId)->first();

        if ($notification) {
            DB::table('notifications')
                ->where('id', $notificationId)
                ->update(['read_at' => now()]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}
