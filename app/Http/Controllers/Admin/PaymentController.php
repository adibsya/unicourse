<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments.
     */
    public function index(Request $request)
    {
        $query = Payment::with(['enrollment.user', 'enrollment.course']);

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $payments = $query->latest()->paginate(20);

        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Display the specified payment.
     */
    public function show(Payment $payment)
    {
        $payment->load(['enrollment.user', 'enrollment.course']);

        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Approve the payment (mark as paid).
     */
    public function approve(Payment $payment)
    {
        if ($payment->status !== 'pending') {
            return back()->with('error', 'Payment has already been processed.');
        }

        $payment->markAsPaid();

        return back()->with('success', 'Payment approved. Enrollment is now active.');
    }

    /**
     * Reject the payment.
     */
    public function reject(Payment $payment)
    {
        if ($payment->status !== 'pending') {
            return back()->with('error', 'Payment has already been processed.');
        }

        $payment->reject();

        return back()->with('success', 'Payment has been rejected.');
    }
}
