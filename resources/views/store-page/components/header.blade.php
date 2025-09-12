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
        href="{{ route('catalog') }}"
        class="text-base font-medium flex items-center justify-center rounded-lg p-2.5 {{ request()->routeIs('catalog') ? 'bg-[#84cc16] text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }} transition-colors"
        title="Catalog"
      >
        Catalog
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

    <!-- Profile/Sign In: hidden on mobile, show on md+ -->
    @if(auth()->check())
      <div class="relative hidden md:flex items-center">
        <button id="profile-avatar" type="button" class="flex items-center justify-center aspect-square rounded-full size-10 bg-[#84cc16] text-white text-xl font-bold focus:outline-none" aria-label="Profile">
          {{ strtoupper(substr(auth()->user()->name ?? auth()->user()->email, 0, 1)) }}
        </button>
        <div id="profile-dropdown" class="absolute left-1/2 -translate-x-1/2 mt-36 w-30 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50 hidden">
          <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Sign Out</button>
          </form>
        </div>
      </div>
      <script>
        document.addEventListener('DOMContentLoaded', function () {
          var avatar = document.getElementById('profile-avatar');
          var dropdown = document.getElementById('profile-dropdown');
          if (avatar && dropdown) {
            avatar.addEventListener('click', function (e) {
              e.stopPropagation();
              dropdown.classList.toggle('hidden');
            });
            document.addEventListener('click', function (e) {
              if (!avatar.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
              }
            });
          }
        });
      </script>
    @else
      <a href="{{ route('login') }}" class="hidden md:flex items-center gap-2 text-[#84cc16] font-bold">
        <span class="material-symbols-outlined">person</span>
        <span class="hover:underline">Sign In</span>
      </a>
    @endif

    <!-- Burger Menu: show only on mobile, toggles active/inactive state -->
  <x-burger-menu-button class="md:hidden" />
  </div>
</header>
