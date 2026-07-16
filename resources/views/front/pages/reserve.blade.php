@extends('front.layouts.app')
@section('title', 'رزرو')
@section('content')
@include('front.components.reserveheader')
{{-- استایل‌ها و اسکریپت‌ها --}}
<style>
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus {
 -webkit-box-shadow: 0 0 0px 1000px transparent inset !important;
 -webkit-text-fill-color: #1a1a1a !important;
 transition: background-color 5000s ease-in-out 0s;
}
</style>
<style>
.ripple-effect {
  position: relative;
  overflow: hidden;
  -webkit-tap-highlight-color: transparent;
}

.ripple-effect .ripple {
  position: absolute;
  border-radius: 50%;
  background-color: rgba(220, 38, 38, 0.2);
  transform: scale(0);
  animation: ripple-animation 0.1s ease-out;
  pointer-events: none;
}

@keyframes ripple-animation {
  to {
    transform: scale(4);
    opacity: 0;
  }
}
</style>

{{-- نسخه دسکتاپ --}}
<form action="{{ route('reserve.store') }}" method="POST" id="reserve-form" 
      onsubmit="event.preventDefault(); window.handleSubmit(event); return false;">
    @csrf
    
    {{-- فیلدهای مخفی یکتا - فقط یک نسخه از هر کدام --}}
    <input type="hidden" id="reservation_date_input" value="">
    <input type="hidden" id="entry_time_input" value="">
    <input type="hidden" id="exit_time_input" value="">
    <input type="hidden" id="guest_count_input" value="">
    <input type="hidden" id="event_type_input" value="">
    <input type="hidden" id="description_input" x-model="$store.reserveForm.description">

