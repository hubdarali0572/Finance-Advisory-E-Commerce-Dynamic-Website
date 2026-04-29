@extends('Frontend.frontend-layout.app')

@section('title', 'Excellence in Modern Education')

@section('content')

    <section class="py-6">
        <div class="w-full mx-auto 
                        h-[180px] sm:h-[220px] md:h-[230px] lg:h-[350px] 
                        relative bg-cover bg-center"
            style="background-image: url('{{ asset('assets/images/others/terms.jfif') }}')">
            <h3 class="absolute left-6 sm:left-10 top-1/2 -translate-y-1/2 
                           text-3xl sm:text-4xl md:text-5xl lg:text-6xl
                           text-white font-bold 
                           px-4 sm:px-10 md:px-20 py-2">
                Terms & Conditions
            </h3>
        </div>
    </section>

    <section class="py-6">
        <div class="max-w-7xl mx-auto px-4">

            <!-- Main Title -->
            <div class="md:text-center mb-8">
                <h1 class="text-3xl font-bold mb-2">Terms and Conditions</h1>
                <p class="text-lg text-gray-700">
                    At Finance Advisory, we provide financial advisory services and resources. By accessing or using our
                    website
                    <a href="#" class="text-blue-400 hover:text-blue-600">https://financeadvisory.com/</a>, you agree to
                    comply with and be bound by these Terms and Conditions.
                </p>
            </div>

            <!-- Grid with Border -->
            <div class="grid grid-cols-1 md:grid-cols-2 border border-gray-300 rounded-lg overflow-hidden">

                <!-- LEFT COLUMN -->
                <div class="p-6 border-b md:border-b-0 md:border-r border-gray-300 space-y-6">

                    <!-- Use of Website -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-2">Use of Website</h2>
                        <p class="text-gray-700 mb-2">
                            By using our website, you agree to use it for lawful purposes only. You shall not use our
                            services for any illegal or unauthorized purpose.
                        </p>
                    </div>

                    <!-- User Accounts -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-2">User Accounts</h2>
                        <p class="text-gray-700 mb-2">
                            Certain features of our website may require creating an account. You are responsible for
                            maintaining the confidentiality of your account information and for all activities that occur
                            under your account.
                        </p>
                    </div>

                    <!-- Intellectual Property -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-2">Intellectual Property</h2>
                        <p class="text-gray-700 mb-2">
                            All content, logos, graphics, and materials on this website are the property of Finance Advisory
                            or its licensors. You may not reproduce, distribute, or create derivative works without prior
                            written consent.
                        </p>
                    </div>

                    <!-- Prohibited Activities -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-2">Prohibited Activities</h2>
                        <ul class="list-disc list-inside text-gray-700">
                            <li>Interfering with the website's operation.</li>
                            <li>Attempting to access unauthorized areas or data.</li>
                            <li>Using the website for fraudulent or unlawful purposes.</li>
                            <li>Collecting personal data of other users without consent.</li>
                        </ul>
                    </div>

                </div>

                <!-- RIGHT COLUMN -->
                <div class="p-6 space-y-6">

                    <!-- Third-Party Links -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-2">Third-Party Links</h2>
                        <p class="text-gray-700">
                            Our website may contain links to third-party websites. Finance Advisory is not responsible for
                            the content, privacy practices, or terms of these external sites. Access them at your own risk.
                        </p>
                    </div>

                    <!-- Disclaimer of Liability -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-2">Disclaimer of Liability</h2>
                        <p class="text-gray-700">
                            The information provided on this website is for general informational purposes only. Finance
                            Advisory does not guarantee the accuracy, completeness, or reliability of any content. You agree
                            that your use of the website is at your own risk.
                        </p>
                    </div>

                    <!-- Termination -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-2">Termination</h2>
                        <p class="text-gray-700">
                            We reserve the right to terminate or suspend your access to the website at any time, without
                            notice, for violation of these Terms and Conditions.
                        </p>
                    </div>

                    <!-- Changes to Terms -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-2">Changes to These Terms</h2>
                        <p class="text-gray-700">
                            Finance Advisory may update these Terms and Conditions periodically. Updated terms will be
                            posted on this page, and your continued use of the website constitutes acceptance of the
                            changes.
                        </p>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-2">Contact Us</h2>
                        <p class="text-gray-700">
                            If you have any questions regarding these Terms and Conditions, please contact us at:
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