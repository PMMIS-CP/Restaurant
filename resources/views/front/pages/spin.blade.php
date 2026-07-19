@extends('front.layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-linear-to-br from-zinc-900 via-[#1a0b0b] to-zinc-900 p-4 relative overflow-hidden"
     x-data="spinWheel({{ json_encode($prizes) }}, {{ $total }})">

    <div class="absolute inset-0 opacity-20 pointer-events-none" aria-hidden="true">
        <div class="absolute top-1/4 left-1/4 w-1 h-1 bg-yellow-400 rounded-full animate-float-slow"></div>
        <div class="absolute top-1/3 right-1/3 w-0.5 h-0.5 bg-yellow-300 rounded-full animate-float-medium" style="animation-delay: 0.5s;"></div>
        <div class="absolute bottom-1/4 left-1/2 w-1.5 h-1.5 bg-yellow-500 rounded-full animate-float-fast" style="animation-delay: 1.2s;"></div>
        <div class="absolute top-1/2 right-1/4 w-0.5 h-0.5 bg-red-400 rounded-full animate-float-medium" style="animation-delay: 0.3s;"></div>
        <div class="absolute bottom-1/3 left-1/3 w-1 h-1 bg-red-300 rounded-full animate-float-slow" style="animation-delay: 1.8s;"></div>
        <div class="absolute top-1/5 right-1/2 w-0.5 h-0.5 bg-yellow-200 rounded-full animate-float-fast" style="animation-delay: 0.7s;"></div>
    </div>

    <div class="relative w-88 h-88 md:w-100 md:h-100 flex items-center justify-center">
        <div class="absolute inset-0 rounded-full bg-linear-to-br from-yellow-600 via-red-800 to-yellow-700 p-1.5 shadow-[0_0_40px_rgba(220,38,38,0.5),0_0_80px_rgba(251,191,36,0.3)] animate-border-glow">
            <div class="w-full h-full rounded-full bg-[#1c0a0a] p-2">
                <div class="w-full h-full rounded-full bg-linear-to-tr from-red-950 via-zinc-900 to-red-950 p-1 shadow-inner relative">
                    
                    <div class="relative w-full h-full"
                         x-ref="wheel"
                         style="transform-origin: center center;">
                        <svg viewBox="0 0 100 100" class="w-full h-full rounded-full shadow-2xl">
                            <defs>
                                <radialGradient id="crimsonGloss" cx="35%" cy="35%" r="65%">
                                    <stop offset="0%" stop-color="#ef4444" stop-opacity="0.9" />
                                    <stop offset="70%" stop-color="#991b1b" />
                                    <stop offset="100%" stop-color="#450a0a" />
                                </radialGradient>
                                <radialGradient id="goldRoyal" cx="30%" cy="30%" r="70%">
                                    <stop offset="0%" stop-color="#fef08a" />
                                    <stop offset="40%" stop-color="#facc15" />
                                    <stop offset="85%" stop-color="#b45309" />
                                    <stop offset="100%" stop-color="#78350f" />
                                </radialGradient>
                                <filter id="segmentShadow">
                                    <feDropShadow dx="0.5" dy="0.5" stdDeviation="0.8" flood-color="#000" flood-opacity="0.6" />
                                </filter>
                                <radialGradient id="centerGlow" cx="50%" cy="50%" r="50%">
                                    <stop offset="0%" stop-color="#fef3c7" />
                                    <stop offset="60%" stop-color="#d97706" />
                                    <stop offset="100%" stop-color="#451a03" />
                                </radialGradient>
                            </defs>

                            @foreach($wheelData as $item)
                                <path d="M50 50 L{{ $item['x1'] }} {{ $item['y1'] }} A50 50 0 0 1 {{ $item['x2'] }} {{ $item['y2'] }} Z"
                                      fill="{{ $item['prize']['color'] ?? '#dc2626' }}"
                                      :stroke="activeSegmentIndex === {{ $loop->index }} ? '#ffffff' : '#fbbf24'"
                                      :stroke-width="activeSegmentIndex === {{ $loop->index }} ? '1.2' : '0.6'"
                                      filter="url(#segmentShadow)"
                                      :class="{ 
                                          'brightness-125 saturate-150 drop-shadow-lg z-10': activeSegmentIndex === {{ $loop->index }},
                                          'brightness-60 opacity-95': activeSegmentIndex !== {{ $loop->index }} 
                                      }"
                                      class="transition-all duration-75 ease-linear" />

                                <path d="M50 50 L{{ $item['x1'] }} {{ $item['y1'] }} A50 50 0 0 1 {{ $item['x2'] }} {{ $item['y2'] }} Z"
                                      fill="none"
                                      :stroke="activeSegmentIndex === {{ $loop->index }} ? '#ffffff' : '#fef3c7'"
                                      :stroke-width="activeSegmentIndex === {{ $loop->index }} ? '0.4' : '0.15'"
                                      :opacity="activeSegmentIndex === {{ $loop->index }} ? '0.9' : '0.5'"
                                      class="transition-all duration-75 ease-linear" />

                                {{-- حلقه نوری تزئینی در لبه قطعه --}}
                                <circle cx="{{ $item['lightX'] }}" cy="{{ $item['lightY'] }}" r="1.5"
                                        fill="{{ $item['prize']['color'] ?? '#fbbf24' }}"
                                        :stroke="activeSegmentIndex === {{ $loop->index }} ? '#ffffff' : '#fef3c7'"
                                        :stroke-width="activeSegmentIndex === {{ $loop->index }} ? '0.8' : '0.3'"
                                        :class="activeSegmentIndex === {{ $loop->index }} ? 'animate-pulse-glow brightness-150' : 'animate-blink'"
                                        class="transition-all duration-75 ease-linear"
                                        style="animation-delay: {{ $loop->index * 0.15 }}s;" />
                                        
                                <text x="{{ $item['textX'] }}" y="{{ $item['textY'] }}"
                                      :class="activeSegmentIndex === {{ $loop->index }} ? 'fill-yellow-200 text-[4px]' : 'fill-white text-[3.6px]'"
                                      class="font-extrabold select-none tracking-wider transition-all duration-75 ease-linear"
                                      text-anchor="middle"
                                      dominant-baseline="central"
                                      transform="rotate({{ $item['textRotation'] }}, {{ $item['textX'] }}, {{ $item['textY'] }})"
                                      style="text-shadow: 0px 0px 3px #000000, 0px 1px 2px #1a0a0a;">
                                    {{ $item['prize']['name'] }}
                                </text>
                            @endforeach

                            <circle cx="50" cy="50" r="49.5" fill="none" stroke="#fbbf24" stroke-width="0.3" opacity="0.6" />
                            <circle cx="50" cy="50" r="49.8" fill="none" stroke="#fef3c7" stroke-width="0.15" opacity="0.4" />

                            <circle cx="50" cy="50" r="11" fill="#0f0505" stroke="#fbbf24" stroke-width="1.2" filter="url(#segmentShadow)" />
                            <circle cx="50" cy="50" r="9.5" fill="url(#centerGlow)" stroke="#fef3c7" stroke-width="0.8" />
                            <circle cx="50" cy="50" r="5.5" fill="#dc2626" stroke="#fbbf24" stroke-width="0.6" />
                            <circle cx="50" cy="50" r="1.8" fill="#fef08a" stroke="#92400e" stroke-width="0.3" />
                            <circle cx="50" cy="42.5" r="1" fill="#fef3c7" opacity="0.9" />
                            <circle cx="50" cy="57.5" r="1" fill="#fef3c7" opacity="0.9" />
                            <circle cx="42.5" cy="50" r="1" fill="#fef3c7" opacity="0.9" />
                            <circle cx="57.5" cy="50" r="1" fill="#fef3c7" opacity="0.9" />
                        </svg>
                    </div>

                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-30 pointer-events-none drop-shadow-[0_0_20px_rgba(255,215,0,0.9)]"
                         style="width: 48px; height: 58px; margin-top: -29px;">
                        <svg width="48" height="58" viewBox="0 0 40 50" class="w-full h-full">
                            <defs>
                                <linearGradient id="needleGradFixed" x1="0%" y1="0%" x2="0%" y2="100%">
                                    <stop offset="0%" stop-color="#fbbf24" />
                                    <stop offset="100%" stop-color="#b45309" />
                                </linearGradient>
                                <filter id="needleGlowFixed">
                                    <feGaussianBlur stdDeviation="1.5" result="blur" />
                                    <feMerge>
                                        <feMergeNode in="blur" />
                                        <feMergeNode in="SourceGraphic" />
                                    </feMerge>
                                </filter>
                            </defs>
                            <path d="M20 2 L4 42 L36 42 Z" fill="url(#needleGradFixed)" stroke="#fbbf24" stroke-width="0.8" filter="url(#needleGlowFixed)" />
                            <path d="M20 2 L9 42 L31 42 Z" fill="#dc2626" opacity="0.7" />
                            <circle cx="20" cy="42" r="4" fill="#fef3c7" stroke="#92400e" stroke-width="0.8" />
                            <circle cx="20" cy="42" r="2" fill="#dc2626" />
                        </svg>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <button @click="spin()"
            :disabled="spinning"
            class="mt-10 px-10 py-4 bg-linear-to-r from-yellow-600 via-red-700 to-yellow-700 text-white rounded-full font-bold text-lg shadow-[0_0_30px_rgba(220,38,38,0.6)] 
                   hover:shadow-[0_0_50px_rgba(251,191,36,0.8)] hover:scale-105 transition-all duration-300 ease-out
                   disabled:opacity-60 disabled:cursor-not-allowed disabled:hover:scale-100 disabled:hover:shadow-[0_0_30px_rgba(220,38,38,0.6)]
                   border border-yellow-400/60 tracking-widest uppercase relative overflow-hidden group">
        <span class="relative z-10 flex items-center gap-2">
            <span x-text="spinning ? '{{ __("spin.spinning") }}' : '{{ __("spin.spin_button") }}'"></span>
            <svg x-show="!spinning" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-pulse-fast" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            <svg x-show="spinning" class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </span>
        <div class="absolute inset-0 bg-linear-to-r from-transparent via-yellow-300/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-in-out"></div>
    </button>

    <div class="mt-6 flex gap-3 opacity-40">
        <div class="w-1.5 h-1.5 bg-yellow-400 rounded-full shadow-[0_0_8px_#fbbf24] animate-pulse-slow"></div>
        <div class="w-1.5 h-1.5 bg-red-500 rounded-full shadow-[0_0_8px_#dc2626] animate-pulse-medium" style="animation-delay: 0.3s;"></div>
        <div class="w-1.5 h-1.5 bg-yellow-400 rounded-full shadow-[0_0_8px_#fbbf24] animate-pulse-slow" style="animation-delay: 0.6s;"></div>
    </div>
