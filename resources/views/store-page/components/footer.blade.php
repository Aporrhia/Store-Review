<footer class="bg-gray-900 text-white">
  <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
      
      <!-- Shop Links -->
      <div>
        <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300">
          Shop
        </h3>
        <ul class="mt-4 space-y-2">
          <li><a href="{{ route('catalog', ['category' => ['Rackets']]) }}" class="text-base text-gray-400 hover:text-white">Rackets</a></li>
          <li><a href="#" class="text-base text-gray-400 hover:text-white">Strings</a></li>
          <li><a href="{{ route('catalog', ['category' => ['Balls']]) }}" class="text-base text-gray-400 hover:text-white">Balls</a></li>
          <li><a href="{{ route('catalog', ['category' => ['Dampeners', 'Overgrips', 'Base Grips']]) }}" class="text-base text-gray-400 hover:text-white">Accessories</a></li>
        </ul>
      </div>

      <!-- Support Links -->
      <div>
        <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300">
          Support
        </h3>
        <ul class="mt-4 space-y-2">
          <li><a href="{{ route('faq') }}" class="text-base text-gray-400 hover:text-white">FAQ</a></li>
          <li><a href="{{ route('support') }}" class="text-base text-gray-400 hover:text-white">Support</a></li>
          <li><a href="{{ route('terms.conditions') }}" class="text-base text-gray-400 hover:text-white">Terms and Conditions</a></li>
          <li><a href="{{ route('privacy.policy') }}" class="text-base text-gray-400 hover:text-white">Privacy Policy</a></li>
        </ul>
      </div>

      <!-- Company Links -->
      <div>
        <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300">
          Company
        </h3>
        <ul class="mt-4 space-y-2">
          <li><a href="{{ route('about.us') }}" class="text-base text-gray-400 hover:text-white">About Us</a></li>
          <li><a href="{{ route('blog') }}" class="text-base text-gray-400 hover:text-white">Blog</a></li>
          <li><a href="{{ route('media') }}" class="text-base text-gray-400 hover:text-white">Media</a></li>
        </ul>
      </div>
      
      <!-- Logo & Contact Information -->
      <div class="col-span-2 md:col-span-4 lg:col-span-1">
        <div class="flex items-center space-x-3 mb-4">
          <img src="{{ asset('images/logo/logo.png') }}" alt="Store Logo" class="h-12 w-auto" />
          <p class="text-sm text-gray-400">
            Your one-stop shop for everything tennis.
          </p>
        </div>
        
        <!-- Contact Information -->
        <div class="space-y-3">
          <div class="flex items-center space-x-3">
            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            <span class="text-sm text-gray-400">info@tenama.com</span>
          </div>
          <div class="flex items-center space-x-3">
            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
            </svg>
            <span class="text-sm text-gray-400">1-800-TENAMA-1</span>
          </div>
        </div>

        <!-- Payment Methods -->
        <div class="mt-6">
          <h4 class="text-sm font-semibold uppercase tracking-wider text-gray-300 mb-3">We Accept</h4>
          <img src="{{ asset('images/components/logo-row.png') }}" alt="Accepted Payment Methods" class="h-8 w-auto opacity-80" />
        </div>
      </div>
    </div> 

    <!-- Bottom Footer -->
    <div class="mt-12 border-t border-gray-800 pt-8 flex flex-col items-center justify-between sm:flex-row">
      <p class="text-sm text-gray-400">
        © 2025 Tenama. All rights reserved.
      </p>
        
      <!-- Social Media Icons -->
      <div class="flex mt-4 space-x-6 sm:mt-0">
        <x-social-icon icon="instagram" />
        <x-social-icon icon="youtube" />
        <x-social-icon icon="tiktok" />
      </div>

    </div>
  </div>
</footer>
