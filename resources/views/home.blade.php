@extends('layouts.app')

@section('title', 'Tennis Equipment, Rackets, Strings & Accessories')

@section('content')
<section class="relative h-[640px] bg-cover bg-center bg-no-repeat" style='background-image: linear-gradient(rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.5) 100%), url("{{ asset('images/banner/big-prom-banner.png') }}");'>
    <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-4">
        <h1 class="text-5xl md:text-7xl font-extrabold tracking-tighter drop-shadow-lg">Elevate Your Game</h1>
        <p class="mt-4 max-w-2xl text-lg md:text-xl font-light drop-shadow-md">Shop the latest tennis gear and apparel designed to perform.</p>
        <button class="mt-8 inline-flex items-center justify-center rounded-md bg-lime-500 px-8 py-3 text-base font-bold text-gray-900 shadow-lg transition-transform hover:scale-105 hover:bg-lime-400 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:ring-offset-2 focus:ring-offset-gray-900">
            Shop Now
        </button>
    </div>
</section>
<section class="py-16 sm:py-24 bg-gray-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 text-center">Shop by Category</h2>
        <div class="mt-10 grid grid-cols-2 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            <a class="group" href="#">
                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200">
                    <img alt="Tennis Rackets" class="h-full w-full object-cover object-center transition-transform group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAG6NS5wfCWnZqRH_da1uBArUhvS1v-TWjsQoKZGuKBOocogajv6oJCN-Se0LA2nKsVHLhbCn7ANJ1gtw4iSpWiQ1BgbaycQuWk3s1zZQZoJwxQk1asqb3HRL6r96BzUeKX-hjY_YplpFomPawHNGR_N1gy9HH6y6D3WGye4FICThRiWOb5yHPKnadh_V2S4t2JdoTKWM-J1dWm1pyqbuhk_PMJUKW_iF5fawvAb_ON6ud9WKACeFY0GKqntX_sKxh9blTznOtbBrQ"/>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">Rackets</h3>
            </a>
            <a class="group" href="#">
                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200">
                    <img alt="Tennis Shoes" class="h-full w-full object-cover object-center transition-transform group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC-94Vz6AybbTOHyNP8UyEbvTaqtsanwe-xjcf1ru2_IvXqNMCcjVpFLEq-yQxwjlZbxwZeNq5e_0TZnwasgFq_NCPSd_ZrU140AidMCU8tE-AY_CP_bbfEks2FROw1JpcSf1TvW9DssCTc9phOk-rd9oXhVYeAIFvF4rKzpDT1Fcy5R4MnY7TNNjL-OjhF0q7I8sx88ZRgEW7HsEIzq2MR7kaVN7fRzF8GaR7IGU-xIyrv3uXwwFlT1TItXhahAt-znftgssLf2as"/>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">Shoes</h3>
            </a>
            <a class="group" href="#">
                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200">
                    <img alt="Tennis Apparel" class="h-full w-full object-cover object-center transition-transform group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAMb6LBAJOl_M3uf2Qqd7HNC3LvOv81A_kZ3duI_FDS2Cd9oYGUyG6eqU-FTFb8nKjw8u_IyAnkg40U5aLGRN591nIJo4A5bCEibSA8eUjsHdztIFUDYJa0pqj3hazvS27ozR2-D__ouRvnXZd7ZHJLgHYgncFVBLr39c0Ae-lD_sVxOAfkohB10AtdXI-Xi7XXYgfrsDbipwXQYYFTcsyh2ccpQnGrqGXJv99whoNBO5PTR97V34fhVe0tL4jOWVUNCKYDwv6fWNk"/>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">Apparel</h3>
            </a>
            <a class="group" href="#">
                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200">
                    <img alt="Tennis Accessories" class="h-full w-full object-cover object-center transition-transform group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBBIBlro6iANCjvrhEJZc8lBfI4iwojnUmsL19K8ortZOtMsrIMWa1HehTGye5pg30Ta0iiddS96W4QiAdQFAziDkLvZJIhYIXNK0m2q7lyBj8wsmPprkmqJlc-s6NjBy2m2PWlH8MCxiL-51U1cLn5n1LeCi7kNyHv3tC7nvpYLkSJ96ulJoudAWTGAo6M-cj3PFpxntO3YgzIyemOpgEtBFclOJxRLDYGCQAr2QbpYT6H5ivv6pQ6d6X41T4yuHglXaowrV7DC18"/>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">Accessories</h3>
            </a>
        </div>
    </div>
