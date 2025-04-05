<?php

namespace App\Http\Controllers;

use App\Notifications\SendInterview;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use App\Models\Interview;
use App\Models\Applier;
use Illuminate\Support\Facades\DB;

class InterviewController extends Controller
{
    public function schedule(Request $request) {
        $request->validate([
            'applier_id' => 'required|exists:appliers,id',
            'job_id' => 'required|exists:jobs,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'notes' => 'nullable|string',
        ]);

        $existingInterview = Interview::where('applier_id', $request->applier_id)
                                      ->where('job_id', $request->job_id)
                                      ->first();

        if ($existingInterview) {
            return back()->with('error', 'لقد تم إرسال دعوة لهذا المتقدم لهذه الوظيفة مسبقًا.');
        }

        Interview::create([
            'applier_id' => $request->applier_id,
            'job_id' => $request->job_id,
            'date' => $request->date,
            'time' => $request->time,
            'notes' => $request->notes,
        ]);

        $applier = \App\Models\Applier::find($request->applier_id);
        $applier->notify(new SendInterview(
            $request->applier_id,
            $request->job_id,
            $request->date,
            $request->time,
            $request->notes
        ));

        return back()->with('success', 'تم إرسال الدعوة بنجاح!');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'notes' => 'nullable|string',
        ]);

        $interview = Interview::findOrFail($id);

        $interview->update([
            'date' => $request->date,
            'time' => $request->time,
            'notes' => $request->notes,
        ]);

        // تحديث بيانات الإشعار الموجود بدلاً من إرسال واحد جديد
        $notification = DB::table('notifications')
            ->where('notifiable_id', $interview->applier_id)
            ->where('type', SendInterview::class)
            ->orderBy('created_at', 'desc') // لو فيه أكثر من إشعار، نأخذ الأحدث
            ->first();

        if ($notification) {
            $newData = [
                'applier_id' => $interview->applier_id,
                'job_id' => $interview->job_id,
                'date' => $request->date,
                'time' => $request->time,
                'notes' => $request->notes,
            ];

            DB::table('notifications')->where('id', $notification->id)->update([
                'data' => json_encode($newData),
                'read_at' => null,
                'updated_at' => now(),
            ]);
        }

        return back()->with('success', 'تم تحديث موعد المقابلة بنجاح!');
    }
}
