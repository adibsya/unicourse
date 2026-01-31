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
     * Process dummy payment gateway.
     */
    public function process(Request $request, Enrollment $enrollment)
    {
        // Ensure user owns this enrollment
        if ($enrollment->user_id !== auth()->id()) {
            abort(403);
        }

        $paymentMethod = $request->input('payment_method');
        $payment = $enrollment->payment;

        // Only allow processing pending payments
        if ($payment->status !== 'pending') {
            return back()->with('error', 'Payment has already been processed.');
        }

        // Validate based on payment method
        if ($paymentMethod === 'card') {
            $request->validate([
                'card_number' => 'required|string',
                'expiry' => 'required|string|size:5',
                'cvv' => 'required|string|size:3',
                'card_name' => 'required|string|max:255',
            ]);
            
            // Validate card number (strip spaces)
            $cardNumber = preg_replace('/\s+/', '', $request->card_number);
            if (strlen($cardNumber) !== 16) {
                return back()->withErrors(['card_number' => 'Card number must be 16 digits.']);
            }
            
            $methodName = 'Credit/Debit Card';
        } else {
            // E-wallet or VA
            $methodName = match($paymentMethod) {
                'gopay' => 'GoPay',
                'shopeepay' => 'ShopeePay',
                'dana' => 'DANA',
                'ovo' => 'OVO',
                'bca_va' => 'BCA Virtual Account',
                'bni_va' => 'BNI Virtual Account',
                'bri_va' => 'BRI Virtual Account',
                'mandiri_va' => 'Mandiri Virtual Account',
                'qris' => 'QRIS',
                default => ucfirst($paymentMethod),
            };
        }

        // Simulate payment processing (dummy - always success)
        // Generate dummy transaction ID
        $transactionId = 'TXN' . strtoupper(uniqid());
        
        // Auto-approve the payment
        $payment->update([
            'payment_method' => $methodName . ' (Demo)',
            'reference_number' => $transactionId,
            'notes' => 'Auto-approved via dummy payment gateway',
            'status' => 'paid',
            'verified_at' => now(),
        ]);

        // Update enrollment status to active
        $enrollment->update([
            'status' => 'active',
        ]);

        return redirect()->route('payments.success', $enrollment);
    }

    /**
     * Show payment success page.
     */
    public function success(Enrollment $enrollment)
    {
        // Ensure user owns this enrollment
        if ($enrollment->user_id !== auth()->id()) {
            abort(403);
        }

        return view('payments.success', compact('enrollment'));
    }

    /**
     * Legacy store method (kept for backward compatibility).
     */
    public function store(Request $request, Enrollment $enrollment)
    {
        return $this->process($request, $enrollment);
    }
}
