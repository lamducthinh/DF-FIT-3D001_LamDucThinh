<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function showForm()
    {
        return view('admin.feedback.feedback');
    }

    public function submitFeedback(Request $request)
    {
        // Validate input
        $request->validate([
            'feedback' => 'required|string|max:255',
        ]);

        // Send email to admin
        $feedback = $request->input('feedback');
        $adminEmail = 'thinh.lamldt@gmail.com';

        Mail::to($adminEmail)->send(new FeedbackMail($feedback));

        return redirect()->route('feedback-form')->with('success', 'Ý kiến của bạn đã được gửi đi. Cảm ơn!');
    }
}