</div>

<style>
    @keyframes float-slow {
        0%, 100% { transform: translateY(0) scale(1); opacity: 0.2; }
        50% { transform: translateY(-15px) scale(1.3); opacity: 0.5; }
    }
    @keyframes float-medium {
        0%, 100% { transform: translateY(0) scale(1); opacity: 0.15; }
        50% { transform: translateY(-20px) scale(1.4); opacity: 0.6; }
    }
    @keyframes float-fast {
        0%, 100% { transform: translateY(0) scale(1); opacity: 0.2; }
        50% { transform: translateY(-25px) scale(1.2); opacity: 0.7; }
    }
    @keyframes border-glow {
        0%, 100% { box-shadow: 0 0 40px rgba(220,38,38,0.5), 0 0 80px rgba(251,191,36,0.3); }
        50% { box-shadow: 0 0 60px rgba(220,38,38,0.7), 0 0 100px rgba(251,191,36,0.5); }
    }
    @keyframes pulse-glow {
        0%, 100% { opacity: 0.6; transform: scale(0.8); filter: drop-shadow(0 0 2px currentColor); }
        50% { opacity: 1; transform: scale(1.3); filter: drop-shadow(0 0 6px currentColor); }
    }
    @keyframes pulse-slow {
        0%, 100% { opacity: 0.5; transform: scale(0.9); }
        50% { opacity: 1; transform: scale(1.2); }
    }
    @keyframes pulse-medium {
        0%, 100% { opacity: 0.6; transform: scale(0.9); }
        50% { opacity: 1; transform: scale(1.15); }
    }
    .animate-float-slow { animation: float-slow 4s ease-in-out infinite; }
    .animate-float-medium { animation: float-medium 3.5s ease-in-out infinite; }
    .animate-float-fast { animation: float-fast 3s ease-in-out infinite; }
    .animate-border-glow { animation: border-glow 3s ease-in-out infinite; }
    .animate-pulse-slow { animation: pulse-slow 2.5s ease-in-out infinite; }
    .animate-pulse-medium { animation: pulse-medium 2s ease-in-out infinite; }
    .animate-pulse-fast { animation: pulse-medium 1.2s ease-in-out infinite; }
    @keyframes blink {
        0%, 100% {
            opacity: 0.25;
            filter: drop-shadow(0 0 1px currentColor);
        }
        50% {
            opacity: 1;
            filter: drop-shadow(0 0 5px currentColor);
        }
    }
    .animate-blink { animation: blink 1.4s ease-in-out infinite; }
</style>
<script>
    window.translations = {
        congratulations: '{{ __("spin.congratulations") }}',
        youWon: '{{ __("spin.you_won") }}'
    };
</script>
@endsection