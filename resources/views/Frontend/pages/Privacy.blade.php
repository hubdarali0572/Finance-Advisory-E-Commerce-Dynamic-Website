@extends('Frontend.frontend-layout.app')

@section('title', 'Excellence in Modern Education')

@section('content')

    <section class="py-6">
        <div class="w-full mx-auto 
                            h-[180px] sm:h-[220px] md:h-[230px] lg:h-[350px] 
                            relative bg-cover bg-center"
            style="background-image: url('{{ asset('assets/images/others/privacy.jfif') }}')">
            <h3 class="absolute left-6 sm:left-10 top-1/2 -translate-y-1/2 
                               text-3xl sm:text-4xl md:text-5xl lg:text-6xl
                               text-white font-bold 
                               px-4 sm:px-10 md:px-20 py-2">
                Privacy Policy
            </h3>
        </div>
    </section>


    <section class="py-6">
        <div class="max-w-7xl mx-auto px-4">

            <!-- Main Title -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold mb-2">Privacy Policy</h1>
                <p class="text-lg text-gray-700">
                    At Finance Advisory, we value your privacy and are committed to protecting your personal information.
                    This Privacy Policy outlines how we collect, use, and safeguard your data when you visit our website <a
                        href="#" class="text-blue-400 hover:text-blue-600">https://financeadvisory.com/.</a>
                </p>
            </div>

            <!-- Grid with Border -->
            <div class="grid grid-cols-1 md:grid-cols-2 border border-gray-300 rounded-lg overflow-hidden">

                <!-- LEFT COLUMN -->
                <div class="p-6 border-b md:border-b-0 md:border-r border-gray-300 space-y-6">

                    <!-- Information We Collect -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-2">Information We Collect</h2>
                        <p class="text-gray-700 mb-2">
                            We collect information to improve our website and services. The types of information we may
                            collect include:
                        </p>
                        <ul class="list-disc list-inside text-gray-700">
                            <li><strong>Personal Information:</strong> When you subscribe to our newsletter, leave a
                                comment, or contact us, we may collect personal details such as your name, email address,
                                and any other information you provide.</li>
                            <li><strong>Non-Personal Information:</strong> We may also collect non-personal data such as
                                your IP address, browser type, operating system, and the pages you visit on our site.</li>
                        </ul>
                    </div>

                    <!-- How We Use Your Information -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-2">How We Use Your Information</h2>
                        <p class="text-gray-700 mb-2">
                            The information we collect is used for the following purposes:
                        </p>
                        <ul class="list-disc list-inside text-gray-700">
                            <li><strong>To Improve Our Website:</strong> We analyze user behavior to improve the content and
                                functionality of our website.</li>
                            <li><strong>To Communicate with You:</strong> We may use your email address to respond to your
                                inquiries, send newsletters, or provide updates about our services.</li>
                            <li><strong>To Personalize User Experience:</strong> We may use your data to offer content that
                                is relevant to your interests.</li>
                        </ul>
                    </div>

                    <!-- Cookies and Tracking -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-2">Cookies and Tracking Technologies</h2>
                        <p class="text-gray-700 mb-2">
                            We use cookies and similar tracking technologies to enhance your browsing experience. Cookies
                            are small files stored on your device that help us remember your preferences and understand how
                            you interact with our site.
                        </p>
                        <h3 class="text-xl font-semibold mb-2">Types of Cookies We Use:</h3>
                        <ul class="list-disc list-inside text-gray-700">
                            <li><strong>Essential Cookies:</strong> Necessary for the website to function properly.</li>
                            <li><strong>Analytics Cookies:</strong> Help us understand how visitors interact with our site.
                            </li>
                            <li><strong>Marketing Cookies:</strong> Used to deliver personalized advertisements.</li>
                        </ul>
                        <p class="text-gray-700 mt-2">
                            You can choose to disable cookies through your browser settings, but this may affect your
                            ability to use certain features of our website.
                        </p>
                    </div>

                </div>

                <!-- RIGHT COLUMN -->
                <div class="p-6 space-y-6">

                    <!-- Third-Party Services -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-2">Third-Party Services</h2>
                        <p class="text-gray-700">
                            We may use third-party services, such as Google Analytics, to analyze website traffic. These
                            third parties may collect and process data according to their own privacy policies. We do not
                            control the information collected by third parties.
                        </p>
                    </div>

                    <!-- Website Goal -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-2">Our Website Goal</h2>
                        <p class="text-gray-700">
                            Our website’s main goal is to provide services similar to those offered by websites like
                            Forbes.com and others. Our aim is to position our website among these types of competitive
                            platforms.
                        </p>
                    </div>

                    <!-- Data Security -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-2">Data Security</h2>
                        <p class="text-gray-700">
                            We take reasonable measures to protect your personal information from unauthorized access,
                            disclosure, alteration, or destruction. However, no method of transmission over the internet or
                            electronic storage is completely secure, and we cannot guarantee absolute security.
                        </p>
                    </div>

                    <!-- Your Rights -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-2">Your Rights</h2>
                        <p class="text-gray-700">
                            You have the right to:
                        </p>
                        <ul class="list-disc list-inside text-gray-700">
                            <li>Access Your Data: Request a copy of the personal information we hold about you.</li>
                            <li>Correct Your Data: Request corrections to any inaccuracies in your personal data.</li>
                            <li>Delete Your Data: Request the deletion of your personal information from our records.</li>
                        </ul>
                        <p class="text-gray-700 mt-2">
                            To exercise these rights, please contact us at <a href="mailto:sales@financeadvisory.com"
                                class="text-blue-600 underline">sales@financeadvisory.com</a>.
                        </p>
                    </div>

                    <!-- Changes -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-2">Changes to This Privacy Policy</h2>
                        <p class="text-gray-700">
                            We may update this Privacy Policy from time to time. Any changes will be posted on this page,
                            and the date at the top will be updated accordingly. We encourage you to review this policy
                            periodically to stay informed about how we are protecting your information.
                        </p>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-2">Contact Us</h2>
                        <p class="text-gray-700">
                            If you have any questions or concerns about this privacy policy, please contact us at:
                        </p>
                        <p class="text-gray-700 font-semibold mt-2">
                            Finance Advisory <br>
                            Email: <a href="mailto:sales@financeadvisory.com"
                                class="text-blue-600 underline">sales@financeadvisory.com</a>
                        </p>
                    </div>

                </div>

            </div>

        </div>
    </section>





@endsection