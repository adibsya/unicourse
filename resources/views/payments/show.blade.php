<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Secure Payment') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="paymentForm()">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Payment Status (if not pending) -->
            @if($payment->status !== 'pending')
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="text-center">
                        @if($payment->status === 'paid')
                            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-green-600 mb-2">Payment Successful!</h3>
                            <p class="text-gray-600">Your payment has been verified.</p>
                        @else
                            <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-red-600 mb-2">Payment {{ ucfirst($payment->status) }}</h3>
                        @endif
                        
                        <a href="{{ route('my-courses') }}" class="mt-6 inline-block bg-navy-800 text-white py-2 px-6 rounded-lg hover:bg-navy-900 transition">
                            Go to My Courses
                        </a>
                    </div>
                </div>
            @else
                <!-- Payment Gateway UI -->
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-navy-800 to-navy-900 p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-navy-200 text-sm">Pay for</p>
                                <h3 class="text-xl font-bold">{{ $enrollment->course->title }}</h3>
                            </div>
                            <div class="text-right">
                                <p class="text-navy-200 text-sm">Total Amount</p>
                                <p class="text-2xl font-bold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card Preview -->
                    <div class="p-6 bg-gradient-to-br from-gray-100 to-gray-200">
                        <div class="bg-gradient-to-br from-navy-800 via-navy-700 to-gold-500 rounded-xl p-6 text-white shadow-xl max-w-sm mx-auto transform transition-transform hover:scale-105">
                            <div class="flex justify-between items-start mb-8">
                                <div class="text-xs opacity-80">VIRTUAL CARD</div>
                                <svg class="w-10 h-10" viewBox="0 0 48 48" fill="currentColor">
                                    <circle cx="20" cy="24" r="12" fill="#EB001B" opacity="0.8"/>
                                    <circle cx="28" cy="24" r="12" fill="#F79E1B" opacity="0.8"/>
                                </svg>
                            </div>
                            <div class="font-mono text-lg tracking-widest mb-6" x-text="formattedCardNumber">•••• •••• •••• ••••</div>
                            <div class="flex justify-between">
                                <div>
                                    <div class="text-xs opacity-80 uppercase">Card Holder</div>
                                    <div class="text-sm font-medium" x-text="cardName || 'YOUR NAME'">YOUR NAME</div>
                                </div>
                                <div>
                                    <div class="text-xs opacity-80 uppercase">Expires</div>
                                    <div class="text-sm font-medium" x-text="expiry || 'MM/YY'">MM/YY</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <form action="{{ route('payments.process', $enrollment) }}" method="POST" class="p-6">
                        @csrf

                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Card Number
                            </label>
                            <input type="text" 
                                   name="card_number" 
                                   x-model="cardNumber"
                                   @input="formatCardNumber"
                                   placeholder="1234 5678 9012 3456"
                                   maxlength="19"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-navy-500 focus:ring-navy-500 text-lg font-mono"
                                   required>
                            @error('card_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Expiry Date
                                </label>
                                <input type="text" 
                                       name="expiry" 
                                       x-model="expiry"
                                       @input="formatExpiry"
                                       placeholder="MM/YY"
                                       maxlength="5"
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-navy-500 focus:ring-navy-500 font-mono"
                                       required>
                                @error('expiry')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    CVV
                                </label>
                                <input type="password" 
                                       name="cvv" 
                                       x-model="cvv"
                                       placeholder="•••"
                                       maxlength="3"
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-navy-500 focus:ring-navy-500 font-mono"
                                       required>
                                @error('cvv')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Cardholder Name
                            </label>
                            <input type="text" 
                                   name="card_name" 
                                   x-model="cardName"
                                   placeholder="JOHN DOE"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-navy-500 focus:ring-navy-500 uppercase"
                                   required>
                            @error('card_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Test Card Info -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-blue-800">Demo Mode - Use Test Card</p>
                                    <p class="text-sm text-blue-600 mt-1">
                                        Card: <span class="font-mono cursor-pointer hover:text-blue-800" @click="fillTestCard()">4242 4242 4242 4242</span><br>
                                        Expiry: <span class="font-mono">12/28</span> | CVV: <span class="font-mono">123</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('my-courses') }}" class="text-gray-600 hover:text-gray-800 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Cancel
                            </a>
                            <button type="submit" 
                                    :disabled="!isValid"
                                    :class="isValid ? 'bg-green-600 hover:bg-green-700' : 'bg-gray-400 cursor-not-allowed'"
                                    class="text-white py-3 px-8 rounded-lg font-semibold transition flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Pay Rp {{ number_format($payment->amount, 0, ',', '.') }}
                            </button>
                        </div>
                    </form>

                    <!-- Security Badge -->
                    <div class="border-t bg-gray-50 px-6 py-4">
                        <div class="flex items-center justify-center text-gray-500 text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            Secured by 256-bit SSL encryption (Demo Mode)
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function paymentForm() {
            return {
                cardNumber: '',
                expiry: '',
                cvv: '',
                cardName: '',
                
                get formattedCardNumber() {
                    if (!this.cardNumber) return '•••• •••• •••• ••••';
                    return this.cardNumber.replace(/\s/g, '').replace(/(.{4})/g, '$1 ').trim();
                },
                
                get isValid() {
                    const cardClean = this.cardNumber.replace(/\s/g, '');
                    return cardClean.length === 16 && 
                           this.expiry.length === 5 && 
                           this.cvv.length === 3 && 
                           this.cardName.length > 0;
                },
                
                formatCardNumber(e) {
                    let value = e.target.value.replace(/\D/g, '').substring(0, 16);
                    this.cardNumber = value.replace(/(.{4})/g, '$1 ').trim();
                },
                
                formatExpiry(e) {
                    let value = e.target.value.replace(/\D/g, '').substring(0, 4);
                    if (value.length >= 2) {
                        value = value.substring(0, 2) + '/' + value.substring(2);
                    }
                    this.expiry = value;
                },
                
                fillTestCard() {
                    this.cardNumber = '4242 4242 4242 4242';
                    this.expiry = '12/28';
                    this.cvv = '123';
                    this.cardName = '{{ strtoupper(auth()->user()->name) }}';
                }
            }
        }
    </script>
</x-app-layout>
