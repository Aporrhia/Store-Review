<header
  class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-gray-200 px-10 py-4 shadow-sm"
>
  <div class="flex items-center gap-10">
    <!-- Logo -->
    <a href="/">
      <img src="{{ asset('images/logo/logo.png') }}" alt="Store Logo" class="h-12 w-auto" />
    </a>

    <!-- Navigation -->
    <nav class="hidden lg:flex items-center gap-8">
      <a
        href="{{ route('catalog') }}"
        class="text-base font-medium text-gray-600 hover:text-gray-900 transition-colors"
      >
        Catalog
      </a>
      <a
        href="{{ route('catalog', ['category' => ['Rackets']]) }}"
        class="text-base font-medium text-gray-600 hover:text-gray-900 transition-colors"
      >
        Rackets
      </a>
      <a
        href="{{ route('catalog', ['category' => ['Balls']]) }}"
        class="text-base font-medium text-gray-600 hover:text-gray-900 transition-colors"
      >
        Balls
      </a>
      <a
        href="{{ route('catalog', ['category' => ['Dampeners', 'Overgrips', 'Base Grips']]) }}"
        class="text-base font-medium text-gray-600 hover:text-gray-900 transition-colors"
      >
        Accessories
      </a>
      <a
        href="{{ route('listing.create') }}"
        class="text-base font-medium text-gray-600 hover:text-gray-900 transition-colors" {{ request()->routeIs('listing.create')  }}
        title="Listing"
      >
        Listing
      </a>
    </nav>
  </div>

  <!-- Right Section -->
  <div class="flex flex-1 justify-end items-center gap-2 sm:gap-4">
    <!-- Search (responsive) -->
    <label class="relative flex-1 max-w-xs sm:max-w-sm lg:max-w-md xl:max-w-lg ml-6">
      <span class="sr-only">Search</span>
      <span class="absolute inset-y-0 left-0 flex items-center pl-3">
        <span class="material-symbols-outlined text-gray-500 text-xl">search</span>
      </span>
      <input
        type="text"
        id="header-search"
        autocomplete="off"
        placeholder="Search products..."
        class="form-input block w-full min-w-0 rounded-md border-gray-300 bg-gray-100 py-2.5 pl-10 pr-4 text-gray-900 placeholder:text-gray-500 focus:border-lime-500 focus:ring-lime-500 text-sm leading-6"
      />
      <div id="search-dropdown" class="absolute left-0 right-0 mt-2 bg-white rounded-lg shadow-lg border border-gray-200 z-50 hidden max-h-80 overflow-y-auto">
        <ul id="search-results" class="divide-y divide-gray-100"></ul>
        <div id="search-more" class="px-4 py-3 text-sm text-gray-500 hidden cursor-pointer hover:text-[#84cc16] border-t border-gray-100">Show all results</div>
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
          if (query.length < 2) {
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
                    li.innerHTML = `
                      <a href="/catalog?q=${encodeURIComponent(item.title)}" class="block px-4 py-3 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-3">
                          <div class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-md flex items-center justify-center">
                            <span class="material-symbols-outlined text-gray-400 text-sm">search</span>
                          </div>
                          <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">${item.title}</p>
                            <p class="text-xs text-gray-500 truncate">${item.category || 'Product'}</p>
                          </div>
                        </div>
                      </a>
                    `;
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
                  resultsList.innerHTML = `
                    <li class="px-4 py-6 text-center">
                      <div class="text-gray-400 mb-2">
                        <span class="material-symbols-outlined text-2xl">search_off</span>
                      </div>
                      <p class="text-sm text-gray-500">No results found for "${query}"</p>
                      <p class="text-xs text-gray-400 mt-1">Try different keywords</p>
                    </li>
                  `;
                  moreLink.classList.add('hidden');
                }
              })
              .catch(error => {
                console.error('Search error:', error);
                dropdown.classList.add('hidden');
              });
          }, 300);
        });
        
        document.addEventListener('click', function (e) {
          if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
          }
        });
        
        searchInput.addEventListener('focus', function() {
          if (resultsList.children.length > 0) {
            dropdown.classList.remove('hidden');
          }
        });
        
        moreLink.addEventListener('click', function () {
          window.location.href = '/catalog?q=' + encodeURIComponent(searchInput.value.trim());
        });
      });
    </script>

    <!-- Icons: always show on mobile and desktop -->
    <div class="flex gap-1 sm:gap-2 flex-shrink-0">
      <a
        href="{{ route('liked.items') }}"
        class="flex items-center justify-center rounded-full p-2.5 {{ request()->routeIs('liked.items') ? 'bg-[#84cc16] text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }} transition-colors"
        title="Liked Items"
      >
        <span class="material-symbols-outlined">favorite</span>
      </a>
      <a
        href="{{ route('cart.index') }}"
        class="relative flex items-center justify-center rounded-full p-2.5 {{ request()->routeIs('cart.index') ? 'bg-[#84cc16] text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }} transition-colors"
        title="Cart"
      >
        <span class="material-symbols-outlined">shopping_bag</span>
        @if(isset($cartCount) && $cartCount > 0)
          <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full px-1.5 py-0.5 min-w-[20px] flex items-center justify-center shadow">{{ $cartCount }}</span>
        @endif
      </a>
    </div>

    <!-- Profile/Sign In: hidden on mobile, show on lg+ -->
    @if(auth()->check())
      <div class="relative hidden lg:flex items-center flex-shrink-0">
        <button id="profile-avatar" type="button" class="flex items-center justify-center aspect-square rounded-full size-10 bg-[#84cc16] text-white text-xl font-bold focus:outline-none" aria-label="Profile">
          {{ strtoupper(substr(auth()->user()->name ?? auth()->user()->email, 0, 1)) }}
        </button>
        <div id="profile-dropdown" class="absolute left-1/2 -translate-x-1/2 mt-36 w-30 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50 hidden">
          <a href="{{ route('profile.me') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
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
      <a href="{{ route('login') }}" class="hidden lg:flex items-center gap-2 text-[#84cc16] font-bold flex-shrink-0">
        <span class="material-symbols-outlined">person</span>
        <span class="hover:underline">Sign In</span>
      </a>
    @endif

    <!-- Burger Menu: show only on mobile, toggles active/inactive state -->
    <x-burger-menu-button id="burger-menu-toggle" class="lg:hidden flex-shrink-0" />
    <!-- Mobile Menu Drawer -->
  <div id="mobile-nav-menu" class="fixed inset-0 w-full h-full bg-white z-50 p-6 flex flex-col gap-6 shadow-lg transition-transform transform translate-x-full lg:hidden">
      <button id="close-mobile-menu" class="absolute top-6 right-6 p-2 rounded-md">
        <span class="material-symbols-outlined">close</span>
      </button>
      <nav class="flex flex-col gap-4">
        <a href="#" class="text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 transition-colors px-4 py-2 rounded-md">New Arrivals</a>
        <a href="{{ route('catalog') }}" class="text-base font-medium {{ request()->routeIs('catalog') ? 'bg-[#84cc16] text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900' }} transition-colors px-4 py-2 rounded-md">Catalog</a>
        <a href="{{ route('catalog', ['category' => ['Rackets']]) }}" class="text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 transition-colors px-4 py-2 rounded-md">Rackets</a>
        <a href="{{ route('catalog', ['category' => ['Balls']]) }}" class="text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 transition-colors px-4 py-2 rounded-md">Balls</a>
        <a href="{{ route('catalog', ['category' => ['Dampeners', 'Overgrips', 'Base Grips']]) }}" class="text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 transition-colors px-4 py-2 rounded-md">Accessories</a>
  <a href="{{ route('liked.items') }}" class="text-base font-medium {{ request()->routeIs('liked.items') ? 'bg-[#84cc16] text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900' }} transition-colors px-4 py-2 rounded-md">Liked Items</a>
  <a href="{{ route('cart.index') }}" class="text-base font-medium {{ request()->routeIs('cart.index') ? 'bg-[#84cc16] text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900' }} transition-colors px-4 py-2 rounded-md">Cart</a>
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
