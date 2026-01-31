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

            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc pl-4">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
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

                    <!-- Payment Method Tabs -->
                    <div class="border-b">
                        <div class="flex">
                            <button @click="activeTab = 'card'" 
                                    :class="activeTab === 'card' ? 'border-b-2 border-navy-600 text-navy-600' : 'text-gray-500'"
                                    class="flex-1 py-4 text-sm font-medium hover:text-navy-600 transition">
                                <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                Card
                            </button>
                            <button @click="activeTab = 'ewallet'" 
                                    :class="activeTab === 'ewallet' ? 'border-b-2 border-navy-600 text-navy-600' : 'text-gray-500'"
                                    class="flex-1 py-4 text-sm font-medium hover:text-navy-600 transition">
                                <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                E-Wallet
                            </button>
                            <button @click="activeTab = 'va'" 
                                    :class="activeTab === 'va' ? 'border-b-2 border-navy-600 text-navy-600' : 'text-gray-500'"
                                    class="flex-1 py-4 text-sm font-medium hover:text-navy-600 transition">
                                <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Virtual Account
                            </button>
                            <button @click="activeTab = 'qris'" 
                                    :class="activeTab === 'qris' ? 'border-b-2 border-navy-600 text-navy-600' : 'text-gray-500'"
                                    class="flex-1 py-4 text-sm font-medium hover:text-navy-600 transition">
                                <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                </svg>
                                QRIS
                            </button>
                        </div>
                    </div>

                    <!-- Card Payment -->
                    <div x-show="activeTab === 'card'" class="p-6">
                        <!-- Card Preview -->
                        <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl p-4 mb-6">
                            <div class="bg-gradient-to-br from-navy-800 via-navy-700 to-gold-500 rounded-xl p-5 text-white shadow-xl max-w-xs mx-auto transform transition-transform hover:scale-105">
                                <div class="flex justify-between items-start mb-6">
                                    <div class="text-xs opacity-80">VIRTUAL CARD</div>
                                    <svg class="w-8 h-8" viewBox="0 0 48 48" fill="currentColor">
                                        <circle cx="20" cy="24" r="12" fill="#EB001B" opacity="0.8"/>
                                        <circle cx="28" cy="24" r="12" fill="#F79E1B" opacity="0.8"/>
                                    </svg>
                                </div>
                                <div class="font-mono text-sm tracking-widest mb-4" x-text="formattedCardNumber">•••• •••• •••• ••••</div>
                                <div class="flex justify-between text-xs">
                                    <div>
                                        <div class="opacity-80 uppercase">Holder</div>
                                        <div class="font-medium" x-text="cardName || 'YOUR NAME'">YOUR NAME</div>
                                    </div>
                                    <div>
                                        <div class="opacity-80 uppercase">Expires</div>
                                        <div class="font-medium" x-text="expiry || 'MM/YY'">MM/YY</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('payments.process', $enrollment) }}" method="POST">
                            @csrf
                            <input type="hidden" name="payment_method" value="card">

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Card Number</label>
                                <input type="text" name="card_number" x-model="cardNumber" @input="formatCardNumber"
                                       placeholder="1234 5678 9012 3456" maxlength="19"
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-navy-500 focus:ring-navy-500 font-mono" required>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Expiry</label>
                                    <input type="text" name="expiry" x-model="expiry" @input="formatExpiry"
                                           placeholder="MM/YY" maxlength="5"
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-navy-500 focus:ring-navy-500 font-mono" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">CVV</label>
                                    <input type="password" name="cvv" x-model="cvv" placeholder="•••" maxlength="3"
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-navy-500 focus:ring-navy-500 font-mono" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Cardholder Name</label>
                                <input type="text" name="card_name" x-model="cardName" placeholder="JOHN DOE"
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-navy-500 focus:ring-navy-500 uppercase" required>
                            </div>

                            <!-- Test Card -->
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
                                <p class="text-sm text-blue-800">
                                    <span class="font-medium">Demo:</span> 
                                    <button type="button" @click="fillTestCard()" class="underline hover:text-blue-600">
                                        Click here to use test card
                                    </button>
                                </p>
                            </div>

                            <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                                Pay Rp {{ number_format($payment->amount, 0, ',', '.') }}
                            </button>
                        </form>
                    </div>

                    <!-- E-Wallet Payment -->
                    <div x-show="activeTab === 'ewallet'" class="p-6">
                        <p class="text-gray-600 mb-4">Select your e-wallet:</p>
                        
                        <div class="grid grid-cols-2 gap-3">
                            @foreach(['gopay' => 'GoPay', 'shopeepay' => 'ShopeePay', 'dana' => 'DANA', 'ovo' => 'OVO'] as $key => $name)
                            <form action="{{ route('payments.process', $enrollment) }}" method="POST">
                                @csrf
                                <input type="hidden" name="payment_method" value="{{ $key }}">
                                <button type="submit" class="w-full border-2 border-gray-200 rounded-xl p-4 hover:border-navy-500 hover:bg-navy-50 transition flex items-center justify-center gap-2">
                                    <span class="font-semibold text-gray-700">{{ $name }}</span>
                                </button>
                            </form>
                            @endforeach
                        </div>

                        <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                            <p class="text-sm text-yellow-800">
                                <span class="font-medium">Demo Mode:</span> Payment will be auto-approved instantly.
                            </p>
                        </div>
                    </div>

                    <!-- Virtual Account Payment -->
                    <div x-show="activeTab === 'va'" class="p-6">
                        <p class="text-gray-600 mb-4">Select your bank:</p>
                        
                        <div class="space-y-3">
                            @foreach(['bca_va' => 'BCA', 'bni_va' => 'BNI', 'bri_va' => 'BRI', 'mandiri_va' => 'Mandiri'] as $key => $name)
                            <form action="{{ route('payments.process', $enrollment) }}" method="POST">
                                @csrf
                                <input type="hidden" name="payment_method" value="{{ $key }}">
                                <button type="submit" class="w-full border-2 border-gray-200 rounded-xl p-4 hover:border-navy-500 hover:bg-navy-50 transition flex items-center justify-between">
                                    <span class="font-semibold text-gray-700">{{ $name }} Virtual Account</span>
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </form>
                            @endforeach
                        </div>

                        <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                            <p class="text-sm text-yellow-800">
                                <span class="font-medium">Demo Mode:</span> Payment will be auto-approved instantly.
                            </p>
                        </div>
                    </div>

                    <!-- QRIS Payment -->
                    <div x-show="activeTab === 'qris'" class="p-6 text-center">
                        <!-- Dummy QR Code -->
                        <div class="bg-white border-4 border-gray-800 rounded-xl p-4 inline-block mx-auto mb-4">
                            <div class="w-48 h-48 bg-gray-100 flex items-center justify-center">
                                <svg class="w-40 h-40 text-gray-800" viewBox="0 0 100 100">
                                    <!-- Simplified QR pattern -->
                                    <rect x="10" y="10" width="25" height="25" fill="currentColor"/>
                                    <rect x="65" y="10" width="25" height="25" fill="currentColor"/>
                                    <rect x="10" y="65" width="25" height="25" fill="currentColor"/>
                                    <rect x="15" y="15" width="15" height="15" fill="white"/>
                                    <rect x="70" y="15" width="15" height="15" fill="white"/>
                                    <rect x="15" y="70" width="15" height="15" fill="white"/>
                                    <rect x="18" y="18" width="9" height="9" fill="currentColor"/>
                                    <rect x="73" y="18" width="9" height="9" fill="currentColor"/>
                                    <rect x="18" y="73" width="9" height="9" fill="currentColor"/>
                                    <rect x="40" y="10" width="5" height="5" fill="currentColor"/>
                                    <rect x="50" y="10" width="5" height="5" fill="currentColor"/>
                                    <rect x="40" y="20" width="5" height="5" fill="currentColor"/>
                                    <rect x="45" y="15" width="5" height="5" fill="currentColor"/>
                                    <rect x="40" y="40" width="20" height="20" fill="currentColor"/>
                                    <rect x="45" y="45" width="10" height="10" fill="white"/>
                                </svg>
                            </div>
                        </div>
                        
                        <p class="text-gray-600 mb-4">Scan with any QRIS-supported app</p>
                        
                        <form action="{{ route('payments.process', $enrollment) }}" method="POST">
                            @csrf
                            <input type="hidden" name="payment_method" value="qris">
                            <button type="submit" class="bg-green-600 text-white py-3 px-8 rounded-lg font-semibold hover:bg-green-700 transition">
                                I've Completed Payment
                            </button>
                        </form>

                        <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                            <p class="text-sm text-yellow-800">
                                <span class="font-medium">Demo Mode:</span> Just click the button to simulate payment.
                            </p>
                        </div>
                    </div>

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

                <!-- Back Link -->
                <div class="mt-4 text-center">
                    <a href="{{ route('my-courses') }}" class="text-gray-600 hover:text-gray-800">
                        ← Back to My Courses
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
        function paymentForm() {
            return {
                activeTab: 'card',
                cardNumber: '',
                expiry: '',
                cvv: '',
                cardName: '',
                
                get formattedCardNumber() {
                    if (!this.cardNumber) return '•••• •••• •••• ••••';
                    return this.cardNumber;
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
