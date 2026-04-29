@extends('Frontend.frontend-layout.app')

@section('title', 'Excellence in Modern Education')

@section('content')
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 mb-12 mt-[50px]">
                <!-- Map Section -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden h-[500px] lg:h-[700px]">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3619.8!2d67.0!3d24.86!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjTCsDUxJzM2LjAiTiA2N8KwMDAnMDAuMCJF!5e0!3m2!1sen!2s!4v1234567890"
                        width="100%" height="100%" style="border: 0;" allowfullscreen="" loading="lazy"
                        title="Location Map">
                    </iframe>
                </div>
                <!-- Contact Form -->
                <div class="bg-white rounded-lg shadow-md p-6 sm:p-8 lg:p-10 h-[500px] lg:h-[700px] flex flex-col">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">Contact Us</h2>

                    <div class="space-y-4 overflow-y-auto flex-1 pr-2">
                        <!-- Full Name -->
                        <div>
                            <label for="fullName" class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name
                            </label>
                            <input type="text" id="fullName"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-transparent transition-all outline-none">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email
                            </label>
                            <input type="email" id="email"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-transparent transition-all outline-none">
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Phone
                            </label>
                            <input type="tel" id="phone"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-transparent transition-all outline-none">
                        </div>

                        <!-- Country -->
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-2">
                                Country
                            </label>
                            <select id="country"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-transparent transition-all outline-none bg-white">
                                <option value="">Select Country</option>
                                <option value="usa">United States</option>
                                <option value="uk">United Kingdom</option>
                                <option value="canada">Canada</option>
                                <option value="australia">Australia</option>
                                <option value="pakistan">Pakistan</option>
                                <option value="india">India</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                Message
                            </label>
                            <textarea id="message" rows="3"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-transparent transition-all outline-none resize-none"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button onclick="submitForm()"
                            class="w-full bg-black text-white py-3.5 px-6 rounded-lg font-semibold text-base hover:bg-gray-800 transition-all duration-200 shadow-md hover:shadow-lg cursor-pointer">
                            Submit
                        </button>
                    </div>
                </div>
            </div>

            <!-- Information Cards -->
            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Mail Address -->
                <div class="bg-gray-300 rounded-lg shadow-md p-6 sm:p-8 flex items-start space-x-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Mail address</h3>
                        <a href="mailto:sales@luxora.global" class="hover:text-blue-600 transition-colors break-words">
                            sales@luxora.global
                        </a>
                    </div>
                </div>

                <!-- We are Covering -->
                <div class="bg-gray-300  rounded-lg shadow-md p-6 sm:p-8 flex items-start space-x-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">We are Covering</h3>
                        <p class="text-sm leading-relaxed">
                            Europe | Asia-Pacific Region | Middle East & Africa | Americas
                        </p>
                    </div>
                </div>

                <!-- Connect Us -->
                <div class="bg-gray-300  rounded-lg shadow-md p-6 sm:p-8 flex items-start space-x-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Connect Us</h3>
                        <div class="space-y-1">
                            <a href="mailto:partnership@luxora.global"
                                class="block hover:text-blue-600 transition-colors text-sm break-words">
                                partnership@luxora.global
                            </a>
                            <a href="mailto:marketing@luxora.global"
                                class="block  hover:text-blue-600 transition-colors text-sm break-words">
                                marketing@luxora.global
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function submitForm() {
            var fullName = document.getElementById('fullName').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;
            var country = document.getElementById('country').value;
            var topic = document.getElementById('topic').value;
            var message = document.getElementById('message').value;

            if (!fullName || !email || !phone || !country || !topic || !message) {
                alert('Please fill in all fields');
                return;
            }

            console.log('Form submitted with:', {
                fullName: fullName,
                email: email,
                phone: phone,
                country: country,
                topic: topic,
                message: message
            });

            alert('Thank you for contacting us! We will get back to you soon.');

            // Clear form
            document.getElementById('fullName').value = '';
            document.getElementById('email').value = '';
            document.getElementById('phone').value = '';
            document.getElementById('country').value = '';
            document.getElementById('topic').value = '';
            document.getElementById('message').value = '';
        }
    </script>

@endsection