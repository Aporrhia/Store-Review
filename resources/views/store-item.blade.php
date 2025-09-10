{{-- store-item.blade.php partial for @include --}}
<div class="relative flex size-full min-h-screen flex-col bg-white group/design-root overflow-x-hidden"
    style='font-family: Lexend, "Noto Sans", sans-serif; --primary-color: #1dc91d;'>
    <div class="relative flex size-full min-h-screen flex-col bg-white group/design-root overflow-x-hidden"
        style='font-family: Lexend, "Noto Sans", sans-serif;'>
        <div class="layout-container flex h-full grow flex-col">
            <header
                class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-gray-200 px-10 py-4">
                <div class="flex items-center gap-10">
                    <a class="flex items-center gap-3 text-2xl font-bold text-gray-900" href="#">
                        <svg class="h-8 w-8 text-[var(--primary-color)]" fill="none" viewBox="0 0 48 48"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_6_330)">
                                <path clip-rule="evenodd"
                                    d="M24 0.757355L47.2426 24L24 47.2426L0.757355 24L24 0.757355ZM21 35.7574V12.2426L9.24264 24L21 35.7574Z"
                                    fill="currentColor" fill-rule="evenodd"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0_6_330">
                                    <rect fill="white" height="48" width="48"></rect>
                                </clipPath>
                            </defs>
                        </svg>
                        <span>Ace Tennis</span>
                    </a>
                    <nav class="hidden md:flex items-center gap-8">
                        <a class="text-gray-600 hover:text-gray-900 text-sm font-medium transition-colors"
                            href="#">Rackets</a>
                        <a class="text-gray-600 hover:text-gray-900 text-sm font-medium transition-colors"
                            href="#">Balls</a>
                        <a class="text-gray-600 hover:text-gray-900 text-sm font-medium transition-colors"
                            href="#">Dampeners</a>
                        <a class="text-gray-600 hover:text-gray-900 text-sm font-medium transition-colors"
                            href="#">Overgrips</a>
                        <a class="text-gray-600 hover:text-gray-900 text-sm font-medium transition-colors" href="#">Base
                            Grips</a>
                        <a class="text-gray-600 hover:text-gray-900 text-sm font-medium transition-colors" href="#">Lead
                            Tapes</a>
                    </nav>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative hidden lg:block">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                        <input
                            class="form-input w-full rounded-full border-gray-200 bg-gray-100 py-2 pl-10 pr-4 text-sm text-gray-900 placeholder:text-gray-400 focus:border-gray-400 focus:ring-gray-400"
                            placeholder="Search products..." type="search" />
                    </div>
                    <button
                        class="flex items-center justify-center rounded-full p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition-colors">
                        <span class="material-symbols-outlined">person</span>
                    </button>
                    <button
                        class="relative flex items-center justify-center rounded-full p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition-colors">
                        <span class="material-symbols-outlined">shopping_cart</span>
                        <span
                            class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-[var(--primary-color)] text-xs font-bold text-white">2</span>
                    </button>
                </div>
            </header>
            <main class="flex-1 bg-gray-50 py-12 md:py-16">
                <div class="container mx-auto px-4 md:px-6">
                    <div class="grid md:grid-cols-2 gap-12 lg:gap-16">
                        <div class="grid gap-4">
                            <div class="relative overflow-hidden rounded-lg shadow-sm">
                                <div class="aspect-[4/3] bg-center bg-no-repeat bg-cover"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAAROJvHVQcfBZXJ1g2b3ynng1Uo3rts3-boOLuSziQK_JVInDnqIhueCa4fFOx6cJlwFnHINLhMCqKpQVIJozPSSQLlRDS2bSYSnLuQ3XH2w_FKFxQErVwjK0U5StUIbzhBak6EejvRyH7_BevF6u3CxrS8eRpx4Ewzra7OQQHYtwQPt4jK0lzcW8_sU6ZTNVkDZUqRmp6eLrhArfET6ECgxnRs8JQMgctFEoTzWR1IEqBdNHr4o7iX3WUhz_54qPrgaNviksirxU");'>
                                </div>
                                <div class="absolute inset-0 bg-black/5"></div>
                            </div>
                            <div class="grid grid-cols-4 gap-4">
                                <div
                                    class="relative overflow-hidden rounded-lg border border-gray-200 hover:border-[var(--primary-color)] transition-all cursor-pointer">
                                    <img alt="Racket view 1" class="aspect-square object-cover w-full h-full"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAROJvHVQcfBZXJ1g2b3ynng1Uo3rts3-boOLuSziQK_JVInDnqIhueCa4fFOx6cJlwFnHINLhMCqKpQVIJozPSSQLlRDS2bSYSnLuQ3XH2w_FKFxQErVwjK0U5StUIbzhBak6EejvRyH7_BevF6u3CxrS8eRpx4Ewzra7OQQHYtwQPt4jK0lzcW8_sU6ZTNVkDZUqRmp6eLrhArfET6ECgxnRs8JQMgctFEoTzWR1IEqBdNHr4o7iX3WUhz_54qPrgaNviksirxU" />
                                    <div class="absolute inset-0 bg-black/5"></div>
                                </div>
                                <div
                                    class="relative overflow-hidden rounded-lg border border-gray-200 hover:border-[var(--primary-color)] transition-all cursor-pointer">
                                    <img alt="Racket view 2"
                                        class="aspect-square object-cover w-full h-full -scale-x-100"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAROJvHVQcfBZXJ1g2b3ynng1Uo3rts3-boOLuSziQK_JVInDnqIhueCa4fFOx6cJlwFnHINLhMCqKpQVIJozPSSQLlRDS2bSYSnLuQ3XH2w_FKFxQErVwjK0U5StUIbzhBak6EejvRyH7_BevF6u3CxrS8eRpx4Ewzra7OQQHYtwQPt4jK0lzcW8_sU6ZTNVkDZUqRmp6eLrhArfET6ECgxnRs8JQMgctFEoTzWR1IEqBdNHr4o7iX3WUhz_54qPrgaNviksirxU" />
                                    <div class="absolute inset-0 bg-black/5"></div>
                                </div>
                                <div
                                    class="relative overflow-hidden rounded-lg border border-gray-200 hover:border-[var(--primary-color)] transition-all cursor-pointer">
                                    <img alt="Racket view 3" class="aspect-square object-cover w-full h-full rotate-90"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAROJvHVQcfBZXJ1g2b3ynng1Uo3rts3-boOLuSziQK_JVInDnqIhueCa4fFOx6cJlwFnHINLhMCqKpQVIJozPSSQLlRDS2bSYSnLuQ3XH2w_FKFxQErVwjK0U5StUIbzhBak6EejvRyH7_BevF6u3CxrS8eRpx4Ewzra7OQQHYtwQPt4jK0lzcW8_sU6ZTNVkDZUqRmp6eLrhArfET6ECgxnRs8JQMgctFEoTzWR1IEqBdNHr4o7iX3WUhz_54qPrgaNviksirxU" />
                                    <div class="absolute inset-0 bg-black/5"></div>
                                </div>
                                <div
                                    class="relative overflow-hidden rounded-lg border border-gray-200 hover:border-[var(--primary-color)] transition-all cursor-pointer">
                                    <img alt="Racket view 4" class="aspect-square object-cover w-full h-full scale-150"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAROJvHVQcfBZXJ1g2b3ynng1Uo3rts3-boOLuSziQK_JVInDnqIhueCa4fFOx6cJlwFnHINLhMCqKpQVIJozPSSQLlRDS2bSYSnLuQ3XH2w_FKFxQErVwjK0U5StUIbzhBak6EejvRyH7_BevF6u3CxrS8eRpx4Ewzra7OQQHYtwQPt4jK0lzcW8_sU6ZTNVkDZUqRmp6eLrhArfET6ECgxnRs8JQMgctFEoTzWR1IEqBdNHr4o7iX3WUhz_54qPrgaNviksirxU" />
                                    <div class="absolute inset-0 bg-black/5"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-6">
                            <div>
                                <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                                    <a class="hover:text-gray-800" href="#">Rackets</a>
                                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                                    <span class="font-medium text-gray-700">Pro Staff 97</span>
                                </div>
                                <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-gray-900">Pro Staff 97
                                </h1>
                                <p class="text-gray-600 mt-2">The Pro Staff 97 is a classic racket known for its
                                    precision and control. Ideal for advanced players seeking a blend of feel and power.
                                </p>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="flex text-yellow-400">
                                    <span class="material-symbols-outlined">star</span>
                                    <span class="material-symbols-outlined">star</span>
                                    <span class="material-symbols-outlined">star</span>
                                    <span class="material-symbols-outlined">star</span>
                                    <span class="material-symbols-outlined">star_half</span>
                                </div>
                                <span class="text-gray-600 text-sm">(4.5 from 120 reviews)</span>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-gray-900">$249.00</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-700" for="grip-size">Grip Size</label>
                                    <select
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[var(--primary-color)] focus:ring-[var(--primary-color)] sm:text-sm"
                                        id="grip-size">
                                        <option>4 1/8</option>
                                        <option selected="">4 1/4</option>
                                        <option>4 3/8</option>
                                        <option>4 1/2</option>
                                        <option>4 5/8</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-700" for="quantity">Quantity</label>
                                    <input
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[var(--primary-color)] focus:ring-[var(--primary-color)] sm:text-sm"
                                        id="quantity" min="1" type="number" value="1" />
                                </div>
                            </div>
                            <button
                                class="w-full flex items-center justify-center gap-2 rounded-md bg-[var(--primary-color)] px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-opacity-90 transition-all focus:outline-none focus:ring-2 focus:ring-[var(--primary-color)] focus:ring-offset-2">
                                <span class="material-symbols-outlined">add_shopping_cart</span>
                                Add to Cart
                            </button>
                            <div class="border-t border-gray-200 pt-6">
                                <h3 class="text-lg font-semibold text-gray-900">Specifications</h3>
                                <div class="mt-4 grid grid-cols-2 gap-x-6 gap-y-4 text-sm">
                                    <div>
                                        <p class="text-gray-500">Head Size</p>
                                        <p class="text-gray-800 font-medium">97 sq. in.</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Weight (Strung)</p>
                                        <p class="text-gray-800 font-medium">11.7 oz / 332g</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Balance</p>
                                        <p class="text-gray-800 font-medium">6 pts HL</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Swingweight</p>
                                        <p class="text-gray-800 font-medium">325</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">String Pattern</p>
                                        <p class="text-gray-800 font-medium">16x19</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Composition</p>
                                        <p class="text-gray-800 font-medium">Braided Graphite</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-16 border-t border-gray-200 pt-12">
                        <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-8">Customer Reviews</h2>
                        <div class="grid md:grid-cols-3 gap-8">
                            <div
                                class="flex flex-col items-center justify-center gap-2 p-6 rounded-lg bg-white shadow-sm border border-gray-100">
                                <p class="text-5xl font-bold text-gray-900">4.5</p>
                                <div class="flex text-yellow-400">
                                    <span class="material-symbols-outlined">star</span>
                                    <span class="material-symbols-outlined">star</span>
                                    <span class="material-symbols-outlined">star</span>
                                    <span class="material-symbols-outlined">star</span>
                                    <span class="material-symbols-outlined">star_half</span>
                                </div>
                                <p class="text-sm text-gray-600">Based on 120 reviews</p>
                            </div>
                            <div
                                class="md:col-span-2 flex flex-col gap-3 p-6 rounded-lg bg-white shadow-sm border border-gray-100">
                                <div class="flex items-center gap-4">
                                    <span class="text-sm font-medium text-gray-700">5 star</span>
                                    <div class="flex-1 h-2.5 bg-gray-200 rounded-full">
                                        <div class="h-full bg-yellow-400 rounded-full" style="width: 75%;"></div>
                                    </div>
                                    <span class="text-sm text-gray-500 w-10 text-right">75%</span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-sm font-medium text-gray-700">4 star</span>
                                    <div class="flex-1 h-2.5 bg-gray-200 rounded-full">
                                        <div class="h-full bg-yellow-400 rounded-full" style="width: 15%;"></div>
                                    </div>
                                    <span class="text-sm text-gray-500 w-10 text-right">15%</span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-sm font-medium text-gray-700">3 star</span>
                                    <div class="flex-1 h-2.5 bg-gray-200 rounded-full">
                                        <div class="h-full bg-yellow-400 rounded-full" style="width: 5%;"></div>
                                    </div>
                                    <span class="text-sm text-gray-500 w-10 text-right">5%</span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-sm font-medium text-gray-700">2 star</span>
                                    <div class="flex-1 h-2.5 bg-gray-200 rounded-full">
                                        <div class="h-full bg-yellow-400 rounded-full" style="width: 3%;"></div>
                                    </div>
                                    <span class="text-sm text-gray-500 w-10 text-right">3%</span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-sm font-medium text-gray-700">1 star</span>
                                    <div class="flex-1 h-2.5 bg-gray-200 rounded-full">
                                        <div class="h-full bg-yellow-400 rounded-full" style="width: 2%;"></div>
                                    </div>
                                    <span class="text-sm text-gray-500 w-10 text-right">2%</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-10 space-y-8">
                            <div class="p-6 rounded-lg bg-white shadow-sm border border-gray-100">
                                <div class="flex items-start gap-4">
                                    <img alt="Avatar" class="h-12 w-12 rounded-full object-cover"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCujdT9QMIGJuJBheghz0CRcwlas334NKhqUqUTPGckvZNtDPlyJweX_ihFp5L8OOFYj4DMA-J0po-92vS8vcik_kK5nXKP2kpi3RjEGTpBw5rHNay3yIGfSWN6Ywjn1JQ6jexD_nWCEJtyc0xtIs5sz9JYPmvP043jnP3MmiD4DS2sudB2sZxbhJwUUm0tvWZkIuYA-KDQBnszqtUALN3YhBH4vEwIsTKz5O9pmcnp7hWQQXFfqVCB_3k3G2hiFmyMfk9pt0ZVAGA" />
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="font-semibold text-gray-800">Ethan Carter</p>
                                                <p class="text-sm text-gray-500">June 15, 2024</p>
                                            </div>
                                            <div class="flex text-yellow-400">
                                                <span class="material-symbols-outlined text-base">star</span>
                                                <span class="material-symbols-outlined text-base">star</span>
                                                <span class="material-symbols-outlined text-base">star</span>
                                                <span class="material-symbols-outlined text-base">star</span>
                                                <span class="material-symbols-outlined text-base">star</span>
                                            </div>
                                        </div>
                                        <p class="mt-3 text-gray-600">This racket is amazing! The control and feel are
                                            unmatched. Highly recommend for serious players who want to take their game
                                            to the next level.</p>
                                        <div class="mt-3 flex items-center gap-4 text-sm text-gray-500">
                                            <button
                                                class="flex items-center gap-1.5 hover:text-[var(--primary-color)] transition-colors"><span
                                                    class="material-symbols-outlined text-base">thumb_up</span>
                                                5</button>
                                            <button
                                                class="flex items-center gap-1.5 hover:text-red-500 transition-colors"><span
                                                    class="material-symbols-outlined text-base">thumb_down</span>
                                                1</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 rounded-lg bg-white shadow-sm border border-gray-100">
                                <div class="flex items-start gap-4">
                                    <img alt="Avatar" class="h-12 w-12 rounded-full object-cover"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAuUaMYmoMaEPdi8DV2bbd6YJw4tvuIASDROTHOt1tZIRI6Hfflb3WyrGilHVwBbStq1tkOXmBuJFc7iC2J5d3iuVUGDN7K1AgpySEjlRDF49mAdGJCqOBJW2dFygT29R-GOYVcnmjoENJqi7xmG1tHA9788E1jmd-2NbQ6Y2V5veecr10pzcf9eyh6MBaRmOv9-0SDHMa1riA4jmMc5zP0ZK0cCZn8X6F1dRwTi4nqZK03cBNKvCbuARg6mTuTrJXkyzjk3V8ac5Y" />
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="font-semibold text-gray-800">Sophia Bennett</p>
                                                <p class="text-sm text-gray-500">May 20, 2024</p>
                                            </div>
                                            <div class="flex text-yellow-400">
                                                <span class="material-symbols-outlined text-base">star</span>
                                                <span class="material-symbols-outlined text-base">star</span>
                                                <span class="material-symbols-outlined text-base">star</span>
                                                <span class="material-symbols-outlined text-base">star</span>
                                                <span
                                                    class="material-symbols-outlined text-base text-gray-300">star</span>
                                            </div>
                                        </div>
                                        <p class="mt-3 text-gray-600">Great racket, but it takes some getting used to.
                                            The smaller sweet spot is punishing on off-center hits, but once you find
                                            it, the ball flies.</p>
                                        <div class="mt-3 flex items-center gap-4 text-sm text-gray-500">
                                            <button
                                                class="flex items-center gap-1.5 hover:text-[var(--primary-color)] transition-colors"><span
                                                    class="material-symbols-outlined text-base">thumb_up</span>
                                                3</button>
                                            <button
                                                class="flex items-center gap-1.5 hover:text-red-500 transition-colors"><span
                                                    class="material-symbols-outlined text-base">thumb_down</span>
                                                0</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

</div>