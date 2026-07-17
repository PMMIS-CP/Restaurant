<a href="/spin" class="group block w-full bg-linear-to-r from-[#2a1a0a] via-[#3d2b14] to-[#2a1a0a] border-2 border-[#7b1a1a] hover:border-[#d4a017] rounded-2xl p-4 sm:p-6 shadow-[0_4px_30px_rgba(0,0,0,0.4),inset_0_0_15px_rgba(123,26,26,0.3)] hover:shadow-[0_0_35px_rgba(139,0,0,0.3),0_0_50px_rgba(212,160,23,0.2)] transition-all duration-500 hover:scale-[1.01] relative overflow-hidden">
    
    {{-- <!-- حاشیه تزئینی زرشکی و زرد سلطنتی --> --}}
    <div class="absolute inset-0 rounded-2xl border-2 border-[#d4a017]/50 pointer-events-none"></div>
    <div class="absolute inset-1 rounded-xl border border-[#7b1a1a]/30 pointer-events-none"></div>
    
    {{-- <!-- المان‌های تزئینی گوشه‌ها --> --}}
    <div class="absolute top-0 left-0 w-8 h-8 border-t-2 border-l-2 border-[#d4a017] rounded-tl-xl opacity-70"></div>
    <div class="absolute top-0 right-0 w-8 h-8 border-t-2 border-r-2 border-[#d4a017] rounded-tr-xl opacity-70"></div>
    <div class="absolute bottom-0 left-0 w-8 h-8 border-b-2 border-l-2 border-[#d4a017] rounded-bl-xl opacity-70"></div>
    <div class="absolute bottom-0 right-0 w-8 h-8 border-b-2 border-r-2 border-[#d4a017] rounded-br-xl opacity-70"></div>

    {{-- <!-- پس‌زمینه درخشان --> --}}
    <div class="absolute inset-0 opacity-15 pointer-events-none" aria-hidden="true">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-[#8b0000] rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-0 right-0 w-48 h-48 bg-[#d4a017] rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>

    {{-- <!-- موبایل: استک عمودی --> --}}
    <div class="flex flex-col items-center gap-4 relative z-10 sm:hidden">
        
        {{-- <!-- بخش گردونه --> --}}
        <div class="relative w-36 h-36 shrink-0 flex items-center justify-center">
            <div class="absolute inset-0 rounded-full bg-linear-to-br from-[#d4a017] via-[#8b0000] to-[#d4a017] p-1.5 shadow-[0_0_30px_rgba(139,0,0,0.5),0_0_50px_rgba(212,160,23,0.3)] animate-mini-border-glow">
                <div class="w-full h-full rounded-full bg-[#2a1a0a] p-1">
                    <div class="w-full h-full rounded-full bg-linear-to-tr from-[#8b0000] via-[#3d2b14] to-[#8b0000] p-0.5 shadow-inner relative">
                        
                        {{-- <!-- گردونه چرخان --> --}}
                        <div class="relative w-full h-full animate-promo-spin" style="transform-origin: center center;">
                            <svg viewBox="0 0 100 100" class="w-full h-full rounded-full shadow-2xl">
                                <defs>
                                    <radialGradient id="mobCrimson" cx="35%" cy="35%" r="65%">
                                        <stop offset="0%" stop-color="#ef4444" stop-opacity="0.9" />
                                        <stop offset="70%" stop-color="#8b0000" />
                                        <stop offset="100%" stop-color="#450a0a" />
                                    </radialGradient>
                                    <radialGradient id="mobGold" cx="30%" cy="30%" r="70%">
                                        <stop offset="0%" stop-color="#fef3c7" />
                                        <stop offset="40%" stop-color="#d4a017" />
                                        <stop offset="85%" stop-color="#8b6914" />
                                        <stop offset="100%" stop-color="#4a3000" />
                                    </radialGradient>
                                    <filter id="mobShadow">
                                        <feDropShadow dx="0.5" dy="0.5" stdDeviation="0.8" flood-color="#000" flood-opacity="0.6" />
                                    </filter>
                                    <radialGradient id="mobCenter" cx="50%" cy="50%" r="50%">
                                        <stop offset="0%" stop-color="#fef3c7" />
                                        <stop offset="60%" stop-color="#d4a017" />
                                        <stop offset="100%" stop-color="#4a3000" />
                                    </radialGradient>
                                </defs>

                                <path d="M50 50 L100 50 A50 50 0 0 1 85.36 85.36 Z" fill="url(#mobCrimson)" stroke="#d4a017" stroke-width="0.6" filter="url(#mobShadow)" />
                                <path d="M50 50 L85.36 85.36 A50 50 0 0 1 50 100 Z" fill="url(#mobGold)" stroke="#d4a017" stroke-width="0.6" filter="url(#mobShadow)" />
                                <path d="M50 50 L50 100 A50 50 0 0 1 14.64 85.36 Z" fill="url(#mobCrimson)" stroke="#d4a017" stroke-width="0.6" filter="url(#mobShadow)" />
                                <path d="M50 50 L14.64 85.36 A50 50 0 0 1 0 50 Z" fill="url(#mobGold)" stroke="#d4a017" stroke-width="0.6" filter="url(#mobShadow)" />
                                <path d="M50 50 L0 50 A50 50 0 0 1 14.64 14.64 Z" fill="url(#mobCrimson)" stroke="#d4a017" stroke-width="0.6" filter="url(#mobShadow)" />
                                <path d="M50 50 L14.64 14.64 A50 50 0 0 1 50 0 Z" fill="url(#mobGold)" stroke="#d4a017" stroke-width="0.6" filter="url(#mobShadow)" />
                                <path d="M50 50 L50 0 A50 50 0 0 1 85.36 14.64 Z" fill="url(#mobCrimson)" stroke="#d4a017" stroke-width="0.6" filter="url(#mobShadow)" />
                                <path d="M50 50 L85.36 14.64 A50 50 0 0 1 100 50 Z" fill="url(#mobGold)" stroke="#d4a017" stroke-width="0.6" filter="url(#mobShadow)" />

                                <circle cx="100" cy="50" r="1.3" fill="#d4a017" stroke="#fef3c7" stroke-width="0.3" class="animate-mini-blink" />
                                <circle cx="85.36" cy="85.36" r="1.3" fill="#d4a017" stroke="#fef3c7" stroke-width="0.3" class="animate-mini-blink" style="animation-delay: 0.2s" />
                                <circle cx="50" cy="100" r="1.3" fill="#d4a017" stroke="#fef3c7" stroke-width="0.3" class="animate-mini-blink" style="animation-delay: 0.4s" />
                                <circle cx="14.64" cy="85.36" r="1.3" fill="#d4a017" stroke="#fef3c7" stroke-width="0.3" class="animate-mini-blink" style="animation-delay: 0.6s" />
                                <circle cx="0" cy="50" r="1.3" fill="#d4a017" stroke="#fef3c7" stroke-width="0.3" class="animate-mini-blink" style="animation-delay: 0.8s" />
                                <circle cx="14.64" cy="14.64" r="1.3" fill="#d4a017" stroke="#fef3c7" stroke-width="0.3" class="animate-mini-blink" style="animation-delay: 1s" />
                                <circle cx="50" cy="0" r="1.3" fill="#d4a017" stroke="#fef3c7" stroke-width="0.3" class="animate-mini-blink" style="animation-delay: 1.2s" />
                                <circle cx="85.36" cy="14.64" r="1.3" fill="#d4a017" stroke="#fef3c7" stroke-width="0.3" class="animate-mini-blink" style="animation-delay: 1.4s" />

                                <circle cx="50" cy="50" r="12" fill="#1a0f05" stroke="#d4a017" stroke-width="1.5" filter="url(#mobShadow)" />
                                <circle cx="50" cy="50" r="10.5" fill="url(#mobCenter)" stroke="#fef3c7" stroke-width="0.8" />
                                <circle cx="50" cy="50" r="6" fill="#8b0000" stroke="#d4a017" stroke-width="0.8" />
                                <circle cx="50" cy="50" r="2" fill="#fef3c7" stroke="#8b6914" stroke-width="0.3" />
                                <circle cx="50" cy="41" r="1.2" fill="#fef3c7" opacity="0.9" />
                                <circle cx="50" cy="59" r="1.2" fill="#fef3c7" opacity="0.9" />
                                <circle cx="41" cy="50" r="1.2" fill="#fef3c7" opacity="0.9" />
                                <circle cx="59" cy="50" r="1.2" fill="#fef3c7" opacity="0.9" />
                            </svg>
                        </div>

                        {{-- <!-- عقربه --> --}}
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-30 pointer-events-none drop-shadow-[0_0_12px_rgba(212,160,23,0.9)]"
                             style="width: 26px; height: 32px; margin-top: -16px;">
                            <svg viewBox="0 0 40 50" class="w-full h-full">
                                <defs>
                                    <linearGradient id="mobNeedle" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" stop-color="#d4a017" />
                                        <stop offset="100%" stop-color="#8b0000" />
                                    </linearGradient>
                                </defs>
                                <path d="M20 2 L4 42 L36 42 Z" fill="url(#mobNeedle)" stroke="#fef3c7" stroke-width="0.8" />
                                <path d="M20 2 L9 42 L31 42 Z" fill="#ef4444" opacity="0.6" />
                                <circle cx="20" cy="42" r="5" fill="#fef3c7" stroke="#8b6914" stroke-width="0.8" />
                                <circle cx="20" cy="42" r="2.5" fill="#8b0000" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <!-- متن موبایل --> --}}
        <div class="text-center space-y-2 w-full">
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#8b0000]/20 border border-[#8b0000]/30 text-[#fef3c7] text-xs font-bold">
                <span class="w-2 h-2 rounded-full bg-[#d4a017] animate-ping"></span>
                {{ __('home.spinner.campaign_badge') }}
            </div>
            <h3 class="text-[#fef3c7] font-extrabold text-lg tracking-wide">
                {{ __('home.spinner.mobile.title') }}
            </h3>
            <p class="text-[#d4a017]/90 text-sm font-medium animate-promo-text">
                {{ __('home.spinner.mobile.promo_text') }}
            </p>
            <div class="pt-1">
                <span class="text-sm text-[#fef3c7]/80 font-bold inline-flex items-center gap-1.5">
                    {{ __('home.spinner.mobile.enter_text') }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </div>
        </div>
    </div>

    {{-- <!-- دسکتاپ: چیدمان فشرده با gap کمتر --> --}}
    <div class="hidden sm:flex sm:items-center sm:justify-center sm:gap-6 lg:gap-8 relative z-10">
        
        {{-- <!-- متن سمت راست --> --}}
        <div class="text-right space-y-1.5 shrink-0">
            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-[#8b0000]/20 border border-[#8b0000]/30 text-[#fef3c7] text-xs font-bold">
                <span class="w-1.5 h-1.5 rounded-full bg-[#d4a017] animate-ping"></span>
                 {{ __('home.spinner.campaign_badge') }}
            </div>
            <h3 class="text-[#fef3c7] font-extrabold text-lg lg:text-xl tracking-wide group-hover:text-[#d4a017] transition-colors duration-300 drop-shadow-[0_0_8px_rgba(139,0,0,0.5)]">
                {{ __('home.spinner.desktop.spinner_title') }}
            </h3>
            <p class="text-[#d4a017]/90 text-sm lg:text-base font-medium animate-promo-text">
                {{ __('home.spinner.desktop.spinner_promo') }}
            </p>
        </div>

        {{-- <!-- بخش گردونه --> --}}
        <div class="relative w-36 h-36 lg:w-44 lg:h-44 shrink-0 flex items-center justify-center">
            <div class="absolute inset-0 rounded-full bg-linear-to-br from-[#d4a017] via-[#8b0000] to-[#d4a017] p-1.5 shadow-[0_0_30px_rgba(139,0,0,0.5),0_0_50px_rgba(212,160,23,0.3)] animate-mini-border-glow">
                <div class="w-full h-full rounded-full bg-[#2a1a0a] p-1">
                    <div class="w-full h-full rounded-full bg-linear-to-tr from-[#8b0000] via-[#3d2b14] to-[#8b0000] p-0.5 shadow-inner relative">
                        
                        <div class="relative w-full h-full animate-promo-spin" style="transform-origin: center center;">
                            <svg viewBox="0 0 100 100" class="w-full h-full rounded-full shadow-2xl">
                                <defs>
                                    <radialGradient id="dtCrimson" cx="35%" cy="35%" r="65%">
                                        <stop offset="0%" stop-color="#ef4444" stop-opacity="0.9" />
                                        <stop offset="70%" stop-color="#8b0000" />
                                        <stop offset="100%" stop-color="#450a0a" />
                                    </radialGradient>
                                    <radialGradient id="dtGold" cx="30%" cy="30%" r="70%">
                                        <stop offset="0%" stop-color="#fef3c7" />
                                        <stop offset="40%" stop-color="#d4a017" />
                                        <stop offset="85%" stop-color="#8b6914" />
                                        <stop offset="100%" stop-color="#4a3000" />
                                    </radialGradient>
                                    <filter id="dtShadow">
                                        <feDropShadow dx="0.5" dy="0.5" stdDeviation="0.8" flood-color="#000" flood-opacity="0.6" />
                                    </filter>
                                    <radialGradient id="dtCenter" cx="50%" cy="50%" r="50%">
                                        <stop offset="0%" stop-color="#fef3c7" />
                                        <stop offset="60%" stop-color="#d4a017" />
                                        <stop offset="100%" stop-color="#4a3000" />
                                    </radialGradient>
                                </defs>

                                <path d="M50 50 L100 50 A50 50 0 0 1 85.36 85.36 Z" fill="url(#dtCrimson)" stroke="#d4a017" stroke-width="0.6" filter="url(#dtShadow)" />
                                <path d="M50 50 L85.36 85.36 A50 50 0 0 1 50 100 Z" fill="url(#dtGold)" stroke="#d4a017" stroke-width="0.6" filter="url(#dtShadow)" />
                                <path d="M50 50 L50 100 A50 50 0 0 1 14.64 85.36 Z" fill="url(#dtCrimson)" stroke="#d4a017" stroke-width="0.6" filter="url(#dtShadow)" />
                                <path d="M50 50 L14.64 85.36 A50 50 0 0 1 0 50 Z" fill="url(#dtGold)" stroke="#d4a017" stroke-width="0.6" filter="url(#dtShadow)" />
                                <path d="M50 50 L0 50 A50 50 0 0 1 14.64 14.64 Z" fill="url(#dtCrimson)" stroke="#d4a017" stroke-width="0.6" filter="url(#dtShadow)" />
                                <path d="M50 50 L14.64 14.64 A50 50 0 0 1 50 0 Z" fill="url(#dtGold)" stroke="#d4a017" stroke-width="0.6" filter="url(#dtShadow)" />
                                <path d="M50 50 L50 0 A50 50 0 0 1 85.36 14.64 Z" fill="url(#dtCrimson)" stroke="#d4a017" stroke-width="0.6" filter="url(#dtShadow)" />
                                <path d="M50 50 L85.36 14.64 A50 50 0 0 1 100 50 Z" fill="url(#dtGold)" stroke="#d4a017" stroke-width="0.6" filter="url(#dtShadow)" />

                                <circle cx="100" cy="50" r="1.3" fill="#d4a017" stroke="#fef3c7" stroke-width="0.3" class="animate-mini-blink" />
                                <circle cx="85.36" cy="85.36" r="1.3" fill="#d4a017" stroke="#fef3c7" stroke-width="0.3" class="animate-mini-blink" style="animation-delay: 0.2s" />
                                <circle cx="50" cy="100" r="1.3" fill="#d4a017" stroke="#fef3c7" stroke-width="0.3" class="animate-mini-blink" style="animation-delay: 0.4s" />
                                <circle cx="14.64" cy="85.36" r="1.3" fill="#d4a017" stroke="#fef3c7" stroke-width="0.3" class="animate-mini-blink" style="animation-delay: 0.6s" />
                                <circle cx="0" cy="50" r="1.3" fill="#d4a017" stroke="#fef3c7" stroke-width="0.3" class="animate-mini-blink" style="animation-delay: 0.8s" />
                                <circle cx="14.64" cy="14.64" r="1.3" fill="#d4a017" stroke="#fef3c7" stroke-width="0.3" class="animate-mini-blink" style="animation-delay: 1s" />
                                <circle cx="50" cy="0" r="1.3" fill="#d4a017" stroke="#fef3c7" stroke-width="0.3" class="animate-mini-blink" style="animation-delay: 1.2s" />
                                <circle cx="85.36" cy="14.64" r="1.3" fill="#d4a017" stroke="#fef3c7" stroke-width="0.3" class="animate-mini-blink" style="animation-delay: 1.4s" />

                                <circle cx="50" cy="50" r="12" fill="#1a0f05" stroke="#d4a017" stroke-width="1.5" filter="url(#dtShadow)" />
                                <circle cx="50" cy="50" r="10.5" fill="url(#dtCenter)" stroke="#fef3c7" stroke-width="0.8" />
                                <circle cx="50" cy="50" r="6" fill="#8b0000" stroke="#d4a017" stroke-width="0.8" />
                                <circle cx="50" cy="50" r="2" fill="#fef3c7" stroke="#8b6914" stroke-width="0.3" />
                                <circle cx="50" cy="41" r="1.2" fill="#fef3c7" opacity="0.9" />
                                <circle cx="50" cy="59" r="1.2" fill="#fef3c7" opacity="0.9" />
                                <circle cx="41" cy="50" r="1.2" fill="#fef3c7" opacity="0.9" />
                                <circle cx="59" cy="50" r="1.2" fill="#fef3c7" opacity="0.9" />
                            </svg>
                        </div>

                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-30 pointer-events-none drop-shadow-[0_0_12px_rgba(212,160,23,0.9)]"
                             style="width: 26px; height: 32px; margin-top: -16px;">
                            <svg viewBox="0 0 40 50" class="w-full h-full">
                                <defs>
                                    <linearGradient id="dtNeedle" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" stop-color="#d4a017" />
                                        <stop offset="100%" stop-color="#8b0000" />
                                    </linearGradient>
                                </defs>
                                <path d="M20 2 L4 42 L36 42 Z" fill="url(#dtNeedle)" stroke="#fef3c7" stroke-width="0.8" />
                                <path d="M20 2 L9 42 L31 42 Z" fill="#ef4444" opacity="0.6" />
                                <circle cx="20" cy="42" r="5" fill="#fef3c7" stroke="#8b6914" stroke-width="0.8" />
                                <circle cx="20" cy="42" r="2.5" fill="#8b0000" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <!-- متن سمت چپ --> --}}
        <div class="text-right space-y-1.5 shrink-0" dir="auto">
            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-[#8b0000]/20 border border-[#8b0000]/30 text-[#fef3c7] text-xs font-bold">
                <span class="w-1.5 h-1.5 rounded-full bg-[#d4a017] animate-ping"></span>
                {{ __('home.spinner.prizes_badge') }}
            </div>
            <h3 class="text-[#fef3c7] font-extrabold text-lg lg:text-xl tracking-wide group-hover:text-[#d4a017] transition-colors duration-300 drop-shadow-[0_0_8px_rgba(139,0,0,0.5)]">
                {{ __('home.spinner.desktop.prizes_title') }}
            </h3>
            <p class="text-[#d4a017]/90 text-sm lg:text-base font-medium">
                {{ __('home.spinner.desktop.prizes_promo') }}
            </p>
            <div class="pt-1 flex justify-start">
                <span class="text-xs lg:text-sm text-[#fef3c7]/80 group-hover:text-[#d4a017] font-bold inline-flex items-center gap-1 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 lg:h-4 lg:w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    {{ __('home.spinner.desktop.enter_text') }}
                </span>
            </div>
        </div>
    </div>
</a>

<style>
    @keyframes promo-spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .animate-promo-spin {
        animation: promo-spin 12s linear infinite;
    }

    @keyframes mini-border-glow {
        0%, 100% { 
            box-shadow: 0 0 25px rgba(139,0,0,0.4), 0 0 45px rgba(212,160,23,0.2); 
        }
        50% { 
            box-shadow: 0 0 40px rgba(139,0,0,0.7), 0 0 60px rgba(212,160,23,0.5); 
        }
    }
    .animate-mini-border-glow {
        animation: mini-border-glow 3s ease-in-out infinite;
    }

    @keyframes mini-blink {
        0%, 100% { opacity: 0.4; }
        50% { opacity: 1; filter: drop-shadow(0 0 4px #d4a017); }
    }
    .animate-mini-blink {
        animation: mini-blink 1.4s ease-in-out infinite;
    }

    @keyframes promo-text {
        0%, 100% { opacity: 0.8; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.03); color: #fef3c7; }
    }
    .animate-promo-text {
        animation: promo-text 2.5s ease-in-out infinite;
    }
</style>