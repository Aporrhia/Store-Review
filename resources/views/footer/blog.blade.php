@extends('layouts.app')

@section('title', 'Tennis Blog - Tenama')

@section('content')
<div class="relative flex size-full min-h-screen flex-col overflow-x-hidden group/design-root bg-white">
    <div class="flex h-full grow flex-col">
        <main class="flex flex-1">
            <div class="flex-1 p-8">
                <div class="mx-auto max-w-4xl">
                    <div class="mb-8">
                        <nav class="text-sm text-gray-500">
                            <a href="{{ route('home') }}" class="hover:text-gray-700">Home</a>
                            <span class="mx-2">/</span>
                            <span class="text-gray-900">Blog</span>
                        </nav>
                    </div>
                    
                    <h1 class="text-4xl font-extrabold tracking-tight text-[#141414] mb-8">Tennis Blog</h1>
                    <p class="text-lg text-gray-600 mb-12">Stay updated with the latest tennis news, tournament highlights, and equipment insights.</p>
                    
                    <div class="space-y-16">
                        <!-- Article 1: Wimbledon 2025 -->
                        <article class="border-b border-gray-200 pb-16">
                            <div class="mb-6">
                                <img src="{{ asset('images/blog/wimbledon_2025.png') }}" alt="Wimbledon 2025 Final" class="w-full h-64 md:h-80 object-cover rounded-lg">
                            </div>
                            <div class="mb-4">
                                <span class="inline-block bg-lime-100 text-lime-800 text-sm font-medium px-3 py-1 rounded-full">Tournament Recap</span>
                                <span class="text-gray-500 text-sm ml-4">July 13, 2025</span>
                            </div>
                            <h2 class="text-3xl font-bold text-[#141414] mb-4">Epic Showdowns Crown New Grass-Court Kings at Wimbledon 2025</h2>
                            <p class="text-lg text-gray-600 mb-6">The 2025 Wimbledon Championships wrapped up on July 13 with two unforgettable finals that showcased the sport's thrilling unpredictability.</p>
                            
                            <div class="prose prose-lg max-w-none text-gray-700">
                                <p>Under the iconic Centre Court roof—thanks to automated line judges and later start times—the grass-court Slam delivered historic triumphs amid upsets galore. The tournament proved to be a wildcard affair that crowned a new era of stars.</p>
                                
                                <h3 class="text-xl font-semibold text-[#141414] mt-6 mb-3">Women's Final: Świątek's Perfect Performance</h3>
                                <p>In the women's singles, world No. 3 Iga Świątek dismantled American Amanda Anisimova 6-0, 6-0 in a match lasting just over an hour, marking the most dominant final in 114 years. This "double bagel" was only the third in major history, propelling Świątek to her sixth Grand Slam title and first on grass.</p>
                                
                                <p>The Pole, who had struggled earlier in 2025, became the first Polish Wimbledon champion and the eighth woman in the Open Era to conquer all three surfaces. Anisimova, reaching her first major final after a gritty run, couldn't breach Świątek's impenetrable defense.</p>
                                
                                <h3 class="text-xl font-semibold text-[#141414] mt-6 mb-3">Men's Final: Sinner's Breakthrough</h3>
                                <p>The men's final was a five-setter for the ages: world No. 1 Jannik Sinner edged two-time defending champ Carlos Alcaraz 4-6, 6-4, 6-4, 6-4. The 23-year-old Italian claimed his first Wimbledon crown—and fourth major overall—snapping Alcaraz's perfect 5-0 record in Slam finals.</p>
                                
                                <p>Sinner, the youngest to reach four straight major finals in the Open Era, joined Federer-Nadal as one of few rivalries dominating both French Open and Wimbledon in the same year. Alcaraz, just 22, fought valiantly but couldn't overcome Sinner's baseline precision.</p>
                                
                                <h3 class="text-xl font-semibold text-[#141414] mt-6 mb-3">Tournament Highlights</h3>
                                <ul class="list-disc pl-6 space-y-2">
                                    <li>Eight top-10 seeds crashed out in Round 1—the most ever in tournament history</li>
                                    <li>Prize money hit a record £53.55 million, reflecting the sport's growing prestige</li>
                                    <li>Automated line judges and later start times created a new tournament atmosphere</li>
                                    <li>The tournament showcased unprecedented upsets and breakthrough performances</li>
                                </ul>
                                
                                <h3 class="text-xl font-semibold text-[#141414] mt-6 mb-3">Equipment Spotlight</h3>
                                <p>The grass court conditions at Wimbledon 2025 demanded exceptional equipment choices from both champions. Świątek's dominant performance was aided by her carefully selected racket setup, optimized for grass court precision and power. Similarly, Sinner's five-set victory over Alcaraz highlighted the importance of reliable equipment during marathon matches.</p>
                                
                                <p>"The grass courts at Wimbledon are unique," noted Sinner after his victory. "Having equipment you completely trust becomes even more crucial when every point matters. The right string tension and grip can make the difference between a winner and an error on this surface."</p>
                                
                                <p>Wimbledon 2025 proved to be a tournament where underdogs dreamed big and new legends were born, setting the stage for an exciting new chapter in tennis history.</p>
                            </div>
                            
                            <div class="mt-8 flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <span class="text-sm text-gray-500">By Tenama Editorial Team</span>
                                </div>
                            </div>
                        </article>

                        <!-- Article 2: US Open 2025 -->
                        <article class="border-b border-gray-200 pb-16">
                            <div class="mb-6">
                                <img src="{{ asset('images/blog/2025_US_Open_Final.png') }}" alt="US Open 2025 Final" class="w-full h-64 md:h-80 object-cover rounded-lg">
                            </div>
                            <div class="mb-4">
                                <span class="inline-block bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">Grand Slam</span>
                                <span class="text-gray-500 text-sm ml-4">September 8, 2025</span>
                            </div>
                            <h2 class="text-3xl font-bold text-[#141414] mb-4">Hard-Court Drama Peaks at US Open 2025: Alcaraz and Sabalenka Reign Supreme</h2>
                            <p class="text-lg text-gray-600 mb-6">The 2025 US Open slammed to a close on September 8 with finals that blended power, resilience, and redemption on the hard courts of Flushing Meadows.</p>
                            
                            <div class="prose prose-lg max-w-none text-gray-700">
                                <p>Amid buzzing crowds and record attendance under the lights, the final Grand Slam of the year highlighted a shifting guard in tennis, with prize money soaring to a historic $75 million. The tournament showcased both defending champions and rising stars in dramatic fashion.</p>
                                
                                <h3 class="text-xl font-semibold text-[#141414] mt-6 mb-3">Women's Final: Sabalenka's Successful Defense</h3>
                                <p>In the women's singles showdown, defending champion Aryna Sabalenka (1) outlasted surging American Amanda Anisimova (8) 6-3, 7-6(7-3), securing her second straight US Open title and fourth major overall. The Belarusian powerhouse, who had fallen short in the Australian Open and French Open finals earlier in 2025, unleashed her signature aggression to become the first woman to defend the title since Serena Williams in 2014.</p>
                                
                                <p>Anisimova, the 24-year-old Wimbledon runner-up, fought back fiercely in a tense second-set tiebreak but couldn't topple Sabalenka's serve, vaulting to a career-high No. 4 ranking in the process. The match showcased two different styles of power tennis, with Sabalenka's consistency ultimately prevailing over Anisimova's explosive shot-making.</p>
                                
                                <h3 class="text-xl font-semibold text-[#141414] mt-6 mb-3">Men's Final: Alcaraz Reclaims the Crown</h3>
                                <p>The men's final was a four-set thriller: Carlos Alcaraz (2) toppled defending champ Jannik Sinner (1) 6-2, 3-6, 6-1, 6-4, claiming his second US Open crown and sixth major at age 22. The Spaniard regained the world No. 1 spot, edging out Sinner in their third major final of the year—the first such duo in the Open Era.</p>
                                
                                <p>Sinner, the youngest to reach five straight Slam finals, mounted a comeback in set two but faltered against Alcaraz's explosive variety, marking a poignant end to the Big Three's major dominance. The match demonstrated the evolution of men's tennis, with both players showcasing incredible athleticism and shot-making ability.</p>
                                
                                <h3 class="text-xl font-semibold text-[#141414] mt-6 mb-3">Tournament Highlights</h3>
                                <ul class="list-disc pl-6 space-y-2">
                                    <li>Prize money reached a historic $75 million, the highest in tournament history</li>
                                    <li>Venus Williams' emotional farewell wildcard run captured hearts worldwide</li>
                                    <li>Petra Kvitová's final tournament appearance marked the end of an era</li>
                                    <li>First-round seed massacre rivaled Wimbledon's chaos with multiple upsets</li>
                                    <li>Record attendance throughout the two-week tournament</li>
                                </ul>
                                
                                <h3 class="text-xl font-semibold text-[#141414] mt-6 mb-3">Equipment Spotlight</h3>
                                <p>The hard courts of the US Open demanded exceptional equipment choices from both champions. Sabalenka's powerful baseline game required rackets strung for maximum control, while her serve benefited from slightly looser tension for added power. Alcaraz's versatile playing style showcased the importance of having equipment that can adapt to different situations within a single match.</p>
                                
                                <p>The champion's equipment team emphasized the crucial role of backup rackets, especially given the humidity and temperature variations during evening matches at Flushing Meadows. "The US Open hard courts are unforgiving," explained Alcaraz after his victory. "Every detail in your equipment setup matters when you're competing at this level. The right racket and strings can make the difference between a winner and an error."</p>
                                
                                <p>US Open 2025 proved to be a tournament where hard courts hardened resolve and new icons emerged, setting the stage for an exciting future in professional tennis.</p>
                            </div>
                            
                            <div class="mt-8 flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <span class="text-sm text-gray-500">By Tenama Editorial Team</span>
                                </div>
                            </div>
                        </article>

                        <!-- Newsletter Signup -->
                        <div class="bg-gray-50 rounded-lg p-8 text-center">
                            <h3 class="text-2xl font-bold text-[#141414] mb-4">Stay Updated</h3>
                            <p class="text-gray-600 mb-6">Subscribe to our newsletter for the latest tennis news, equipment reviews, and tournament coverage.</p>
                            <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                                <input type="email" placeholder="Enter your email" class="flex-1 rounded-md border-gray-300 px-4 py-2 focus:ring-2 focus:ring-lime-500 focus:border-lime-500">
                                <button class="bg-lime-500 text-gray-900 px-6 py-2 rounded-md font-medium hover:bg-lime-400 transition-colors">
                                    Subscribe
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
