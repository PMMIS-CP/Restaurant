@extends('front.layouts.app')
@section('title', 'رزرو')
@section('content')

<div class="relative min-h-screen w-full bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/images/21.webp') }}');">
    {{-- لایه تیره با تم کرمی --}}
    <div class="absolute inset-0 bg-amber-50/80 backdrop-blur-[2px]"
         style="mask-image: radial-gradient(ellipse 70% 70% at 50% 50%, black 60%, transparent 100%);
                -webkit-mask-image: radial-gradient(ellipse 70% 70% at 50% 50%, black 60%, transparent 100%);">
    </div>
    
    <div class="relative z-10 flex items-center justify-center min-h-screen p-4 md:p-8">
        {{-- کانتینر اصلی با افکت شیشه‌ای --}}
        <div class="relative w-full max-w-7xl mx-auto rounded-3xl p-4 md:p-6"
             style="aspect-ratio: 1843.22 / 706.24;">

            {{-- متن هشدار --}}
            <div class="flex flex-col gap-1 md:gap-2">
                {{-- خط قرمز با افکت چشمک‌زن و تم زرشکی --}}
                <div class="absolute inset-0 w-full h-full pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1843.22 706.24" class="w-full h-full">
                        <line class="fill-none stroke-red-600 animate-pulse" 
                              x1="1063.66" y1="0.5" x2="1842.72" y2="0.5"
                              style="stroke-width: 3px; stroke-miterlimit: 10;
                                     filter: drop-shadow(0 0 6px rgba(220, 38, 38, 0.4));"/>
                    </svg>
                </div>

                {{-- متن روی خط - واکنش‌گرا --}}
                <div class="absolute" style="left: 57.7%; top: -3.5%; width: 42.4%;">
                    <p class="text-red-600 font-bold leading-tight text-[8px] sm:text-[10px] md:text-[12px] lg:text-[14.5px]"
                       style="text-shadow: 0 0 10px rgba(220, 38, 38, 0.3);">
                        برای ثبت درخواست رزرو رستوران سنتی کاخ موراکو فرم زیر را تکمیل کنید تا با شما تماس بگیریم.
                    </p>
                </div>
            </div>

            <div class="flex flex-col">
            <div class="absolute w-full h-full">
                {{-- بخش اول --}}
                <div class="flex flex-row gap-1 md:gap-3 w-full">
                    {{-- ایمیل --}}
                    <div class="flex flex-col flex-1 min-w-0">
                        <label for="email" class="absolute text-right font-bold" 
                            style="left: 48.65%; top: calc(7.32% - 14px); width: 16.58%; font-size: clamp(8px, 1.2vw, 14px);
                                   color: #B8860B; text-shadow: 0 0 8px rgba(184, 134, 11, 0.3);">
                            ایمیل:
                        </label>
                        <div class="absolute" style="left: 48.65%; top: 7.32%; width: 16.58%; height: 57px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute">
                                <rect class="modern-box-crimson" x="0" y="0" width="305.61" height="57.14" rx="12" ry="12"/>
                            </svg>
                            <input type="email" id="email" placeholder="مثال: example@email.com" 
                                class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-2 md:px-4 text-right font-normal text-[10px] sm:text-xs md:text-sm placeholder-gray-400"
                                style="color: #1a1a1a;">
                        </div>
                    </div>
                    {{-- شماره تماس --}}
                    <div class="flex flex-col flex-1 min-w-0">
                        <label for="phone" class="absolute text-right font-bold" 
                            style="left: 66.02%; top: calc(7.32% - 14px); width: 16.58%; font-size: clamp(8px, 1.2vw, 14px);
                                   color: #B8860B; text-shadow: 0 0 8px rgba(184, 134, 11, 0.3);">
                            شماره تماس:
                        </label>
                        <div class="absolute" style="left: 66.02%; top: 7.32%; width: 16.58%; height: 57px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute">
                                <rect class="modern-box-crimson" x="0" y="0" width="305.61" height="57.14" rx="12" ry="12"/>
                            </svg>
                            <input type="tel" id="phone" placeholder="مثال: 09123456789" 
                                class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-2 md:px-4 text-right font-normal text-[10px] sm:text-xs md:text-sm placeholder-gray-400"
                                style="color: #1a1a1a;">
                        </div>
                    </div>
                    {{-- نام و نام خانوادگی --}}
                    <div class="flex flex-col flex-1 min-w-0">
                        <label for="name" class="absolute text-right font-bold" 
                            style="left: 83.39%; top: calc(7.32% - 14px); width: 16.58%; font-size: clamp(8px, 1.2vw, 14px);
                                   color: #B8860B; text-shadow: 0 0 8px rgba(184, 134, 11, 0.3);">
                            نام و نام خانوادگی:
                        </label>
                        <div class="absolute" style="left: 83.39%; top: 7.32%; width: 16.58%; height: 57px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute">
                                <rect class="modern-box-crimson" x="0" y="0" width="305.61" height="57.14" rx="12" ry="12"/>
                            </svg>
                            <input type="text" id="name" placeholder="مثال: علی رضایی" 
                                class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-2 md:px-4 text-right font-normal text-[10px] sm:text-xs md:text-sm placeholder-gray-400"
                                style="color: #1a1a1a;">
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

                        <label for="Date" class="absolute text-right font-bold" 
                            style="left: 48.65%; top: calc(21.18% - 14px); width: 16.58%; font-size: clamp(8px, 1.2vw, 14px);
                                    color: #B8860B; text-shadow: 0 0 8px rgba(184, 134, 11, 0.3);">
                            تاریخ و ساعت ثبت شده:
                        </label>

                        <div class="absolute cursor-pointer" 
                            style="left: 48.65%; top: 21.18%; width: 16.58%; height: 57px;"
                            x-on:click="triggerAnimation($el)">
                            
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full absolute overflow-visible">
                                <rect class="modern-box-crimson" x="0" y="0" width="305.61" height="57.14" rx="12" ry="12" fill="transparent"/>
                                
                                <rect class="light-rect" x="0" y="0" width="305.61" height="57.14" rx="12" ry="12" 
                                    fill="none" 
                                    stroke="#ff0061" 
                                    stroke-width="6" 
                                    stroke-dasharray="100 629.22" 
                                    style="opacity: 0;"/>
                            </svg>
                            
                            <div class="absolute inset-0 flex items-center justify-center text-[10px] sm:text-[12px] md:text-[14px] font-medium pointer-events-none px-2"
                                x-text="displayText"
                                style="color: #1a1a1a;">
                            </div>
                        </div>
                    </div>

                    {{-- تعداد نفرات --}}
                    <div class="flex flex-col flex-1 min-w-0">
                        <label for="guest_count" class="absolute text-right font-bold" 
                            style="left: 66.02%; top: calc(21.18% - 14px); width: 16.58%; font-size: clamp(8px, 1.2vw, 14px);
                                   color: #B8860B; text-shadow: 0 0 8px rgba(184, 134, 11, 0.3);">
                            تعداد مهمان:
                        </label>
                        <div class="absolute" style="left: 66.02%; top: 21.18%; width: 16.58%; height: 57px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute">
                                <rect class="modern-box-crimson" x="0" y="0" width="305.61" height="57.14" rx="12" ry="12"/>
                            </svg>
                            <select id="guest_count" class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-2 md:px-4 text-right cursor-pointer appearance-none text-[10px] sm:text-xs md:text-sm"
                                    style="color: #1a1a1a;">
                                <option value="" disabled selected hidden>تعداد را وارد کنید</option> 
                                <option value="1-4">۱ تا ۴ نفر</option>
                                <option value="5-10">۵ تا ۱۰ نفر</option>
                                <option value="25-50">۲۵ تا ۵۰ نفر</option>
                                <option value="50-100">۵۰ تا ۱۰۰ نفر</option>
                            </select>
                        </div>
                    </div>

                    {{-- نوع مراسم --}}
                    <div class="flex flex-col flex-1 min-w-0">
                        <label for="event_type" class="absolute text-right font-bold" 
                            style="left: 83.39%; top: calc(21.18% - 14px); width: 16.58%; font-size: clamp(8px, 1.2vw, 14px);
                                   color: #B8860B; text-shadow: 0 0 8px rgba(184, 134, 11, 0.3);">
                            نوع مراسم:
                        </label>
                        <div class="absolute" style="left: 83.39%; top: 21.18%; width: 16.58%; height: 57px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute">
                                <rect class="modern-box-crimson" x="0" y="0" width="305.61" height="57.14" rx="12" ry="12"/>
                            </svg>
                            <select id="event_type" class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-2 md:px-4 text-right cursor-pointer appearance-none text-[10px] sm:text-xs md:text-sm"
                                    style="color: #1a1a1a;">
                                <option value="" disabled selected hidden>نوع مراسم را انتخاب کنید</option>
                                <option value="wedding">عروسی</option>
                                <option value="birthday">تولد</option>
                                <option value="corporate">مهمانی سازمانی یا شرکتی</option>
                                <option value="engagement">نامزدی</option>
                                <option value="anniversary">سالگرد ازدواج</option>
                                <option value="friendly">مهمانی دوستانه</option>
                                <option value="conference">همایش یا سمینار</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- بخش سوم --}}
                <div class="flex flex-col w-full mt-1 md:mt-2">
                    {{-- توضیحات --}}
                    <div class="flex flex-col w-full flex-1">
                        <div class="absolute" style="left: 48.65%; top: 37.11%; width: 51.32%; height: 43.87%;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 945.89 309.84"
                                class="w-full h-full pointer-events-none absolute">
                                <rect class="modern-box-crimson" x="0" y="0" width="945.89" height="309.84" rx="15" ry="15"/>
                            </svg>
                            <textarea placeholder="توضیحات خود را اینجا بنویسید..." 
                                    class="absolute inset-0 w-full h-full bg-transparent border-none outline-none p-2 md:p-4 lg:p-6 text-right resize-none text-[10px] sm:text-xs md:text-sm"
                                    style="color: #1a1a1a;"
                                    placeholder-style="color: #9CA3AF;"></textarea>
                        </div>
                    </div>
                </div>

                {{-- بخش چهارم --}}
                <div class="flex flex-row gap-1 md:gap-3 w-full">
                    {{-- تقویم --}}
                    <div class="absolute overflow-hidden" 
                        style="left: 16.89%; top: 7.32%; width: 28.22%; height: 73.66%;
                               background: rgba(255, 255, 255, 0.3);
                               backdrop-filter: blur(10px);
                               -webkit-backdrop-filter: blur(10px);
                               border-radius: 20px;
                               border: 1px solid rgba(220, 38, 38, 0.15);" 
                        x-data="datePicker()">
                        
                        <input type="hidden" name="reservation_date" x-model="finalDate">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 520.18 520.18" class="w-full h-full pointer-events-none absolute z-10">
                            <rect class="modern-box-gold" x="0" y="0" width="520.18" height="520.18" rx="15" ry="15"/>
                            <rect class="light-rect-calendar" x="0" y="0" width="520.18" height="520.18" rx="15" ry="15" 
                                fill="none" 
                                stroke="#ff0061" 
                                stroke-width="6" 
                                stroke-dasharray="100 629.22" 
                                style="opacity: 0;"/>
                        </svg>

                        <div class="w-full h-full flex flex-col p-1 sm:p-1.5 md:p-2 z-20 relative">
                            
                            <div class="text-[8px] sm:text-[10px] md:text-xs font-semibold mb-0.5 md:mb-1 border-b pb-0.5 md:pb-1 text-right"
                                 style="color: #B8860B; border-color: rgba(220, 38, 38, 0.2);">
                                تاریخ انتخاب‌شده: 
                                <span x-text="selectedDate ? selectedDate : '---'" style="color: #DC2626;"></span>
                            </div>

                            <div class="flex justify-between items-center mb-1 md:mb-2">
                                <button @click="changeMonth(-1)" type="button" class="p-0.5 md:p-1 text-[10px] sm:text-xs md:text-sm transition-colors"
                                        style="color: #DC2626; hover-color: #B8860B;">&lt;</button>
                                <span class="font-bold text-[10px] sm:text-xs md:text-sm" x-text="currentMonthName + ' ' + currentYear"
                                      style="color: #B8860B;"></span>
                                <button @click="changeMonth(1)" type="button" class="p-0.5 md:p-1 text-[10px] sm:text-xs md:text-sm transition-colors"
                                        style="color: #DC2626; hover-color: #B8860B;">&gt;</button>
                            </div>

                            <div class="grid grid-cols-7 text-center text-[7px] sm:text-[8px] md:text-[10px] mb-0.5 md:mb-1"
                                 style="color: #DC2626;">
                                <span>ش</span><span>ی</span><span>د</span><span>س</span><span>چ</span><span>پ</span><span>ج</span>
                            </div>

                            <div class="grid grid-cols-7 gap-0.5 text-center grow">
                                <template x-for="empty in startDayOffset">
                                    <div></div>
                                </template>
                                
                                <template x-for="day in daysInMonth">
                                    <button type="button" 
                                            @click="selectDate(day)"
                                            :class="{
                                                'text-white': isSelected(day), 
                                                'text-gray-400 cursor-not-allowed': isBlocked(day)
                                            }"
                                            :style="isSelected(day) ? 'background: linear-gradient(135deg, #DC2626, #B8860B);' : ''"
                                            class="h-full flex items-center justify-center rounded-lg transition-all duration-200 text-[8px] sm:text-[10px] md:text-[12px]"
                                            style="color: #B8860B; hover-background: rgba(184, 134, 11, 0.1);">
                                        <span x-text="day"></span>
                                    </button>
                                </template>
                            </div>

                            <div class="flex justify-center mt-1 md:mt-2">
                                <button type="button" 
                                        @click="confirmDate()"
                                        :disabled="!selectedDate"
                                        class="px-2 py-0.5 md:px-3 md:py-1 rounded-lg text-white text-[10px] sm:text-xs md:text-sm font-medium transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                                        style="background: linear-gradient(135deg, #DC2626, #B8860B); hover-transform: scale(1.05);">
                                    تأیید
                                </button>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('alpine:init', () => {
                            Alpine.data('datePicker', () => ({
                                showCalendar: false,
                                selectedDate: '',
                                finalDate: '',
                                
                                year: new persianDate().year(),
                                month: new persianDate().month(),
                                
                                blockedDates: ['1406/4/4', '1406/4/5'],
                                
                                get viewDate() { 
                                    return new persianDate([this.year, this.month, 1]); 
                                },
                                get currentYear() { return this.viewDate.year(); },
                                get currentMonthName() { return this.viewDate.format('MMMM'); },
                                get daysInMonth() { return this.viewDate.daysInMonth(); },
                                get startDayOffset() { 
                                    return this.viewDate.day(); 
                                },

                                changeMonth(amount) {
                                    let newDate = this.viewDate.add('months', amount);
                                    this.year = newDate.year();
                                    this.month = newDate.month();
                                },

                                selectDate(day) {
                                    if (this.isBlocked(day)) return;
                                    this.selectedDate = `${this.year}/${this.month}/${day}`;
                                },

                                confirmDate() {
                                    if (!this.selectedDate) return;
                                    this.finalDate = this.selectedDate;
                                    this.$dispatch('date-confirmed', { date: this.finalDate });
                                    this.showCalendar = false;
                                },

                                isSelected(day) {
                                    return this.selectedDate === `${this.year}/${this.month}/${day}`;
                                },

                                isBlocked(day) {
                                    let dateStr = `${this.year}/${this.month}/${day}`;
                                    return this.blockedDates.includes(dateStr);
                                }
                            }));
                        });
                    </script>

                    {{-- ساعت --}}
                    <div class="absolute overflow-hidden"
                        style="left: 0.027%; top: 7.32%; width: 15.73%; height: 73.66%;
                               background: rgba(255, 255, 255, 0.3);
                               backdrop-filter: blur(10px);
                               -webkit-backdrop-filter: blur(10px);
                               border-radius: 20px;
                               border: 1px solid rgba(220, 38, 38, 0.15);"
                        x-data="timePickerInline()"
                        x-init="initPicker()">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 289.98 520.18"
                            class="w-full h-full pointer-events-none absolute z-10">
                            <rect class="modern-box-gold" x="0" y="0" width="289.98" height="520.18" rx="15" ry="15"/>
                            <rect class="light-rect-time" x="0" y="0" width="289.98" height="520.18" rx="15" ry="15" 
                                fill="none" 
                                stroke="#ff0061" 
                                stroke-width="6" 
                                stroke-dasharray="100 629.22" 
                                style="opacity: 0;"/>
                        </svg>

                        <style>
                            .wheel-column {
                                position: relative;
                                width: 45%;
                                height: 120px;
                                overflow: hidden;
                                border-radius: 12px;
                                background: rgba(248, 250, 252, 0.5);
                                box-shadow: inset 0 0 10px rgba(220, 38, 38, 0.1);
                                user-select: none;
                                touch-action: pan-y;
                                outline: none;
                            }
                            .wheel-column:focus-visible {
                                box-shadow: 0 0 0 2px #DC2626;
                            }
                            .wheel-scroll {
                                height: 100%;
                                overflow-y: auto;
                                scrollbar-width: none;
                                -ms-overflow-style: none;
                                cursor: default;
                                padding: 40px 0;
                            }
                            .wheel-scroll::-webkit-scrollbar {
                                display: none;
                            }
                            .wheel-item {
                                height: 40px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-size: 1.2rem;
                                color: #94a3b8;
                                transition: all 0.2s;
                                cursor: pointer;
                            }
                            .wheel-item.selected {
                                font-size: 1.6rem;
                                font-weight: bold;
                                color: #DC2626;
                                background: linear-gradient(135deg, rgba(220, 38, 38, 0.1), rgba(184, 134, 11, 0.1));
                                border-radius: 8px;
                                margin: 0 8px;
                            }
                            .wheel-column::before,
                            .wheel-column::after {
                                content: '';
                                position: absolute;
                                left: 0;
                                right: 0;
                                height: 30%;
                                z-index: 2;
                                pointer-events: none;
                            }
                            .wheel-column::before {
                                top: 0;
                                background: linear-gradient(to bottom, rgba(248, 250, 252, 0.5) 0%, transparent 100%);
                            }
                            .wheel-column::after {
                                bottom: 0;
                                background: linear-gradient(to top, rgba(248, 250, 252, 0.5) 0%, transparent 100%);
                            }
                            .wheel-scroll.dragging {
                                cursor: grabbing;
                            }
                        </style>

                        <div class="relative h-full w-full">

                            <div x-show="mode === 'split'"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="h-full flex flex-col">

                                <div @click="openPicker('entry')"
                                    class="flex-1 flex items-center justify-center cursor-pointer transition-all duration-200"
                                    style="border-bottom: 1px solid rgba(220, 38, 38, 0.2); hover-background: rgba(184, 134, 11, 0.05);">
                                    <span class="text-sm sm:text-base" style="color: #B8860B;">
                                        ساعت ورودی:
                                        <span x-text="entryTime || '--:--'" class="font-mono" style="color: #DC2626;"></span>
                                    </span>
                                </div>

                                <div @click="openPicker('exit')"
                                    class="flex-1 flex items-center justify-center cursor-pointer transition-all duration-200"
                                    style="hover-background: rgba(184, 134, 11, 0.05);">
                                    <span class="text-sm sm:text-base" style="color: #B8860B;">
                                        ساعت خروجی:
                                        <span x-text="exitTime || '--:--'" class="font-mono" style="color: #DC2626;"></span>
                                    </span>
                                </div>
                            </div>

                            <div x-show="mode === 'entry-edit' || mode === 'exit-edit'"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="h-full flex flex-col items-center justify-center p-2" dir="ltr">

                                <p class="text-center font-medium mb-3 text-sm sm:text-base"
                                   x-text="mode === 'entry-edit' ? 'انتخاب ساعت ورودی' : 'انتخاب ساعت خروجی'"
                                   style="color: #B8860B;"></p>

                                <div class="flex items-center justify-center gap-2 w-full" style="height: 160px;">
                                    <div class="wheel-column"
                                        tabindex="0"
                                        @contextmenu.prevent
                                        @mousedown.right="startDrag($event, 'hour')"
                                        @keydown="onKeydown($event, 'hour')"
                                        x-ref="hourColumn">
                                        <div class="wheel-scroll"
                                            :class="{ 'dragging': dragging.active && dragging.type === 'hour' }"
                                            @scroll="onScroll('hour')"
                                            x-ref="hourScroll">
                                            <template x-for="h in 24" :key="h">
                                                <div class="wheel-item"
                                                    :class="{ 'selected': (h-1) === hourIndex }"
                                                    @click="clickItem(h-1, 'hour')"
                                                    x-text="('0'+(h-1)).slice(-2)"></div>
                                            </template>
                                        </div>
                                    </div>

                                    <span class="text-xl font-bold" style="color: #DC2626;">:</span>

                                    <div class="wheel-column"
                                        tabindex="0"
                                        @contextmenu.prevent
                                        @mousedown.right="startDrag($event, 'minute')"
                                        @keydown="onKeydown($event, 'minute')"
                                        x-ref="minuteColumn">
                                        <div class="wheel-scroll"
                                            :class="{ 'dragging': dragging.active && dragging.type === 'minute' }"
                                            @scroll="onScroll('minute')"
                                            x-ref="minuteScroll">
                                            <template x-for="m in 60" :key="m">
                                                <div class="wheel-item"
                                                    :class="{ 'selected': (m-1) === minuteIndex }"
                                                    @click="clickItem(m-1, 'minute')"
                                                    x-text="('0'+(m-1)).slice(-2)"></div>
                                            </template>
                                        </div>
                                    </div>
                                </div>

                                <button @click="confirmTime"
                                        class="mt-4 px-4 py-1.5 text-white rounded-lg shadow transition-all duration-200 text-sm sm:text-base hover:scale-105"
                                        style="background: linear-gradient(135deg, #DC2626, #B8860B);">
                                    تایید
                                </button>
                            </div>
                        </div>
                    </div>

                    <script>
                        function timePickerInline() {
                            const ITEM_HEIGHT = 40;

                            return {
                                mode: 'split',
                                entryTime: null,
                                exitTime: null,
                                hourIndex: 8,
                                minuteIndex: 0,

                                editingType: null,
                                editingOriginalTime: null,

                                dragging: {
                                    active: false,
                                    type: null,
                                    startY: 0,
                                    startScroll: 0
                                },

                                initPicker() {
                                    window.addEventListener('mousemove', this.onMouseMove.bind(this));
                                    window.addEventListener('mouseup', this.stopDrag.bind(this));
                                },

                                openPicker(type) {
                                    this.editingType = type;
                                    this.editingOriginalTime = type === 'entry' ? this.entryTime : this.exitTime;

                                    const currentTime = type === 'entry' ? this.entryTime : this.exitTime;
                                    if (currentTime) {
                                        const [h, m] = currentTime.split(':').map(Number);
                                        this.hourIndex = h;
                                        this.minuteIndex = m;
                                    } else {
                                        const now = new Date();
                                        this.hourIndex = now.getHours();
                                        this.minuteIndex = now.getMinutes();
                                    }

                                    this.mode = type === 'entry' ? 'entry-edit' : 'exit-edit';

                                    this.$nextTick(() => {
                                        this.scrollToIndex('hour', false);
                                        this.scrollToIndex('minute', false);
                                    });
                                },

                                scrollToIndex(type, smooth = true) {
                                    const scrollRef = type === 'hour' ? this.$refs.hourScroll : this.$refs.minuteScroll;
                                    const index = type === 'hour' ? this.hourIndex : this.minuteIndex;
                                    if (scrollRef) {
                                        scrollRef.scrollTo({
                                            top: index * ITEM_HEIGHT,
                                            behavior: smooth ? 'smooth' : 'instant'
                                        });
                                    }
                                },

                                onScroll(type) {
                                    const scrollRef = type === 'hour' ? this.$refs.hourScroll : this.$refs.minuteScroll;
                                    if (!scrollRef) return;
                                    const rawIndex = Math.round(scrollRef.scrollTop / ITEM_HEIGHT);
                                    if (type === 'hour') {
                                        this.hourIndex = Math.min(23, Math.max(0, rawIndex));
                                    } else {
                                        this.minuteIndex = Math.min(59, Math.max(0, rawIndex));
                                    }
                                },

                                startDrag(event, type) {
                                    if (event.button !== 2) return;
                                    event.preventDefault();
                                    event.stopPropagation();

                                    const scrollRef = type === 'hour' ? this.$refs.hourScroll : this.$refs.minuteScroll;
                                    this.dragging.active = true;
                                    this.dragging.type = type;
                                    this.dragging.startY = event.clientY;
                                    this.dragging.startScroll = scrollRef.scrollTop;
                                },

                                onMouseMove(event) {
                                    if (!this.dragging.active) return;
                                    const deltaY = event.clientY - this.dragging.startY;
                                    let newScrollTop = this.dragging.startScroll - deltaY;

                                    const maxIndex = this.dragging.type === 'hour' ? 23 : 59;
                                    const maxScroll = maxIndex * ITEM_HEIGHT;
                                    newScrollTop = Math.max(0, Math.min(maxScroll, newScrollTop));

                                    const scrollRef = this.dragging.type === 'hour' ? this.$refs.hourScroll : this.$refs.minuteScroll;
                                    if (scrollRef) {
                                        scrollRef.scrollTop = newScrollTop;
                                    }
                                },

                                stopDrag() {
                                    if (!this.dragging.active) return;
                                    const type = this.dragging.type;
                                    this.dragging.active = false;
                                    this.dragging.type = null;
                                    this.$nextTick(() => {
                                        this.scrollToIndex(type, true);
                                    });
                                },

                                clickItem(index, type) {
                                    if (type === 'hour') {
                                        this.hourIndex = index;
                                    } else {
                                        this.minuteIndex = index;
                                    }
                                    this.scrollToIndex(type, true);
                                },

                                onKeydown(event, type) {
                                    const keys = ['ArrowUp', 'ArrowDown', 'Enter', 'Escape'];
                                    if (!keys.includes(event.key)) return;

                                    event.preventDefault();

                                    if (event.key === 'ArrowUp') {
                                        if (type === 'hour') {
                                            this.hourIndex = (this.hourIndex + 1) % 24;
                                        } else {
                                            this.minuteIndex = (this.minuteIndex + 1) % 60;
                                        }
                                        this.scrollToIndex(type, true);
                                    } else if (event.key === 'ArrowDown') {
                                        if (type === 'hour') {
                                            this.hourIndex = (this.hourIndex - 1 + 24) % 24;
                                        } else {
                                            this.minuteIndex = (this.minuteIndex - 1 + 60) % 60;
                                        }
                                        this.scrollToIndex(type, true);
                                    } else if (event.key === 'Enter') {
                                        this.confirmTime();
                                    } else if (event.key === 'Escape') {
                                        this.cancelEdit();
                                    }
                                },

                                cancelEdit() {
                                    if (this.editingType === 'entry') {
                                        this.entryTime = this.editingOriginalTime;
                                        if (this.editingOriginalTime) {
                                            this.$dispatch('entry-time-confirmed', { time: this.editingOriginalTime });
                                        } else {
                                            this.$dispatch('entry-time-confirmed', { time: '' });
                                        }
                                    } else if (this.editingType === 'exit') {
                                        this.exitTime = this.editingOriginalTime;
                                        if (this.editingOriginalTime) {
                                            this.$dispatch('exit-time-confirmed', { time: this.editingOriginalTime });
                                        } else {
                                            this.$dispatch('exit-time-confirmed', { time: '' });
                                        }
                                    }
                                    this.mode = 'split';
                                },

                                confirmTime() {
                                    const hour = ('0' + this.hourIndex).slice(-2);
                                    const minute = ('0' + this.minuteIndex).slice(-2);
                                    const timeStr = `${hour}:${minute}`;

                                    if (this.mode === 'entry-edit') {
                                        this.entryTime = timeStr;
                                        this.$dispatch('entry-time-confirmed', { time: timeStr });
                                    } else if (this.mode === 'exit-edit') {
                                        this.exitTime = timeStr;
                                        this.$dispatch('exit-time-confirmed', { time: timeStr });
                                    }

                                    this.mode = 'split';
                                },

                                destroy() {
                                    window.removeEventListener('mousemove', this.onMouseMove);
                                    window.removeEventListener('mouseup', this.stopDrag);
                                }
                            }
                        }
                    </script>

                </div>

                {{-- بخش پنجم --}}
                <div class="flex flex-col w-full mt-1 md:mt-2">
                    {{-- دکمه ثبت --}}
                    <div class="absolute" style="left: 31.36%; top: 88.81%; width: 38.76%; height: 11.12%;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 714.41 78.52"
                            class="w-full h-full pointer-events-none absolute">
                            <rect class="modern-btn" x="0" y="0" width="714.41" height="78.52" rx="20" ry="20"/>
                        </svg>
                        <button type="submit" 
                                class="absolute inset-0 w-full h-full bg-transparent border-none outline-none cursor-pointer font-bold transition-all duration-300 hover:scale-[1.02] active:scale-[0.98] text-[10px] sm:text-sm md:text-base lg:text-lg"
                                style="color: #FFFFFF; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                            ارسال درخواست رزرو
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- استایل مدرن SVG ها --}}
<style>
/* باکس‌های ورودی با حاشیه زرشکی */
.modern-box-crimson {
    fill: rgba(255, 255, 255, 0.4);
    stroke: #DC2626;
    stroke-width: 2.5;
    stroke-miterlimit: 10;
    filter: drop-shadow(0 2px 8px rgba(220, 38, 38, 0.15));
    transition: all 0.3s ease;
}
.modern-box-crimson:hover {
    stroke: #0022ff;
    filter: drop-shadow(0 4px 12px rgba(184, 134, 11, 0.2));
}