<div class="hidden lg:block relative min-h-screen w-full bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/images/21.webp') }}');">
    <div class="absolute inset-0 bg-amber-50/80 backdrop-blur-[2px]"
         style="mask-image: radial-gradient(ellipse 70% 70% at 50% 50%, black 60%, transparent 100%);
         -webkit-mask-image: radial-gradient(ellipse 70% 70% at 50% 50%, black 60%, transparent 100%);">
    </div>
    
    <div class="relative flex items-center justify-center min-h-screen p-4 md:p-8">
        <div class="relative w-full max-w-7xl mx-auto rounded-3xl p-4 md:p-6" style="aspect-ratio: 1843.22 / 706.24;">

            {{-- متن هشدار --}}
            <div class="flex flex-col gap-1 md:gap-2">
                <div class="absolute inset-0 w-full h-full pointer-events-none"></div>
                
                <div class="absolute hidden md:flex animate-pulse border-2 border-red-600/50 bg-red-50/10 px-4 py-2 rounded-full items-center justify-center translate-y-2 overflow-hidden" 
                    style="left: 44.7%; top: -9.5%; width: 55%;">
                    
                    <p class="text-red-600 font-bold leading-tight whitespace-nowrap text-[8px] sm:text-[13px] md:text-[12px] lg:text-[14.5px]"
                    style="text-shadow: 0 0 5px rgba(220, 38, 38, 0.3);">
                        فرم زیر را برای درخواست رزرو در کاخ موراکو تکمیل کنید (رزرو قطعی نیست). کارشناسان ما برای نهایی‌سازی تماس می‌گیرند.
                    </p>
                </div>
            </div>

            <div class="flex flex-col">
                <div class="absolute w-full h-full">
                    {{-- بخش اول --}}
                    <div class="flex flex-row gap-1 md:gap-3 w-full">
                        <div x-data="formAnimation">
                            {{-- ایمیل --}}
                            <div class="flex flex-col flex-1 min-w-0">
                                <label for="email" class="absolute text-right font-bold" 
                                       style="left: 48.65%; top: calc(7.32% - 14px); width: 16.58%; font-size: clamp(8px, 1.2vw, 14px); color: #B8860B; text-shadow: 0 0 8px rgba(184, 134, 11, 0.3);">
                                    ایمیل:
                                </label>
                                <div class="absolute" style="left: 48.65%; top: 7.32%; width: 16.58%; height: 57px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute">
                                        <rect class="light-rect-input fill-white/40 stroke-red-600 stroke-[2.5] [stroke-miterlimit:10] filter drop-shadow-[0_2px_8px_rgba(220,38,38,0.15)] transition-all duration-300 ease hover:stroke-[#0022ff] hover:drop-shadow-[0_4px_12px_rgba(184,134,11,0.2)]" 
                                              x="0" y="0" width="305.61" height="57.14" rx="12" ry="12"/>
                                    </svg>
                                    <input type="email" id="email" placeholder="مثال: example@email.com" 
                                           @focus="triggerAnimation($el.parentElement)"
                                           class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-2 md:px-4 text-right font-normal text-[10px] sm:text-xs md:text-sm placeholder-gray-400"
                                           style="color: #1a1a1a;"
                                           x-model="$store.reserveForm.email">
                                </div>
                            </div>

                            {{-- شماره تماس --}}
                            <div class="flex flex-col flex-1 min-w-0">
                                <label for="phone" class="absolute text-right font-bold" 
                                       style="left: 66.02%; top: calc(7.32% - 14px); width: 16.58%; font-size: clamp(8px, 1.2vw, 14px); color: #B8860B; text-shadow: 0 0 8px rgba(184, 134, 11, 0.3);">
                                    شماره تماس:
                                </label>
                                <div class="absolute" style="left: 66.02%; top: 7.32%; width: 16.58%; height: 57px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute">
                                        <rect class="light-rect-input fill-white/40 stroke-red-600 stroke-[2.5] [stroke-miterlimit:10] filter drop-shadow-[0_2px_8px_rgba(220,38,38,0.15)] transition-all duration-300 ease hover:stroke-[#0022ff] hover:drop-shadow-[0_4px_12px_rgba(184,134,11,0.2)]" 
                                              x="0" y="0" width="305.61" height="57.14" rx="12" ry="12"/>
                                    </svg>
                                    <input type="tel" id="phone" placeholder="مثال: 09123456789" 
                                           @focus="triggerAnimation($el.parentElement)"
                                           class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-2 md:px-4 text-right font-normal text-[10px] sm:text-xs md:text-sm placeholder-gray-400"
                                           style="color: #1a1a1a;"
                                           x-model="$store.reserveForm.phone">
                                </div>
                            </div>

                            {{-- نام و نام خانوادگی --}}
                            <div class="flex flex-col flex-1 min-w-0">
                                <label for="name" class="absolute text-right font-bold" 
                                       style="left: 83.39%; top: calc(7.32% - 14px); width: 16.58%; font-size: clamp(8px, 1.2vw, 14px); color: #B8860B; text-shadow: 0 0 8px rgba(184, 134, 11, 0.3);">
                                    نام و نام خانوادگی:
                                </label>
                                <div class="absolute" style="left: 83.39%; top: 7.32%; width: 16.58%; height: 57px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute">
                                        <rect class="light-rect-input fill-white/40 stroke-red-600 stroke-[2.5] [stroke-miterlimit:10] filter drop-shadow-[0_2px_8px_rgba(220,38,38,0.15)] transition-all duration-300 ease hover:stroke-[#0022ff] hover:drop-shadow-[0_4px_12px_rgba(184,134,11,0.2)]" 
                                              x="0" y="0" width="305.61" height="57.14" rx="12" ry="12"/>
                                    </svg>
                                    <input type="text" id="name" placeholder="مثال: علی رضایی" 
                                           @focus="triggerAnimation($el.parentElement)"
                                           class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-2 md:px-4 text-right font-normal text-[10px] sm:text-xs md:text-sm placeholder-gray-400"
                                           style="color: #1a1a1a;"
                                           x-model="$store.reserveForm.name">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- بخش دوم --}}
                    <div class="flex flex-row gap-1 md:gap-3 w-full mt-1 md:mt-2">
                        <div class="flex flex-col flex-1 min-w-0" 
                            x-data="confirmationComponent"
                            x-on:date-confirmed.window="confirmedDate = $event.detail.date"
                            x-on:entry-time-confirmed.window="confirmedEntryTime = $event.detail.time"
                            x-on:exit-time-confirmed.window="confirmedExitTime = $event.detail.time">

                            {{-- فیلدهای مخفی برای ارسال به بک‌اند --}}
                            <input type="hidden" x-model="confirmedDate">
                            <input type="hidden" x-model="confirmedEntryTime">
                            <input type="hidden" x-model="confirmedExitTime">

                            <label class="absolute text-right font-bold" 
                                style="left: 48.65%; top: calc(21.18% - 14px); width: 16.58%; font-size: clamp(8px, 1.2vw, 14px); color: #B8860B; text-shadow: 0 0 8px rgba(184, 134, 11, 0.3);">
                                تاریخ و ساعت ثبت شده:
                            </label>

                            <div class="absolute cursor-pointer" 
                                style="left: 48.65%; top: 21.18%; width: 16.58%; height: 57px;"
                                x-on:click="triggerAnimation($el)">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full absolute overflow-visible">
                                    <rect class="fill-white/40 stroke-red-600 stroke-[2.5] [stroke-miterlimit:10] filter drop-shadow-[0_2px_8px_rgba(220,38,38,0.15)] transition-all duration-300 ease hover:stroke-[#0022ff] hover:drop-shadow-[0_4px_12px_rgba(184,134,11,0.2)]" x="0" y="0" width="305.61" height="57.14" rx="12" ry="12" fill="transparent"/>
                                    <rect class="light-rect" x="0" y="0" width="305.61" height="57.14" rx="12" ry="12" fill="none" stroke="#ff0061" stroke-width="6" stroke-dasharray="100 629.22" style="opacity: 0;"/>
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center text-[10px] sm:text-[12px] md:text-[14px] font-medium pointer-events-none px-2"
                                    x-text="displayText" style="color: #1a1a1a;">
                                </div>
                            </div>
                        </div>

                        {{-- تعداد نفرات --}}
                        <div class="flex flex-col flex-1 min-w-0 custom-dropdown-container" data-type="guest">
                            <label class="absolute text-right font-bold" 
                                   style="left: 66.02%; top: calc(21.18% - 14px); width: 16.58%; font-size: clamp(8px, 1.2vw, 14px); color: #B8860B; text-shadow: 0 0 8px rgba(184, 134, 11, 0.3);">
                                تعداد مهمان:
                            </label>
                            <div class="absolute" style="left: 66.02%; top: 21.18%; width: 16.58%; height: 57px;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute z-10">
                                    <rect class="fill-white/40 stroke-red-600 stroke-[2.5] [stroke-miterlimit:10] filter drop-shadow-[0_2px_8px_rgba(220,38,38,0.15)] transition-all duration-300 ease hover:stroke-[#0022ff] hover:drop-shadow-[0_4px_12px_rgba(184,134,11,0.2)]" x="0" y="0" width="305.61" height="57.14" rx="12" ry="12"/>
                                </svg>
                                <button type="button" class="dropdown-trigger absolute inset-0 w-full h-full bg-transparent border-none outline-none px-4 text-right cursor-pointer flex items-center justify-between text-[10px] sm:text-xs md:text-sm text-gray-400 z-20">
                                    <span class="selected-text">تعداد را وارد کنید</span>
                                    <svg class="w-4 h-4 text-[#B8860B] transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                <ul class="dropdown-menu hidden absolute top-[110%] left-0 w-full bg-white/90 backdrop-blur-md border border-gray-200/50 rounded-xl shadow-[0_10px_30px_rgba(0,0,0,0.08)] overflow-hidden transition-all duration-300 z-50 text-right text-[10px] sm:text-xs md:text-sm max-h-60 overflow-y-auto">
                                    <li data-value="1-4" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150">۱ تا ۴ نفر</li>
                                    <li data-value="5-10" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">۵ تا ۱۰ نفر</li>
                                    <li data-value="25-50" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">۲۵ تا ۵۰ نفر</li>
                                    <li data-value="50-100" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">۵۰ تا ۱۰۰ نفر</li>
                                </ul>
                            </div>
                        </div>

                        {{-- نوع مراسم --}}
                        <div class="flex flex-col flex-1 min-w-0 custom-dropdown-container" data-type="event">
                            <label class="absolute text-right font-bold" 
                                   style="left: 83.39%; top: calc(21.18% - 14px); width: 16.58%; font-size: clamp(8px, 1.2vw, 14px); color: #B8860B; text-shadow: 0 0 8px rgba(184, 134, 11, 0.3);">
                                نوع مراسم:
                            </label>
                            <div class="absolute" style="left: 83.39%; top: 21.18%; width: 16.58%; height: 57px;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute z-10">
                                    <rect class="fill-white/40 stroke-red-600 stroke-[2.5] [stroke-miterlimit:10] filter drop-shadow-[0_2px_8px_rgba(220,38,38,0.15)] transition-all duration-300 ease hover:stroke-[#0022ff] hover:drop-shadow-[0_4px_12px_rgba(184,134,11,0.2)]" x="0" y="0" width="305.61" height="57.14" rx="12" ry="12"/>
                                </svg>
                                <button type="button" class="dropdown-trigger absolute inset-0 w-full h-full bg-transparent border-none outline-none px-4 text-right cursor-pointer flex items-center justify-between text-[10px] sm:text-xs md:text-sm text-gray-400 z-20">
                                    <span class="selected-text">نوع مراسم را انتخاب کنید</span>
                                    <svg class="w-4 h-4 text-[#B8860B] transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                <ul class="dropdown-menu hidden absolute top-[110%] left-0 w-full bg-white/90 backdrop-blur-md border border-gray-200/50 rounded-xl shadow-[0_10px_30px_rgba(0,0,0,0.08)] overflow-hidden transition-all duration-300 z-50 text-right text-[10px] sm:text-xs md:text-sm max-h-60 overflow-y-auto">
                                    <li data-value="ولیمه" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150">ولیمه، افطار و نذری</li>
                                    <li data-value="روزهای-خاص" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">روزهای خاص (روز مادر، روز پدر، دختر و …)</li>
                                    <li data-value="خواستگاری" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">خواستگاری و پاگشا</li>
                                    <li data-value="شب-یلدا" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">شب یلدا</li>
                                    <li data-value="سازمانی" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">سازمانی (جلسات، ایونت‌ها، جشن پایان سال و …)</li>
                                    <li data-value="تعیین-جنسیت" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">تعیین جنسیت</li>
                                    <li data-value="ترحیم" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">ترحیم (هفتم، چهلم، سالگرد)</li>
                                    <li data-value="عقد" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">مراسم عقد و بله برون</li>
                                    <li data-value="تولد" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">تولد</li>
                                    <li data-value="شخصی" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">شخصی</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- بخش سوم --}}
                    <div class="flex flex-col w-full mt-1 md:mt-2">
                        <div class="flex flex-col w-full flex-1">
                            <div class="absolute" style="left: 48.65%; top: 37.11%; width: 51.32%; height: 43.87%;" x-data="textareaAnimation">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 945.89 309.84" class="w-full h-full pointer-events-none absolute">
                                    <rect class="light-rect-textarea fill-white/40 stroke-red-600 stroke-[2.5] [stroke-miterlimit:10] transition-all duration-300" x="0" y="0" width="945.89" height="309.84" rx="15" ry="15"/>
                                </svg>
                                <textarea x-model="$store.reserveForm.description" @focus="triggerAnimation($el.parentElement)" placeholder="توضیحات خود را اینجا بنویسید..." class="absolute inset-0 w-full h-full bg-transparent border-none outline-none p-4 text-right resize-none text-sm" style="color: #1a1a1a;"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- بخش چهارم --}}
                    <div class="flex flex-row gap-1 md:gap-3 w-full">
                        {{-- تقویم --}}
                        <div class="absolute overflow-hidden" 
                             style="left: 16.89%; top: 7.32%; width: 28.22%; height: 73.66%; background: rgba(255, 255, 255, 0.3); backdrop-filter: blur(10px); border-radius: 20px; border: 1px solid rgba(220, 38, 38, 0.15);" 
                             x-data="datePicker()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 520.18 520.18" class="w-full h-full pointer-events-none absolute z-10">
                                <rect class="fill-white/40 stroke-[#B8860B] stroke-[2.5] [stroke-miterlimit:10] filter drop-shadow-[0_2px_8px_rgba(184,134,11,0.15)] transition-all duration-300 ease hover:stroke-[#DC2626] hover:drop-shadow-[0_4px_12px_rgba(220,38,38,0.2)]" x="0" y="0" width="520.18" height="520.18" rx="15" ry="15"/>
                                <rect class="light-rect-calendar" x="0" y="0" width="520.18" height="520.18" rx="15" ry="15" fill="none" stroke="#ff0061" stroke-width="12" stroke-dasharray="100 629.22" style="opacity: 0;"/>
                            </svg>
                            <div class="w-full h-full flex flex-col p-1 sm:p-1.5 md:p-2 z-20 relative">
                                <div class="text-[8px] sm:text-[10px] md:text-xs font-semibold mb-0.5 md:mb-1 border-b pb-0.5 md:pb-1 text-right" style="color: #B8860B; border-color: rgba(220, 38, 38, 0.2);">
                                    تاریخ انتخاب‌شده: <span x-text="selectedDate ? selectedDate : '---'" style="color: #DC2626;"></span>
                                </div>
                                <div class="flex justify-between items-center mb-1 md:mb-2" x-data="{ isRTL: document.documentElement.dir === 'rtl' || getComputedStyle(document.documentElement).direction === 'rtl' }">
                                    {{-- <!-- دکمه ماه قبل --> --}}
                                    <button @click="changeMonth(-1)" type="button"
                                            class="relative overflow-hidden p-0.5 md:p-1 text-[10px] sm:text-xs md:text-sm font-bold ripple-effect rounded-full"
                                            style="color: #DC2626;">
                                        {{-- <!-- فلش چپ برای LTR، فلش راست برای RTL --> --}}
                                        <svg x-show="!isRTL" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 inline-block pointer-events-none">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        <svg x-show="isRTL" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 inline-block pointer-events-none">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    {{-- <!-- عنوان ماه و سال --> --}}
                                    <span class="font-bold text-[10px] sm:text-xs md:text-sm"
                                        x-text="currentMonthName + ' ' + currentYear"
                                        style="color: #B8860B;"></span>

                                    {{-- <!-- دکمه ماه بعد --> --}}
                                    <button @click="changeMonth(1)" type="button"
                                            class="relative overflow-hidden p-0.5 md:p-1 text-[10px] sm:text-xs md:text-sm font-bold ripple-effect rounded-full"
                                            style="color: #DC2626;">
                                        {{-- <!-- فلش راست برای LTR، فلش چپ برای RTL --> --}}
                                        <svg x-show="!isRTL" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 inline-block pointer-events-none">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        <svg x-show="isRTL" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 inline-block pointer-events-none">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="grid grid-cols-7 text-center text-[7px] sm:text-[8px] md:text-[10px] mb-0.5 md:mb-1" style="color: #DC2626;">
                                    <span>شنبه</span><span>یک‌شنبه</span><span>دوشنبه</span><span>سه‌شنبه</span><span>چهارشنبه</span><span>پنج‌شنبه</span><span>چهارشنبه</span>
                                </div>
                                <div class="grid grid-cols-7 gap-0.5 text-center grow">
                                    <template x-for="empty in startDayOffset"><div></div></template>
                                    <template x-for="day in daysInMonth">
                                        <button type="button" @click="selectDate(day)" :class="{'text-white': isSelected(day), 'text-gray-400 cursor-not-allowed': isBlocked(day)}" :style="isSelected(day) ? 'background: linear-gradient(135deg, #DC2626, #B8860B);' : ''" class="h-full flex items-center justify-center rounded-lg transition-all duration-200 text-[8px] sm:text-[10px] md:text-[12px]" style="color: #B8860B;"><span x-text="day"></span></button>
                                    </template>
                                </div>
                                <div class="flex justify-center mt-1 md:mt-2">
                                    <button type="button" @click="confirmDate()" :disabled="!selectedDate" class="px-2 py-0.5 md:px-3 md:py-1 rounded-lg text-white text-[10px] sm:text-xs md:text-sm font-medium transition-all duration-200 disabled:opacity-50" style="background: linear-gradient(135deg, #DC2626, #B8860B);">تأیید</button>
                                </div>
                            </div>
                        </div>

                        {{-- ساعت --}}
                        <div class="absolute overflow-hidden" style="left: 0.027%; top: 7.32%; width: 15.73%; height: 73.66%; background: rgba(255, 255, 255, 0.3); backdrop-filter: blur(10px); border-radius: 20px; border: 1px solid rgba(220, 38, 38, 0.15);" x-data="window.timePickerInline()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 289.98 520.18" class="w-full h-full pointer-events-none absolute z-10">
                                <rect class="fill-white/40 stroke-[#B8860B] stroke-[2.5] [stroke-miterlimit:10] filter drop-shadow-[0_2px_8px_rgba(184,134,11,0.15)] transition-all duration-300 ease hover:stroke-[#DC2626] hover:drop-shadow-[0_4px_12px_rgba(220,38,38,0.2)]" x="0" y="0" width="289.98" height="520.18" rx="15" ry="15"/>
                                <rect class="light-rect-time" x="0" y="0" width="289.98" height="520.18" rx="15" ry="15" fill="none" stroke="#ff0061" stroke-width="12" stroke-dasharray="100 629.22" style="opacity: 0;"/>
                            </svg>
                            <div class="relative h-full w-full">
                                <div x-show="mode === 'split'" class="h-full flex flex-col">
                                    <div @click="openPicker('entry')" class="flex-1 flex items-center justify-center cursor-pointer transition-all duration-200" style="border-bottom: 1px solid rgba(220, 38, 38, 0.2);">
                                        <span class="text-sm sm:text-base flex items-center gap-2" style="color: #B8860B;">
                                            ساعت ورودی:
                                            <span x-text="entryTime || '--:--'" class="font-mono" style="color: #DC2626;"></span>
                                        </span>
                                    </div>
                                    <div @click="openPicker('exit')" class="flex-1 flex items-center justify-center cursor-pointer transition-all duration-200">
                                        <span class="text-sm sm:text-base flex items-center gap-2" style="color: #B8860B;">
                                            ساعت خروجی:
                                            <span x-text="exitTime || '--:--'" class="font-mono" style="color: #DC2626;"></span>
                                        </span>
                                    </div>
                                </div>
                                <div x-show="mode === 'entry-edit' || mode === 'exit-edit'" class="h-full flex flex-col items-center justify-center p-2" dir="ltr">
                                    <p class="text-center font-medium mb-3 text-sm sm:text-base" x-text="mode === 'entry-edit' ? 'ساعت ورودی' : 'ساعت خروجی'" style="color: #B8860B;"></p>
                                    <div class="flex items-center justify-center gap-2 w-full" style="height: 160px;">
                                        {{-- ستون ساعت و دقیقه (کدهای اسکرول) مانند قبل --}}
                                        <div class="relative w-[45%] h-30 overflow-hidden rounded-xl bg-[rgba(248,250,252,0.5)] shadow-[inset_0_0_10px_rgba(220,38,38,0.1)] outline-none" tabindex="0" @mousedown.right="startDrag($event, 'hour')" @keydown="onKeydown($event, 'hour')" x-ref="hourColumn">
                                            <div class="h-full overflow-y-auto scrollbar-none! [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden py-10" @scroll="onScroll('hour')" x-ref="hourScroll">
                                                <template x-for="h in 24" :key="h">
                                                    <div class="h-10 flex items-center justify-center text-[1.2rem] text-[#94a3b8] cursor-pointer" :class="{ 'text-[1.6rem] font-bold text-[#DC2626] bg-[rgba(220,38,38,0.1)] rounded-lg mx-2': (h-1) === hourIndex }" @click="clickItem(h-1, 'hour')" x-text="('0'+(h-1)).slice(-2)"></div>
                                                </template>
                                            </div>
                                        </div>
                                        <span class="text-xl font-bold" style="color: #DC2626;">:</span>
                                        <div class="relative w-[45%] h-30 overflow-hidden rounded-xl bg-[rgba(248,250,252,0.5)] shadow-[inset_0_0_10px_rgba(220,38,38,0.1)] outline-none" tabindex="0" @mousedown.right="startDrag($event, 'minute')" @keydown="onKeydown($event, 'minute')" x-ref="minuteColumn">
                                            <div class="h-full overflow-y-auto scrollbar-none! [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden py-10" @scroll="onScroll('minute')" x-ref="minuteScroll">
                                                <template x-for="m in 60" :key="m">
                                                    <div class="h-10 flex items-center justify-center text-[1.2rem] text-[#94a3b8] cursor-pointer" :class="{ 'text-[1.6rem] font-bold text-[#DC2626] bg-[rgba(220,38,38,0.1)] rounded-lg mx-2': (m-1) === minuteIndex }" @click="clickItem(m-1, 'minute')" x-text="('0'+(m-1)).slice(-2)"></div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" @click="confirmTime" class="mt-4 px-4 py-1.5 text-white rounded-lg shadow transition-all duration-200 text-sm sm:text-base hover:scale-105" style="background: linear-gradient(135deg, #DC2626, #B8860B);">تایید</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- بخش پنجم (دکمه ثبت) --}}
                    <div class="flex flex-col w-full mt-1 md:mt-2">
                        <div class="absolute"
                             style="left: 31.36%; top: 88.81%; width: 38.76%; height: 11.12%;"
                             x-data="{ 
                                        get isValid() { 
                                            const f = $store.reserveForm;
                                            return f.name && f.phone && f.event_type && f.guest_count && f.reservation_date && f.entry_time && f.exit_time;
                                        }
                                    }">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 714.41 78.52" class="w-full h-full pointer-events-none absolute">
                                <rect class="fill-red-600/90 stroke-[#B8860B] stroke-3 [stroke-miterlimit:10] filter drop-shadow-[0_4px_15px_rgba(220,38,38,0.3)] transition-all duration-300 ease-in-out hover:fill-[#B8860B]/90 hover:stroke-[#DC2626]" x="0" y="0" width="714.41" height="78.52" rx="20" ry="20"/>
                            </svg>
                            <button type="submit" :disabled="!isValid" 
                                    :class="!isValid ? 'opacity-50 cursor-not-allowed' : 'hover:scale-[1.02] active:scale-[0.98]'"
                                    class="absolute inset-0 w-full h-full bg-transparent border-none outline-none font-bold transition-all duration-300 text-[10px] sm:text-sm md:text-base lg:text-lg"
                                    style="color: #FFFFFF; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                ارسال درخواست رزرو
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- نسخه موبایل --}}
<div class="block lg:hidden relative min-h-screen w-full bg-cover bg-center bg-fixed" style="background-image: url('{{ asset('assets/images/22.webp') }}');">
    
    {{-- لایه تیره با تم کرمی ملایم‌تر برای موبایل --}}
    <div class="absolute inset-0 bg-amber-50/75 z-0"></div>
    <div class="relative z-10 w-full max-w-md mx-auto p-4 pt-20 flex flex-col gap-6 pb-20">
        
        {{-- ۱. متن هشدار --}}
        <div class="w-full bg-white/40 backdrop-blur-md border border-red-600/30 rounded-xl p-3 shadow-sm text-center">
            <p class="text-red-600 font-bold leading-relaxed text-xs animate-pulse">
               فرم زیر را برای درخواست رزرو در کاخ موراکو تکمیل کنید (رزرو قطعی نیست). کارشناسان ما برای نهایی‌سازی تماس می‌گیرند.
            </p>
        </div>

        <div class="flex flex-col gap-4">
            
            {{-- ردیف اول: نام و تماس کنار هم --}}
            <div class="flex gap-4" x-data="formAnimation">
                {{-- نام --}}
                <div class="flex-1 flex flex-col relative">
                    <label for="mobile_name" class="text-right font-bold text-sm mb-1.5" style="color: #B8860B;">نام و نام خانوادگی:</label>
                    <div class="relative w-full h-13.75">
                        <svg viewBox="0 0 305.61 57.14" preserveAspectRatio="none" class="absolute inset-0 w-full h-full pointer-events-none">
                            <rect class="light-rect-input fill-white/60 stroke-red-600 stroke-[2.5] [stroke-miterlimit:10] filter drop-shadow-[0_2px_8px_rgba(220,38,38,0.15)] transition-all duration-300" x="1" y="1" width="303.61" height="55.14" rx="12" ry="12"/>
                        </svg>
                        <input type="text" id="mobile_name" placeholder="مثال: علی رضایی" @focus="triggerAnimation($el.parentElement)" class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-4 text-right font-normal text-sm placeholder-gray-500" style="color: #1a1a1a;" x-model="$store.reserveForm.name">
                    </div>
                </div>

                {{-- تماس --}}
                <div class="flex-1 flex flex-col relative">
                    <label for="mobile_phone" class="text-right font-bold text-sm mb-1.5" style="color: #B8860B;">شماره تماس:</label>
                    <div class="relative w-full h-13.75">
                        <svg viewBox="0 0 305.61 57.14" preserveAspectRatio="none" class="absolute inset-0 w-full h-full pointer-events-none">
                            <rect class="light-rect-input fill-white/60 stroke-red-600 stroke-[2.5] [stroke-miterlimit:10] filter drop-shadow-[0_2px_8px_rgba(220,38,38,0.15)] transition-all duration-300" x="1" y="1" width="303.61" height="55.14" rx="12" ry="12"/>
                        </svg>
                        <input type="tel" id="mobile_phone" placeholder="مثال: 09123456789" @focus="triggerAnimation($el.parentElement)" class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-4 text-right font-normal text-sm placeholder-gray-500" style="color: #1a1a1a;" x-model="$store.reserveForm.phone">
                    </div>
                </div>
            </div>

            {{-- ردیف دوم: ایمیل (تکی) --}}
            <div class="flex flex-col relative" x-data="formAnimation">
                <label for="mobile_email" class="text-right font-bold text-sm mb-1.5" style="color: #B8860B;">ایمیل:</label>
                <div class="relative w-full h-13.75">
                    <svg viewBox="0 0 305.61 57.14" preserveAspectRatio="none" class="absolute inset-0 w-full h-full pointer-events-none">
                        <rect class="light-rect-input fill-white/60 stroke-red-600 stroke-[2.5] [stroke-miterlimit:10] filter drop-shadow-[0_2px_8px_rgba(220,38,38,0.15)] transition-all duration-300" x="1" y="1" width="303.61" height="55.14" rx="12" ry="12"/>
                    </svg>
                    <input type="email" id="mobile_email" placeholder="مثال: example@email.com" @focus="triggerAnimation($el.parentElement)" class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-4 text-right font-normal text-sm placeholder-gray-500" style="color: #1a1a1a;" x-model="$store.reserveForm.email">
                </div>
            </div>

            {{-- ردیف سوم: نوع مراسم و تعداد مهمان کنار هم --}}
            <div class="flex gap-4">
                {{-- نوع مراسم --}}
                <div class="flex-1 flex flex-col relative custom-dropdown-container">
                    <label class="text-right font-bold text-sm mb-1.5" style="color: #B8860B;">نوع مراسم:</label>
                    <div class="relative w-full h-13.75">
                        <svg viewBox="0 0 305.61 57.14" preserveAspectRatio="none" class="absolute inset-0 w-full h-full pointer-events-none z-10">
                            <rect class="fill-white/60 stroke-red-600 stroke-[2.5] [stroke-miterlimit:10] filter drop-shadow-[0_2px_8px_rgba(220,38,38,0.15)] transition-all duration-300" x="1" y="1" width="303.61" height="55.14" rx="12" ry="12"/>
                        </svg>
                        <button type="button" class="dropdown-trigger absolute inset-0 w-full h-full bg-transparent border-none outline-none px-4 text-right flex items-center justify-between text-sm text-gray-500 z-20">
                            <span class="selected-text">نوع مراسم چیست؟</span>
                            <svg class="w-5 h-5 text-[#B8860B] transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul class="dropdown-menu hidden absolute top-[110%] right-0 w-full bg-white/95 backdrop-blur-xl border border-gray-200/50 rounded-xl shadow-lg overflow-hidden transition-all duration-300 z-50 text-right text-sm max-h-52 overflow-y-auto">
                            <li data-value="ولیمه" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150">ولیمه، افطار و نذری</li>
                            <li data-value="روزهای-خاص" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">روزهای خاص (روز مادر، روز پدر، دختر و …)</li>
                            <li data-value="خواستگاری" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">خواستگاری و پاگشا</li>
                            <li data-value="شب-یلدا" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">شب یلدا</li>
                            <li data-value="سازمانی" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">سازمانی (جلسات، ایونت‌ها، جشن پایان سال و …)</li>
                            <li data-value="تعیین-جنسیت" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">تعیین جنسیت</li>
                            <li data-value="ترحیم" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">ترحیم (هفتم، چهلم، سالگرد)</li>
                            <li data-value="عقد" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">مراسم عقد و بله برون</li>
                            <li data-value="تولد" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">تولد</li>
                            <li data-value="شخصی" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer transition-colors duration-150 border-t border-gray-100/50">شخصی</li>
                        </ul>
                    </div>
                </div>

                {{-- تعداد مهمان --}}
                <div class="flex-1 flex flex-col relative custom-dropdown-container">
                    <label class="text-right font-bold text-sm mb-1.5" style="color: #B8860B;">تعداد مهمان:</label>
                    <div class="relative w-full h-13.75">
                        <svg viewBox="0 0 305.61 57.14" preserveAspectRatio="none" class="absolute inset-0 w-full h-full pointer-events-none z-10">
                            <rect class="fill-white/60 stroke-red-600 stroke-[2.5] [stroke-miterlimit:10] filter drop-shadow-[0_2px_8px_rgba(220,38,38,0.15)] transition-all duration-300" x="1" y="1" width="303.61" height="55.14" rx="12" ry="12"/>
                        </svg>
                        <button type="button" class="dropdown-trigger absolute inset-0 w-full h-full bg-transparent border-none outline-none px-4 text-right flex items-center justify-between text-sm text-gray-500 z-20">
                            <span class="selected-text">تعداد را وارد کنید</span>
                            <svg class="w-5 h-5 text-[#B8860B] transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul class="dropdown-menu hidden absolute top-[110%] right-0 w-full bg-white/95 backdrop-blur-xl border border-gray-200/50 rounded-xl shadow-lg overflow-hidden transition-all duration-300 z-50 text-right text-sm max-h-52 overflow-y-auto">
                            <li data-value="1-4" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer border-b border-gray-100">۱ تا ۴ نفر</li>
                            <li data-value="5-10" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer border-b border-gray-100">۵ تا ۱۰ نفر</li>
                            <li data-value="25-50" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer border-b border-gray-100">۲۵ تا ۵۰ نفر</li>
                            <li data-value="50-100" class="px-4 py-3 text-gray-700 hover:bg-[#B8860B]/10 hover:text-[#B8860B] cursor-pointer">۵۰ تا ۱۰۰ نفر</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- ردیف چهارم: تاریخ ثبت شده (تکی) --}}
            <div class="flex flex-col relative" 
                x-data="confirmationComponent"
                x-on:date-confirmed.window="confirmedDate = $event.detail.date"
                x-on:entry-time-confirmed.window="confirmedEntryTime = $event.detail.time"
                x-on:exit-time-confirmed.window="confirmedExitTime = $event.detail.time">
                
                <label class="text-right font-bold text-sm mb-1.5" style="color: #B8860B;">تاریخ ثبت شده:</label>
                <div class="relative w-full h-13.75 cursor-pointer" x-on:click="triggerAnimation($el)">
                    <svg viewBox="0 0 305.61 57.14" preserveAspectRatio="none" class="w-full h-full absolute overflow-visible z-10">
                        <rect class="fill-white/60 stroke-red-600 stroke-[2.5] [stroke-miterlimit:10] filter drop-shadow-[0_2px_8px_rgba(220,38,38,0.15)] transition-all duration-300" x="1" y="1" width="303.61" height="55.14" rx="12" ry="12"/>
                        <rect class="light-rect" x="1" y="1" width="303.61" height="55.14" rx="12" ry="12" fill="none" stroke="#ff0061" stroke-width="6" stroke-dasharray="100 629.22" style="opacity: 0;"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center text-sm font-medium z-20 px-3 text-center" x-text="displayText" style="color: #1a1a1a;"></div>
                </div>
            </div>
        </div>

        {{-- ۴. تقویم و ساعت کنار هم --}}
        <div class="grid grid-cols-5 gap-3 h-80">
            
            {{-- تقویم (۳ ستون) --}}
            <div class="col-span-3 relative rounded-2xl p-2 bg-white/40 backdrop-blur-md border border-red-600/20 shadow-sm" x-data="datePicker()">
                <svg viewBox="0 0 520.18 520.18" preserveAspectRatio="none" class="w-full h-full pointer-events-none absolute inset-0 z-0">
                    <rect class="light-rect-calendar" x="2" y="2" width="516" height="516" rx="15" ry="15" fill="none" stroke="#ff0061" stroke-width="12" stroke-dasharray="100 629.22" style="opacity: 0;"/>
                </svg>
                
                <div class="relative w-full h-full flex flex-col z-10">
                    <div class="text-[10px] font-semibold mb-2 border-b pb-1 text-center" style="color: #B8860B; border-color: rgba(220, 38, 38, 0.2);">
                        تاریخ: <span x-text="selectedDate ? selectedDate : '---'" style="color: #DC2626;"></span>
                    </div>
                    <div class="flex justify-between items-center mb-2" 
                        x-data="{ isRTL: document.documentElement.dir === 'rtl' || getComputedStyle(document.documentElement).direction === 'rtl' }">
                    
                        {{-- <!-- دکمه ماه قبل --> --}}
                        <button @click="changeMonth(-1)" type="button" 
                                class="relative overflow-hidden p-1 text-xs font-bold ripple-effect rounded-full" 
                                style="color: #DC2626;">
                            {{-- <!-- LTR: فلش به چپ --> --}}
                            <svg x-show="!isRTL" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-3.5 h-3.5 inline-block pointer-events-none">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <svg x-show="isRTL" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-3.5 h-3.5 inline-block pointer-events-none">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <span class="font-bold text-[10px]" 
                                x-text="currentMonthName + ' ' + currentYear" 
                                style="color: #B8860B;"></span>

                        <button @click="changeMonth(1)" type="button" 
                                class="relative overflow-hidden p-1 text-xs font-bold ripple-effect rounded-full" 
                                style="color: #DC2626;">
                            <svg x-show="!isRTL" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-3.5 h-3.5 inline-block pointer-events-none">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            <svg x-show="isRTL" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-3.5 h-3.5 inline-block pointer-events-none">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <div class="grid grid-cols-7 text-center text-[9px] mb-1 font-bold" style="color: #DC2626;">
                        <span>ش</span><span>ی</span><span>د</span><span>س</span><span>چ</span><span>پ</span><span>ج</span>
                    </div>
                    <div class="grid grid-cols-7 gap-1 text-center grow">
                        <template x-for="empty in startDayOffset"><div></div></template>
                        <template x-for="day in daysInMonth">
                            <button type="button" @click="selectDate(day)" 
                                    :class="{'text-white': isSelected(day), 'text-gray-400': isBlocked(day)}" 
                                    :style="isSelected(day) ? 'background: linear-gradient(135deg, #DC2626, #B8860B);' : ''" 
                                    class="flex items-center justify-center rounded-md transition-all duration-200 text-[10px] font-medium" 
                                    style="color: #B8860B;"><span x-text="day"></span></button>
                        </template>
                    </div>
                    <button type="button" @click="confirmDate()" :disabled="!selectedDate" class="w-full mt-2 py-1.5 rounded-lg text-white text-xs font-medium transition-all duration-200 disabled:opacity-50" style="background: linear-gradient(135deg, #DC2626, #B8860B);">تأیید</button>
                </div>
            </div>

            {{-- ساعت (۲ ستون) --}}
            <div class="col-span-2 relative rounded-2xl bg-white/40 backdrop-blur-md border border-red-600/20 shadow-sm" x-data="window.timePickerInline()">
                <svg viewBox="0 0 289.98 520.18" preserveAspectRatio="none" class="w-full h-full pointer-events-none absolute inset-0 z-0">
                    <rect class="light-rect-time" x="2" y="2" width="285" height="516" rx="15" ry="15" fill="none" stroke="#ff0061" stroke-width="12" stroke-dasharray="100 629.22" style="opacity: 0;"/>
                </svg>
                
                <div class="relative w-full h-full z-10 p-2">
                    <div x-show="mode === 'split'" class="h-full flex flex-col justify-center gap-4">
                        <div @click="openPicker('entry')" class="flex-1 flex flex-col items-center justify-center bg-white/30 rounded-xl cursor-pointer shadow-sm border border-red-600/10">
                            <span class="text-[10px] mb-1 font-bold" style="color: #B8860B;">ساعت ورودی</span>
                            <span x-text="entryTime || '--:--'" class="font-mono text-sm font-bold" style="color: #DC2626;"></span>
                        </div>
                        <div @click="openPicker('exit')" class="flex-1 flex flex-col items-center justify-center bg-white/30 rounded-xl cursor-pointer shadow-sm border border-red-600/10">
                            <span class="text-[10px] mb-1 font-bold" style="color: #B8860B;">ساعت خروجی</span>
                            <span x-text="exitTime || '--:--'" class="font-mono text-sm font-bold" style="color: #DC2626;"></span>
                        </div>
                    </div>

                    <div x-show="mode === 'entry-edit' || mode === 'exit-edit'" class="h-full flex flex-col items-center justify-center" dir="ltr">
                        <p class="text-center font-bold mb-2 text-[10px]" x-text="mode === 'entry-edit' ? 'ورودی' : 'خروجی'" style="color: #B8860B;"></p>
                        <div class="flex items-center justify-center gap-1 w-full h-37.5">
                            <div class="relative w-1/2 h-full overflow-hidden rounded-lg bg-white/50 shadow-inner" tabindex="0" @mousedown.right="startDrag($event, 'hour')" @keydown="onKeydown($event, 'hour')" x-ref="hourColumn">
                                <div class="h-full overflow-y-auto scrollbar-none! [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden py-13" @scroll="onScroll('hour')" x-ref="hourScroll">
                                    <template x-for="h in 24" :key="h">
                                        <div class="h-10 flex items-center justify-center text-[1rem] text-[#94a3b8] cursor-pointer" :class="{ 'text-[1.2rem] font-bold text-[#DC2626] bg-[rgba(220,38,38,0.1)] rounded mx-1': (h-1) === hourIndex }" @click="clickItem(h-1, 'hour')" x-text="('0'+(h-1)).slice(-2)"></div>
                                    </template>
                                </div>
                            </div>
                            <span class="text-sm font-bold" style="color: #DC2626;">:</span>
                            <div class="relative w-1/2 h-full overflow-hidden rounded-lg bg-white/50 shadow-inner" tabindex="0" @mousedown.right="startDrag($event, 'minute')" @keydown="onKeydown($event, 'minute')" x-ref="minuteColumn">
                                <div class="h-full overflow-y-auto scrollbar-none! [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden py-13" @scroll="onScroll('minute')" x-ref="minuteScroll">
                                    <template x-for="m in 60" :key="m">
                                        <div class="h-10 flex items-center justify-center text-[1rem] text-[#94a3b8] cursor-pointer" :class="{ 'text-[1.2rem] font-bold text-[#DC2626] bg-[rgba(220,38,38,0.1)] rounded mx-1': (m-1) === minuteIndex }" @click="clickItem(m-1, 'minute')" x-text="('0'+(m-1)).slice(-2)"></div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <button type="button" @click="confirmTime" class="mt-2 w-full py-1 text-white rounded-lg shadow text-[10px] font-bold" style="background: linear-gradient(135deg, #DC2626, #B8860B);">تایید</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ۵. توضیحات --}}
        <div class="flex flex-col relative w-full h-32" x-data="textareaAnimation">
            <svg viewBox="0 0 945.89 309.84" preserveAspectRatio="none" class="absolute inset-0 w-full h-full pointer-events-none z-10">
                <rect class="light-rect-textarea fill-white/60 stroke-red-600 stroke-[2.5] [stroke-miterlimit:10] transition-all duration-300" x="2" y="2" width="941.89" height="305.84" rx="15" ry="15"/>
            </svg>
            <textarea x-model="$store.reserveForm.description" @focus="triggerAnimation($el.parentElement)" placeholder="توضیحات خود را اینجا بنویسید..." class="absolute inset-0 w-full h-full bg-transparent border-none outline-none p-4 text-right resize-none text-sm z-20 placeholder-gray-500" style="color: #1a1a1a;"></textarea>
        </div>

        {{-- ۶. دکمه ثبت نهایی --}}
        <div class="relative w-full h-14 mt-2"
            x-data="{ 
                        get isValid() { 
                            const f = $store.reserveForm;
                            return f.name && f.phone && f.event_type && f.guest_count && f.reservation_date && f.entry_time && f.exit_time;
                        }
                    }">
            <svg viewBox="0 0 714.41 78.52" preserveAspectRatio="none" class="absolute inset-0 w-full h-full pointer-events-none z-10">
                <rect class="fill-red-600/90 stroke-[#B8860B] stroke-3 [stroke-miterlimit:10] filter drop-shadow-[0_4px_15px_rgba(220,38,38,0.3)] transition-all duration-300 rx-4" x="2" y="2" width="710.41" height="74.52" rx="20" ry="20"/>
            </svg>
            <button type="submit" :disabled="!isValid" 
                    :class="!isValid ? 'opacity-50 cursor-not-allowed' : ''"
                    class="absolute inset-0 w-full h-full bg-transparent border-none outline-none font-bold transition-all duration-300 text-white text-base z-20"
                    style="text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                ارسال درخواست رزرو
            </button>
        </div>

    </div>
