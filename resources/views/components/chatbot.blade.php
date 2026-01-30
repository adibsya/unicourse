<!-- Chatbot Toggle Button -->
<div id="chatbot-toggle" 
     class="fixed bottom-6 right-6 bg-navy-900 text-white p-4 rounded-full shadow-lg cursor-pointer hover:bg-navy-800 transition z-50 hover:scale-105">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
    </svg>
</div>

<!-- Chatbot Window -->
<div id="chatbot-window" class="fixed bottom-24 right-6 w-80 bg-white rounded-2xl shadow-2xl hidden z-50 overflow-hidden border border-gray-100">
    <!-- Header -->
    <div class="bg-gradient-to-r from-navy-900 to-navy-800 text-white px-5 py-4 flex items-center justify-between">
        <div class="flex items-center">
            <div class="w-8 h-8 bg-gold-500 rounded-full flex items-center justify-center mr-3">
                <svg class="w-4 h-4 text-navy-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
            </div>
            <div>
                <div class="font-semibold">Unicourse Support</div>
                <div class="text-xs text-navy-200">Online</div>
            </div>
        </div>
        <button id="chatbot-close" class="text-white/70 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Messages -->
    <div id="chatbot-messages" class="h-72 overflow-y-auto p-4 space-y-3 bg-gray-50">
        <div class="flex items-start">
            <div class="w-8 h-8 bg-navy-900 rounded-full flex items-center justify-center mr-2 flex-shrink-0">
                <span class="text-white text-xs font-bold">U</span>
            </div>
            <div class="bg-white rounded-2xl rounded-tl-none px-4 py-3 max-w-[85%] shadow-sm border border-gray-100">
                <p class="text-sm text-gray-800">Hello! ðŸ‘‹ Welcome to Unicourse. How can I help you today?</p>
                <p class="text-xs text-gray-400 mt-2">Try: registration, payment, course, help</p>
            </div>
        </div>
    </div>

    <!-- Input -->
    <div class="border-t border-gray-100 bg-white px-4 py-3">
        <form id="chatbot-form" class="flex items-center gap-2">
            <input type="text" id="chatbot-input" 
                   placeholder="Type your question..." 
                   class="flex-1 border border-gray-200 rounded-full px-4 py-2.5 text-sm focus:outline-none focus:border-navy-500 focus:ring-2 focus:ring-navy-100">
            <button type="submit" class="bg-navy-900 text-white p-2.5 rounded-full hover:bg-navy-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('chatbot-toggle');
    const window_ = document.getElementById('chatbot-window');
    const closeBtn = document.getElementById('chatbot-close');
    const form = document.getElementById('chatbot-form');
    const input = document.getElementById('chatbot-input');
    const messages = document.getElementById('chatbot-messages');

    // Keyword responses
    const responses = {
        'hello': 'Hello! Welcome to Unicourse. How can I assist you today?',
        'hi': 'Hi there! ðŸ‘‹ How can I help you?',
        'registration': 'To register for a course:\n1. Click "Join for Free"\n2. Fill in your details\n3. Browse courses\n4. Click "Enroll Now"\n5. Submit payment details',
        'register': 'To create an account, click the "Join for Free" button and fill in your details.',
        'payment': 'Payment process:\n1. Enroll in a course\n2. Go to "My Learning"\n3. Click "Submit Payment"\n4. Enter your payment method and reference number\n5. Wait for admin verification (1x24 hours)',
        'course': 'Browse our courses at "Explore". Each course shows:\nâ€¢ Price\nâ€¢ Start date\nâ€¢ Available slots\nClick "View Details" for more info.',
        'courses': 'Browse our courses at "Explore". You can see all available courses with their prices and schedules.',
        'enroll': 'To enroll:\n1. Browse courses\n2. Click on a course\n3. Click "Enroll Now"\n4. Complete payment\nNote: You must be logged in to enroll.',
        'enrollment': 'After enrollment, your status will be "Pending" until payment is verified. Once approved, your enrollment becomes "Active".',
        'price': 'Course prices vary. Check each course page for specific pricing. Payment is done via bank transfer.',
        'quota': 'Each course has limited slots. If a course shows "0 slots available", it means the course is full.',
        'help': 'I can help you with:\nâ€¢ Registration - How to create account\nâ€¢ Payment - Payment process\nâ€¢ Course - Course information\nâ€¢ Enrollment - How to enroll\nJust type a keyword!',
        'contact': 'For further assistance, please contact our support team or use this chatbot.',
        'thank': 'You\'re welcome! Let me know if you need anything else. ðŸ˜Š',
        'thanks': 'You\'re welcome! Happy to help! ðŸ˜Š',
        'default': 'I\'m sorry, I didn\'t understand that. Try typing:\nâ€¢ registration\nâ€¢ payment\nâ€¢ course\nâ€¢ enrollment\nâ€¢ help'
    };

    // Toggle chatbot
    toggle.addEventListener('click', () => {
        window_.classList.toggle('hidden');
    });

    closeBtn.addEventListener('click', () => {
        window_.classList.add('hidden');
    });

    // Handle message
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const text = input.value.trim().toLowerCase();
        if (!text) return;

        // Add user message
        addMessage(input.value, 'user');
        input.value = '';

        // Get response
        setTimeout(() => {
            let response = responses['default'];
            for (const keyword in responses) {
                if (text.includes(keyword)) {
                    response = responses[keyword];
                    break;
                }
            }
            addMessage(response, 'bot');
        }, 500);
    });

    function addMessage(text, type) {
        const div = document.createElement('div');
        div.className = 'flex items-start ' + (type === 'user' ? 'justify-end' : '');
        
        if (type === 'bot') {
            const avatar = document.createElement('div');
            avatar.className = 'w-8 h-8 bg-navy-900 rounded-full flex items-center justify-center mr-2 flex-shrink-0';
            avatar.innerHTML = '<span class="text-white text-xs font-bold">U</span>';
            div.appendChild(avatar);
        }
        
        const bubble = document.createElement('div');
        bubble.className = type === 'user' 
            ? 'bg-navy-900 text-white rounded-2xl rounded-tr-none px-4 py-3 max-w-[85%]'
            : 'bg-white rounded-2xl rounded-tl-none px-4 py-3 max-w-[85%] shadow-sm border border-gray-100';
        
        const p = document.createElement('p');
        p.className = 'text-sm whitespace-pre-line';
        p.textContent = text;
        
        bubble.appendChild(p);
        div.appendChild(bubble);
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
    }
});
</script>
