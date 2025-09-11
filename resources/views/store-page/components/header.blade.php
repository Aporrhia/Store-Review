<header
  class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-gray-200 px-10 py-4 shadow-sm"
>
  <div class="flex items-center gap-10">
    <!-- Logo -->
    <a href="/">
      <img src="{{ asset('images/logo/logo.png') }}" alt="Store Logo" class="h-12 w-auto" />
    </a>

    <!-- Navigation -->
    <nav class="hidden md:flex items-center gap-8">
      <a
        href="#"
        class="text-base font-medium text-gray-600 hover:text-gray-900 transition-colors"
      >
        New Arrivals
      </a>
      <a
        href="#"
        class="text-base font-medium text-gray-600 hover:text-gray-900 transition-colors"
      >
        Men
      </a>
      <a
        href="#"
        class="text-base font-medium text-gray-600 hover:text-gray-900 transition-colors"
      >
        Women
      </a>
      <a
        href="#"
        class="text-base font-medium text-gray-600 hover:text-gray-900 transition-colors"
      >
        Shoes
      </a>
      <a
        href="#"
        class="text-base font-medium text-gray-600 hover:text-gray-900 transition-colors"
      >
        Rackets
      </a>
      <a
        href="#"
        class="text-base font-medium text-gray-600 hover:text-gray-900 transition-colors"
      >
        Accessories
      </a>
    </nav>
  </div>

  <!-- Right Section -->
  <div class="flex flex-1 justify-end items-center gap-4">
    <!-- Search (hidden on mobile) -->
    <label class="relative hidden lg:block">
      <span class="sr-only">Search</span>
      <span class="absolute inset-y-0 left-0 flex items-center pl-3">
        <span class="material-symbols-outlined text-gray-500">search</span>
      </span>
      <input
        type="text"
        placeholder="Search"
        value=""
        class="form-input block w-full min-w-0 flex-1 rounded-md border-gray-300 bg-gray-100 py-2.5 pl-10 pr-4 text-gray-900 placeholder:text-gray-500 focus:border-lime-500 focus:ring-lime-500 sm:text-sm sm:leading-6"
      />
    </label>

    <!-- Icons: always show on mobile and desktop -->
    <div class="flex gap-2">
      <a
        href="{{ route('liked.items') }}"
        class="flex items-center justify-center rounded-full p-2.5 {{ request()->routeIs('liked.items') ? 'bg-[#84cc16] text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }} transition-colors"
        title="Liked Items"
      >
        <span class="material-symbols-outlined">favorite</span>
      </a>
      <button
        class="flex items-center justify-center rounded-full p-2.5 text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition-colors"
      >
        <span class="material-symbols-outlined">shopping_bag</span>
      </button>
    </div>

    <!-- Profile Image: hidden on mobile, show on md+ -->
    <div
      class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 hidden md:block"
      style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC93DKUUEzC7lkrBdfWtvmOrAoSa-kYRKKJmoBxVGU24JG6ZH1w_oaTNXsorUpAwYc8XjdpXG_2i0qmYwV2NbZTUH2wyf9lzECPRzvSwE4Pr3Q6_j9rVVcdXRbkkSfcVQH5iiuL2-Rg91CpPejmv7KWmesm3jw-kx6XBxYiv9pq_Y7jZayhLEGpYLdgVWohgy-2BTbCu31r7ayQwvaSPgD7XhbIyNQnIrtaPgYh7kUXgStmFTGBq2cV5oSrtpfwmKyvfTcgwk0SBVs");'
    ></div>

    <!-- Burger Menu: show only on mobile, toggles active/inactive state -->
  <x-burger-menu-button class="md:hidden" />
  </div>
</header>
