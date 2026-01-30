<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Show payment form for an enrollment.
     */
    public function show(Enrollment $enrollment)
    {
        // Ensure user owns this enrollment
        if ($enrollment->user_id !== auth()->id()) {
            abort(403);
        }

        $payment = $enrollment->payment;

        return view('payments.show', compact('enrollment', 'payment'));
    }

    /**
     * Submit payment details.
     */
    public function store(Request $request, Enrollment $enrollment)
    {
        // Ensure user owns this enrollment
        if ($enrollment->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'payment_method' => 'required|string|max:255',
            'reference_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $payment = $enrollment->payment;

        // Only allow updating pending payments
        if ($payment->status !== 'pending') {
            return back()->with('error', 'Payment has already been processed.');
        }

        $payment->update([
            'payment_method' => $request->payment_method,
            'reference_number' => $request->reference_number,
            'notes' => $request->notes,
        ]);

        return redirect()->route('my-courses')
            ->with('success', 'Payment details submitted. Please wait for admin verification.');
    }
}
