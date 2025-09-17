<footer class="bg-gray-900 text-white">
  <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
      
      <!-- Logo & Description -->
      <div class="col-span-2 md:col-span-4 lg:col-span-1">
        <img src="{{ asset('images/logo/logo.png') }}" alt="Store Logo" class="h-12 w-auto" />
        <p class="mt-4 text-sm text-gray-400">
          Your one-stop shop for everything tennis.
        </p>
      </div>

      <!-- Shop Links -->
      <div>
        <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300">
          Shop
        </h3>
        <ul class="mt-4 space-y-2">
          <li><a href="#" class="text-base text-gray-400 hover:text-white">Rackets</a></li>
          <li><a href="#" class="text-base text-gray-400 hover:text-white">Shoes</a></li>
          <li><a href="#" class="text-base text-gray-400 hover:text-white">Apparel</a></li>
          <li><a href="#" class="text-base text-gray-400 hover:text-white">Accessories</a></li>
        </ul>
      </div>

      <!-- Support Links -->
      <div>
        <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300">
          Support
        </h3>
        <ul class="mt-4 space-y-2">
          <li><a href="#" class="text-base text-gray-400 hover:text-white">Contact Us</a></li>
          <li><a href="#" class="text-base text-gray-400 hover:text-white">FAQ</a></li>
          <li><a href="#" class="text-base text-gray-400 hover:text-white">Shipping</a></li>
          <li><a href="#" class="text-base text-gray-400 hover:text-white">Returns</a></li>
        </ul>
      </div>

      <!-- Company Links -->
      <div>
        <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300">
          Company
        </h3>
        <ul class="mt-4 space-y-2">
          <li><a href="{{ route('about.us') }}" class="text-base text-gray-400 hover:text-white">About Us</a></li>
          <li><a href="{{ route('support') }}" class="text-base text-gray-400 hover:text-white">Support</a></li>
          <li><a href="{{ route('terms.conditions') }}" class="text-base text-gray-400 hover:text-white">Terms and Conditions</a></li>
          <li><a href="{{ route('privacy.policy') }}" class="text-base text-gray-400 hover:text-white">Privacy Policy</a></li>
        </ul>
      </div>
    </div>

    <!-- Bottom Footer -->
    <div class="mt-12 border-t border-gray-800 pt-8 flex flex-col items-center justify-between sm:flex-row">
      <p class="text-sm text-gray-400">
        © 2025 Tenama. All rights reserved.
      </p>
      <div class="flex mt-4 space-x-6 sm:mt-0">
        
        <!-- Twitter -->
        <a href="#" class="text-gray-400 hover:text-white">
          <span class="sr-only">Twitter</span>
          <svg
            aria-hidden="true"
            class="h-6 w-6"
            fill="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 
                 0-.178 0-.355-.012-.53A8.348 8.348 0 
                 0022 5.92a8.19 8.19 0 01-2.357.646 
                 4.118 4.118 0 001.804-2.27 8.224 8.224 0 
                 01-2.605.996 4.107 4.107 0 00-6.993 
                 3.743 11.65 11.65 0 01-8.457-4.287 
                 4.106 4.106 0 001.27 5.477A4.072 4.072 0 
                 012.8 9.71v.052a4.105 4.105 0 
                 003.292 4.022 4.095 4.095 0 
                 01-1.853.07 4.108 4.108 0 
                 003.834 2.85A8.233 8.233 0 
                 012 18.407a11.616 11.616 0 
                 006.29 1.84"
            />
          </svg>
        </a>

        <!-- Facebook -->
        <a href="#" class="text-gray-400 hover:text-white">
          <span class="sr-only">Facebook</span>
          <svg
            aria-hidden="true"
            class="h-6 w-6"
            fill="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M22 12c0-5.523-4.477-10-10-10S2 
                 6.477 2 12c0 4.991 3.657 9.128 
                 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 
                 1.492-3.89 3.777-3.89 1.094 0 
                 2.238.195 2.238.195v2.46h-1.26c-1.243 
                 0-1.63.771-1.63 1.562V12h2.773l-.443 
                 2.89h-2.33v6.988C18.343 21.128 
                 22 16.991 22 12z"
            />
          </svg>
        </a>

        <!-- Instagram -->
        <a href="#" class="text-gray-400 hover:text-white">
          <span class="sr-only">Instagram</span>
          <svg
            aria-hidden="true"
            class="h-6 w-6"
            fill="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M12.315 2c2.43 0 2.784.013 
                 3.808.06 1.064.049 1.791.218 
                 2.427.465a4.902 4.902 0 
                 012.032 1.258 4.902 4.902 0 
                 011.258 2.032c.247.636.416 
                 1.363.465 2.427.048 1.024.06 
                 1.378.06 3.808s-.012 2.784-.06 
                 3.808c-.049 1.064-.218 1.791-.465 
                 2.427a4.902 4.902 0 
                 01-1.258 2.032 4.902 4.902 0 
                 01-2.032 1.258c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.013-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0-01-2.032-1.258 4.902 4.902 0-01-1.258-2.032c-.247-.636-.416-1.363-.465-2.427C2.013 14.784 2 14.43 2 12s.013-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.258-2.032A4.902 4.902 0 016.48 2.525c.636-.247 1.363-.416 2.427-.465C9.93 2.013 10.284 2 12.315 2zM12 7a5 5 0 100 10 
                 5 5 0 000-10zm0 8a3 3 0 
                 110-6 3 3 0 010 6zm5.25-9.75a1.25 
                 1.25 0 100 2.5 1.25 1.25 0 
                 000-2.5z"
            />
          </svg>
        </a>
      </div>
    </div>
  </div>
</footer>