</section>
<section class="py-16 sm:py-24 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 text-center">Featured Products</h2>
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            <!-- Product cards here (as in your provided code) -->
            <div class="group relative">
                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                    <img alt="Pro Racket" class="h-full w-full object-cover object-center lg:h-full lg:w-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBsnKPYue911DuUvdB2XXmO5yIYaorU0OyZu52nyGxFtZ2KocRo_M_3KdMvFxFi885H8autoV4HK1zsPvdfcZtdDKoHCS6EIH0Qqg2Ts1DkGbM995_9R1ITF-zcV6jcxkXNBSD24jfMWiaasOcbGqtIQK2mFlOTcSkyo5MiAmcbJnEXecehnAA1udkbMT7mdxnrPJt1EWftG-KMGRnsQbSgDZrQa_rx3aI0rOuEnHVG_7L5bbtJh6bfmd10W6Q3063EPH-LZtnayaw"/>
                </div>
                <div class="mt-4 flex justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900"><a href="#"><span aria-hidden="true" class="absolute inset-0"></span>Pro Racket</a></h3>
                        <p class="mt-1 text-sm text-gray-500">High-performance racket</p>
                    </div>
                    <p class="text-base font-bold text-gray-900">$199</p>
                </div>
            </div>
            <div class="group relative">
                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                    <img alt="Performance Shoes" class="h-full w-full object-cover object-center lg:h-full lg:w-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBtbfou-b4S9dRGy4NqHKdnPRW1zEAZDMXF61Kd9MdVmZVOXniGUo_tt46aoAgZlgxKI_axrebSDPR1wStqTQkV9s6_jcbOoOi0lW3xQW1NZC-2DZbS1tU3IDbQFycRORyLC_oqnje909z7L8KVh5sAtjJdJMOtynYooIJ9um_d_p6oyJmaqZQHQlLdhZyxhFV45VzPrf5ZuN0KLU41e2aWDSkNjAO4kp2lBAyQBZ181OS6IK-gQB9f1LvOs9Kjbxo0kJvRAoeg_58"/>
                </div>
                <div class="mt-4 flex justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900"><a href="#"><span aria-hidden="true" class="absolute inset-0"></span>Performance Shoes</a></h3>
                        <p class="mt-1 text-sm text-gray-500">Speed and agility</p>
                    </div>
                    <p class="text-base font-bold text-gray-900">$120</p>
                </div>
            </div>
            <div class="group relative">
                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                    <img alt="Activewear Collection" class="h-full w-full object-cover object-center lg:h-full lg:w-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCCsx90MBVZkeudVhAjr7beryTxVh1FsaGjJAJJeCCsoDbIH2DS6grUvxVGEr2zTb5LntbWlPv3vybfvaTa3ebPlXI4y219pbVa4Dyugd_JEVbcKkH4HxyLjrib5-JTOpEW1GIzxdaOwPrcdShGgtrhE7ijSaoGTbrLbw6tDwwa_bjtzP-qRnY_imzC6S5xCugPgGuy_7_GurDwI-HfqGSQxJ0m-JKzbgXRmAsXeU9p85aQDD4pbCyjpMrWtOO_HMfZfSH7i71zeoI"/>
                </div>
                <div class="mt-4 flex justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900"><a href="#"><span aria-hidden="true" class="absolute inset-0"></span>Activewear Top</a></h3>
                        <p class="mt-1 text-sm text-gray-500">Stylish and functional</p>
                    </div>
                    <p class="text-base font-bold text-gray-900">$65</p>
                </div>
            </div>
            <div class="group relative">
                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                    <img alt="Court Essentials" class="h-full w-full object-cover object-center lg:h-full lg:w-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBmwQFDbrFrM3GpJmIbyZYXOq4hgSo8m4gSIUxnj8qjufQ_zDX1WoCzn4it_yor_iL4_ZokE7gauwPMfdC8_Lr9zg8aXvECO6dpi2L5UfX3nSoo9cPlh0h4fj_iz_SzO1aA9Z7RK4QAHtKb9R5Grd6U4LyrqLTDwK53CzfgYQt2FeZKKp3Mzmw7xwZ72hq3i9sTC5aOWMRNN9gufuWRgmY-uVMtJj_9Wiu4C80o2lWbwzG-b2_4ttCI8edcGYaEftf-7_sBiu26LjQ"/>
                </div>
                <div class="mt-4 flex justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900"><a href="#"><span aria-hidden="true" class="absolute inset-0"></span>Tennis Balls (3-pack)</a></h3>
                        <p class="mt-1 text-sm text-gray-500">Durable and consistent</p>
                    </div>
                    <p class="text-base font-bold text-gray-900">$5</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Additional sections (Promotions, Top Brands, etc.) can be added here as in your provided code -->
@endsection
