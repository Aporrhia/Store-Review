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
        id="header-search"
        autocomplete="off"
        placeholder="Search"
        class="form-input block w-full min-w-0 flex-1 rounded-md border-gray-300 bg-gray-100 py-2.5 pl-10 pr-4 text-gray-900 placeholder:text-gray-500 focus:border-lime-500 focus:ring-lime-500 sm:text-sm sm:leading-6"
      />
      <div id="search-dropdown" class="absolute left-0 mt-2 w-full bg-white rounded-lg shadow-lg border border-gray-200 z-50 hidden">
        <ul id="search-results" class="divide-y divide-gray-100"></ul>
        <div id="search-more" class="px-4 py-2 text-sm text-gray-500 hidden cursor-pointer hover:text-[#84cc16]">Show all results</div>
      </div>
    </label>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        var searchInput = document.getElementById('header-search');
        var dropdown = document.getElementById('search-dropdown');
        var resultsList = document.getElementById('search-results');
        var moreLink = document.getElementById('search-more');
        var debounceTimeout;
        searchInput.addEventListener('input', function () {
          clearTimeout(debounceTimeout);
          var query = this.value.trim();
          if (!query) {
            dropdown.classList.add('hidden');
            resultsList.innerHTML = '';
            moreLink.classList.add('hidden');
            return;
          }
          debounceTimeout = setTimeout(function () {
            fetch('/search-listings?q=' + encodeURIComponent(query))
              .then(res => res.json())
              .then(data => {
                resultsList.innerHTML = '';
                if (data.results.length) {
                  data.results.forEach(function(item) {
                    var li = document.createElement('li');
                    li.innerHTML = `<a href="/catalog?q=${encodeURIComponent(item.title)}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">${item.title}</a>`;
                    resultsList.appendChild(li);
                  });
                  dropdown.classList.remove('hidden');
                  if (data.hasMore) {
                    moreLink.classList.remove('hidden');
                  } else {
                    moreLink.classList.add('hidden');
                  }
                } else {
                  dropdown.classList.remove('hidden');
                  resultsList.innerHTML = '<li class="px-4 py-2 text-gray-500">No results found</li>';
                  moreLink.classList.add('hidden');
                }
              });
          }, 300);
        });
        document.addEventListener('click', function (e) {
          if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
          }
        });
        moreLink.addEventListener('click', function () {
          window.location.href = '/catalog?q=' + encodeURIComponent(searchInput.value.trim());
        });
      });
    </script>

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
    @auth
      <a href="{{ route('profile') }}"
        class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 hidden md:block"
        style='background-image: url("{{ auth()->user()->profile_photo_url ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuC93DKUUEzC7lkrBdfWtvmOrAoSa-kYRKKJmoBxVGU24JG6ZH1w_oaTNXsorUpAwYc8XjdpXG_2i0qmYwV2NbZTUH2wyf9lzECPRzvSwE4Pr3Q6_j9rVVcdXRbkkSfcVQH5iiuL2-Rg91CpPejmv7KWmesm3jw-kx6XBxYiv9pq_Y7jZayhLEGpYLdgVWohgy-2BTbCu31r7ayQwvaSPgD7XhbIyNQnIrtaPgYh7kUXgStmFTGBq2cV5oSrtpfwmKyvfTcgwk0SBVs' }}");'
        title="My Account">
      </a>
    @else
      <a href="{{ route('login') }}" class="hidden md:inline-flex items-center justify-center rounded-md bg-lime-500 px-4 py-2 text-sm font-bold text-gray-900 shadow-sm transition-colors hover:bg-lime-400 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:ring-offset-2">
        Login
      </a>
    @endauth

    <!-- Burger Menu: show only on mobile, toggles active/inactive state -->
  <x-burger-menu-button id="burger-menu-toggle" class="md:hidden" />
    <!-- Mobile Menu Drawer -->
  <div id="mobile-nav-menu" class="fixed inset-0 w-full h-full bg-white z-50 p-6 flex flex-col gap-6 shadow-lg transition-transform transform translate-x-full md:hidden">
      <button id="close-mobile-menu" class="absolute top-6 right-6 p-2 rounded-md">
        <span class="material-symbols-outlined">close</span>
      </button>
      <nav class="flex flex-col gap-4">
        <a href="#" class="text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 transition-colors px-4 py-2 rounded-md">New Arrivals</a>
        <a href="{{ route('catalog') }}" class="text-base font-medium {{ request()->routeIs('catalog') ? 'bg-[#84cc16] text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900' }} transition-colors px-4 py-2 rounded-md">Catalog</a>
        <a href="#" class="text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 transition-colors px-4 py-2 rounded-md">Rackets</a>
        <a href="#" class="text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 transition-colors px-4 py-2 rounded-md">Accessories</a>
        <a href="{{ route('liked.items') }}" class="text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 transition-colors px-4 py-2 rounded-md">Liked Items</a>
        @if(auth()->check())
          <a href="#" class="text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 transition-colors px-4 py-2 rounded-md">Profile</a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 transition-colors px-4 py-2 rounded-md">Sign Out</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="text-base font-medium text-[#84cc16] hover:bg-gray-200 hover:text-[#84cc16] font-bold px-4 py-2 rounded-md">Sign In</a>
        @endif
      </nav>
    </div>
  </div>
</header>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var burgerBtn = document.getElementById('burger-menu-toggle');
    var mobileMenu = document.getElementById('mobile-nav-menu');
    var closeBtn = document.getElementById('close-mobile-menu');

    if (burgerBtn && mobileMenu) {
      burgerBtn.addEventListener('click', function () {
        mobileMenu.classList.toggle('translate-x-full');
      });
    }
    if (closeBtn && mobileMenu) {
      closeBtn.addEventListener('click', function () {
        mobileMenu.classList.add('translate-x-full');
      });
    }
    document.addEventListener('click', function (e) {
      if (
        mobileMenu &&
        !mobileMenu.contains(e.target) &&
        !burgerBtn.contains(e.target)
      ) {
        mobileMenu.classList.add('translate-x-full');
      }
    });
  });
</script>