</div>
</form>
{{-- مودال تأیید OTP --}}
<div x-data="otpModal()" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm" style="display: none;" x-init="()=>{ $watch('show', val => $el.style.display = val ? 'flex' : 'none') }">
    <div class="bg-white/95 rounded-2xl shadow-2xl p-6 w-80 max-w-[90vw] text-right" @click.outside="if(step==='send') show=false">
        {{-- مرحله ارسال کد --}}
        <div x-show="step === 'send'">
            <h2 class="text-lg font-bold mb-2" style="color: #B8860B;">تأیید شماره موبایل</h2>
            <p class="text-sm mb-4 text-gray-600">کد تأیید به شماره <span x-text="phone" class="font-bold text-gray-800"></span> ارسال می‌شود.</p>
            <div class="flex gap-2">
                <button @click="sendOtp" :disabled="sending" class="flex-1 py-2 rounded-lg text-white font-bold transition-all duration-200" :class="sending ? 'bg-gray-400' : 'bg-red-600 hover:bg-red-700'" style="background: linear-gradient(135deg, #DC2626, #B8860B);">
                    <span x-show="!sending">ارسال کد تأیید</span>
                    <span x-show="sending" class="inline-block">در حال ارسال...</span>
                </button>
                <button @click="cancel" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-100">بازگشت</button>
            </div>
        </div>

        {{-- مرحله ورود کد --}}
        <div x-show="step === 'verify'">
            <h2 class="text-lg font-bold mb-2" style="color: #B8860B;">کد تأیید را وارد کنید</h2>
            <input type="text" x-model="code" maxlength="4" placeholder="کد ۴ رقمی" class="w-full text-center text-2xl tracking-widest border-2 border-red-600/50 rounded-lg p-2 mb-4 outline-none focus:border-red-600" autofocus @keyup.enter="verifyOtp">
            <div class="flex gap-2">
                <button @click="verifyOtp" :disabled="verifying" class="flex-1 py-2 rounded-lg text-white font-bold transition-all duration-200" :class="verifying ? 'bg-gray-400' : 'bg-red-600 hover:bg-red-700'" style="background: linear-gradient(135deg, #DC2626, #B8860B);">
                    <span x-show="!verifying">تأیید</span>
                    <span x-show="verifying" class="inline-block">⏳</span>
                </button>
                <button @click="resendOtp" :disabled="resendCooldown > 0" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-100" x-text="resendCooldown > 0 ? 'ارسال مجدد (' + resendCooldown + ')' : 'ارسال مجدد'"></button>
            </div>
        </div>
    </div>
</div>
@endsection