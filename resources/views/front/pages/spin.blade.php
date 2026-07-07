@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 p-4"
     x-data="spinWheel">

    <div class="z-10 -mb-6">
        <svg width="40" height="50" viewBox="0 0 40 50">
            <path d="M20 50 L0 0 L40 0 Z" class="fill-red-600" />
        </svg>
    </div>

    <div class="relative w-80 h-80 md:w-96 md:h-96"
         x-ref="wheel"
         style="transform-origin: center center;">
        <svg viewBox="0 0 100 100" class="w-full h-full rounded-full shadow-2xl">
            @foreach($wheelData as $item)
                <path d="M50 50 L{{ $item['x1'] }} {{ $item['y1'] }} A50 50 0 0 1 {{ $item['x2'] }} {{ $item['y2'] }} Z"
                      fill="{{ $item['prize']['color'] ?? '#3b82f6' }}"
                      stroke="#ffffff"
                      stroke-width="0.5" />

                <text x="{{ $item['textX'] }}" y="{{ $item['textY'] }}"
                      class="text-[3.5px] font-bold fill-white select-none"
                      text-anchor="middle"
                      dominant-baseline="central"
                      transform="rotate({{ $item['textRotation'] }}, {{ $item['textX'] }}, {{ $item['textY'] }})">
                    {{ $item['prize']['name'] }}
                </text>
            @endforeach

            <circle cx="50" cy="50" r="10" fill="white" stroke="#d1d5db" stroke-width="1.5"/>
            <circle cx="50" cy="50" r="5" fill="#ef4444"/>
        </svg>
    </div>

    <button @click="spin()"
            :disabled="spinning"
            class="mt-12 px-8 py-3 bg-indigo-600 text-white rounded-full font-bold shadow-lg
                   hover:bg-indigo-700 transition-all duration-200
                   disabled:opacity-50 disabled:cursor-not-allowed">
        <span x-text="spinning ? 'در حال چرخش...' : 'شروع چرخش'"></span>
    </button>
</div>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('spinWheel', () => ({
            spinning: false,
            currentRotation: 0,
            prizes: @json($prizes),
            sliceAngle: 360 / @json($total),

            spin() {
                if (this.spinning) return;
                this.spinning = true;

                const randomStopAngle = Math.random() * 360;

                const fullSpins = (5 + Math.floor(Math.random() * 4)) * 360;
                
                const rawFinalRotation = this.currentRotation + fullSpins + randomStopAngle;

                gsap.to(this.$refs.wheel, {
                    rotation: rawFinalRotation,
                    duration: 30,
                    ease: 'power4.out',
                    onComplete: () => {
                        const stoppedAngle = (360 - (rawFinalRotation % 360)) % 360;
                        
                        const winnerIndex = Math.floor(stoppedAngle / this.sliceAngle);
                        const winner = this.prizes[winnerIndex];

                        const targetCenterAngle = (winnerIndex * this.sliceAngle) + (this.sliceAngle / 2);
                        
                        const targetRotationForCenter = (360 - targetCenterAngle) % 360;
                        
                        let fullRotations = Math.floor(rawFinalRotation / 360) * 360;
                        let adjustedTarget = fullRotations + targetRotationForCenter;
                        
                        if (adjustedTarget < rawFinalRotation) {
                            adjustedTarget += 360;
                        }
                        
                        const diff = adjustedTarget - rawFinalRotation;
                        if (diff > 180) {
                            adjustedTarget -= 360;
                        }

                        gsap.to(this.$refs.wheel, {
                            rotation: adjustedTarget,
                            duration: 0.4,
                            ease: 'power3.out',
                            onComplete: () => {
                                this.currentRotation = adjustedTarget % 360;
                                
                                gsap.set(this.$refs.wheel, { rotation: this.currentRotation });
                                
                                this.spinning = false;
                                
                                setTimeout(() => {
                                    alert('🎉 تبریک! شما برنده شدید: ' + winner.name);
                                }, 100);
                            }
                        });
                    }
                });
            }
        }));
    });
</script>
@endsection