/* باکس‌های تقویم و ساعت با حاشیه طلایی */
.modern-box-gold {
    fill: rgba(255, 255, 255, 0.4);
    stroke: #B8860B;
    stroke-width: 2.5;
    stroke-miterlimit: 10;
    filter: drop-shadow(0 2px 8px rgba(184, 134, 11, 0.15));
    transition: all 0.3s ease;
}
.modern-box-gold:hover {
    stroke: #DC2626;
    filter: drop-shadow(0 4px 12px rgba(220, 38, 38, 0.2));
}

/* دکمه ثبت با گرادینت */
.modern-btn {
    fill: rgba(220, 38, 38, 0.9);
    stroke: #B8860B;
    stroke-width: 3;
    stroke-miterlimit: 10;
    filter: drop-shadow(0 4px 15px rgba(220, 38, 38, 0.3));
    transition: all 0.3s ease;
}
.modern-btn:hover {
    fill: rgba(184, 134, 11, 0.9);
    stroke: #DC2626;
    filter: drop-shadow(0 6px 20px rgba(184, 134, 11, 0.4));
}
/* برای حذف رنگ پس‌زمینه پیش‌فرض کروم */
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus {
    /* استفاده از سایه داخلی برای خنثی کردن پس‌زمینه زرد کروم */
    -webkit-box-shadow: 0 0 0px 1000px transparent inset !important;
    /* تنظیم رنگ متن به همان رنگ دلخواه شما */
    -webkit-text-fill-color: #1a1a1a !important;
    /* حفظ استایل‌های قبلی */
    transition: background-color 5000s ease-in-out 0s;
}
/* تنظیم برای textarea جهت هماهنگی با Autofill */
textarea:-webkit-autofill,
textarea:-webkit-autofill:hover,
textarea:-webkit-autofill:focus {
    /* حذف پس‌زمینه زرد کروم */
    -webkit-box-shadow: 0 0 0px 1000px transparent inset !important;
    /* تنظیم رنگ متن */
    -webkit-text-fill-color: #1a1a1a !important;
    /* جلوگیری از تغییر ناگهانی رنگ پس‌زمینه */
    transition: background-color 5000s ease-in-out 0s;
}
</style>
<script>
    document.addEventListener('alpine:init', () => {
    Alpine.data('confirmationComponent', () => ({
        confirmedDate: '',
        confirmedEntryTime: '',
        confirmedExitTime: '',
        isAnimating: false,

        triggerAnimation(el) {
            if (this.isAnimating) return;
            this.isAnimating = true;

            const runGsap = (selector, parent = document) => {
                const target = parent.querySelector(selector);
                if (!target) return;
                gsap.fromTo(target, 
                    { strokeDashoffset: 729.22, opacity: 1 }, 
                    { 
                        strokeDashoffset: -1458.44, 
                        duration: 6, 
                        ease: 'none',
                        onComplete: () => { gsap.set(target, { opacity: 0 }); }
                    }
                );
            };

            runGsap('.light-rect', el);
            
            // پیدا کردن باکس‌های تقویم و ساعت
            const calendarBox = document.querySelector('[x-data*="datePicker"]')?.closest('.absolute.overflow-hidden');
            if (calendarBox) runGsap('.light-rect-calendar', calendarBox);

            const timeBox = document.querySelector('[x-data*="timePickerInline"]')?.closest('.absolute.overflow-hidden');
            if (timeBox) runGsap('.light-rect-time', timeBox);

            setTimeout(() => { this.isAnimating = false; }, 6000);
        },

        get displayText() {
            if (this.confirmedDate && this.confirmedEntryTime && this.confirmedExitTime) {
                return `${this.confirmedDate} - ${this.confirmedEntryTime} الی ${this.confirmedExitTime}`;
            } else if (this.confirmedDate && this.confirmedEntryTime) {
                return `${this.confirmedDate} - ${this.confirmedEntryTime} الی ---`;
            } else if (this.confirmedDate && this.confirmedExitTime) {
                return `${this.confirmedDate} - --- الی ${this.confirmedExitTime}`;
            } else if (this.confirmedDate) {
                return `${this.confirmedDate} - بدون ساعت`;
            } else if (this.confirmedEntryTime || this.confirmedExitTime) {
                return `بدون تاریخ - ${this.confirmedEntryTime || '---'} الی ${this.confirmedExitTime || '---'}`;
            }
            return 'تأیید نشده';
        }
    }));
});
</script>

@endsection