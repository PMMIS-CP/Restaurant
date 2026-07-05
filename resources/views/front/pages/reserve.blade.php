@extends('front.layouts.app')
@section('title', 'رزرو')
@section('content')

<div class="relative min-h-screen w-full bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/images/21.webp') }}');">
    <div class="absolute inset-0 bg-amber-50/90"
         style="mask-image: radial-gradient(ellipse 70% 70% at 50% 50%, black 60%, transparent 100%);
                -webkit-mask-image: radial-gradient(ellipse 70% 70% at 50% 50%, black 60%, transparent 100%);">
    </div>
    <div class="relative z-10 flex items-center justify-center min-h-screen p-4 md:p-8">
        <div class="relative w-full max-w-7xl mx-auto" style="aspect-ratio: 1843.22 / 706.24;">
            {{-- متن هشدار --}}
            <div class="flex flex-col gap-1 md:gap-2">
                {{-- خط قرمز جدید با افکت چشمک‌زن --}}
                <div class="absolute inset-0 w-full h-full pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1843.22 706.24" class="w-full h-full">
                        {{-- اضافه شدن animate-pulse برای افکت روشن و خاموش --}}
                        <line class="fill-none stroke-red-500 stroke-[3px] [stroke-miterlimit:10] animate-pulse" x1="1063.66" y1="0.5" x2="1842.72" y2="0.5"/>
                    </svg>
                </div>

                {{-- متن روی خط - واکنش‌گرا --}}
                <div class="absolute" style="left: 57.7%; top: -3.5%; width: 42.4%;">
                    <p class="text-red-600 font-bold leading-tight text-[8px] sm:text-[10px] md:text-[12px] lg:text-[14.5px]">
                        برای ثبت درخواست رزرو رستوران سنتی کاخ موراکو فرم زیر را تکمیل کنید تا با شما تماس بگیریم.
                    </p>
                </div>
            <div class="flex flex-col">
            <div class="absolute w-full h-full">
                {{-- بخش اول --}}
                <div class="flex flex-row gap-1 md:gap-3 w-full">
                    {{-- ایمیل --}}
                    <div class="flex flex-col flex-1 min-w-0">
                        <label for="email" class="absolute text-right text-black" 
                            style="left: 48.65%; top: calc(7.32% - 14px); width: 16.58%; font-size: clamp(8px, 1.2vw, 14px);">
                            ایمیل:
                        </label>
                        <div class="absolute" style="left: 48.65%; top: 7.32%; width: 16.58%; height: 57px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute">
                                <rect class="cls-1" x="0" y="0" width="305.61" height="57.14"/>
                            </svg>
                            <input type="email" id="email" placeholder="مثال: example@email.com" 
                                class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-2 md:px-4 text-right font-normal text-[10px] sm:text-xs md:text-sm text-black">
                        </div>
                    </div>
                    {{-- شماره تماس --}}
                    <div class="flex flex-col flex-1 min-w-0">
                        <label for="phone" class="absolute text-right text-black" 
                            style="left: 66.02%; top: calc(7.32% - 14px); width: 16.58%; font-size: clamp(8px, 1.2vw, 14px);">
                            شماره تماس:
                        </label>
                        <div class="absolute" style="left: 66.02%; top: 7.32%; width: 16.58%; height: 57px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute">
                                <rect class="cls-1" x="0" y="0" width="305.61" height="57.14"/>
                            </svg>
                            <input type="tel" id="phone" placeholder="مثال: 09123456789" 
                                class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-2 md:px-4 text-right font-normal text-[10px] sm:text-xs md:text-sm text-black">
                        </div>
                    </div>
                    {{-- نام و نام خانوادگی --}}
                    <div class="flex flex-col flex-1 min-w-0">
                        <label for="name" class="absolute text-right text-black" 
                            style="left: 83.39%; top: calc(7.32% - 14px); width: 16.58%; font-size: clamp(8px, 1.2vw, 14px);">
                            نام و نام خانوادگی:
                        </label>
                        <div class="absolute" style="left: 83.39%; top: 7.32%; width: 16.58%; height: 57px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute">
                                <rect class="cls-1" x="0" y="0" width="305.61" height="57.14"/>
                            </svg>
                            <input type="text" id="name" placeholder="مثال: علی رضایی" 
                                class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-2 md:px-4 text-right font-normal text-[10px] sm:text-xs md:text-sm text-black">
                        </div>
                    </div>
                </div>
                {{-- بخش دوم --}}
                <div class="flex flex-row gap-1 md:gap-3 w-full mt-1 md:mt-2">
                    
                    {{-- باکس تاریخ و ساعت ثبت شده (تأیید شده) --}}
                    <div class="flex flex-col flex-1 min-w-0">
                        <label for="new_box" class="absolute text-right text-black" 
                            style="left: 48.65%; top: calc(21.18% - 14px); width: 16.58%; font-size: clamp(8px, 1.2vw, 14px);">
                            تاریخ و ساعت ثبت شده:
                        </label>
                        <div class="absolute" style="left: 48.65%; top: 21.18%; width: 16.58%; height: 57px;"
                            x-data="{ confirmedDate: '' }"
                            x-on:date-confirmed.window="confirmedDate = $event.detail.date">
                            {{-- SVG باکس --}}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute">
                                <rect class="cls-1" x="0" y="0" width="305.61" height="57.14"/>
                            </svg>
                            {{-- نمایش تاریخ تأیید شده --}}
                            <div class="absolute inset-0 flex items-center justify-center text-[12px] sm:text-[14px] md:text-[16px] text-gray-800 font-medium pointer-events-none"
                                x-text="confirmedDate || 'تأیید نشده'">
                            </div>
                        </div>
                    </div>
                    {{-- تعداد نفرات --}}
                    <div class="flex flex-col flex-1 min-w-0">
                        <label for="guest_count" class="absolute text-right text-black" 
                            style="left: 66.02%; top: calc(21.18% - 14px); width: 16.58%; font-size: clamp(8px, 1.2vw, 14px);">
                            تعداد مهمان:
                        </label>
                        <div class="absolute" style="left: 66.02%; top: 21.18%; width: 16.58%; height: 57px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute">
                                <rect class="cls-1" x="0" y="0" width="305.61" height="57.14"/>
                            </svg>
                            <select id="guest_count" class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-2 md:px-4 text-right cursor-pointer appearance-none text-[10px] sm:text-xs md:text-sm">
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
                        <label for="event_type" class="absolute text-right text-black" 
                            style="left: 83.39%; top: calc(21.18% - 14px); width: 16.58%; font-size: clamp(8px, 1.2vw, 14px);">
                            نوع مراسم:
                        </label>
                        <div class="absolute" style="left: 83.39%; top: 21.18%; width: 16.58%; height: 57px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute">
                                <rect class="cls-1" x="0" y="0" width="305.61" height="57.14"/>
                            </svg>
                            <select id="event_type" class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-2 md:px-4 text-right cursor-pointer appearance-none text-[10px] sm:text-xs md:text-sm">
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
                                <rect class="cls-1" x="0" y="0" width="945.89" height="309.84"/>
                            </svg>
                            <textarea placeholder="توضیحات خود را اینجا بنویسید..." 
                                    class="absolute inset-0 w-full h-full bg-transparent border-none outline-none p-2 md:p-4 lg:p-6 text-right resize-none placeholder-gray-500 text-[10px] sm:text-xs md:text-sm"></textarea>
                        </div>
                    </div>
                </div>
                {{-- بخش چهارم --}}
                <div class="flex flex-row gap-1 md:gap-3 w-full">
                    {{-- تاریخ --}}
                    <div class="absolute bg-white overflow-hidden" 
                        style="left: 16.89%; top: 7.32%; width: 28.22%; height: 73.66%;" 
                        x-data="datePicker()">
                        
                        {{-- این hidden فقط پس از تأیید پر می‌شود --}}
                        <input type="hidden" name="reservation_date" x-model="finalDate">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 520.18 520.18" class="w-full h-full pointer-events-none absolute z-10">
                            <rect class="cls-1" x="0" y="0" width="520.18" height="520.18" fill="none" stroke="currentColor"/>
                        </svg>

                        {{-- محتوای تقویم --}}
                        <div class="w-full h-full flex flex-col p-1 sm:p-1.5 md:p-2 z-20 relative">
                            
                            {{-- نمایش تاریخ انتخاب شده (موقت) --}}
                            <div class="text-[8px] sm:text-[10px] md:text-xs font-semibold text-gray-700 mb-0.5 md:mb-1 border-b pb-0.5 md:pb-1 text-right">
                                تاریخ انتخاب‌شده: 
                                <span x-text="selectedDate ? selectedDate : '---'"></span>
                            </div>

                            {{-- هدر تقویم --}}
                            <div class="flex justify-between items-center mb-1 md:mb-2">
                                <button @click="changeMonth(-1)" type="button" class="p-0.5 md:p-1 text-[10px] sm:text-xs md:text-sm">&lt;</button>
                                <span class="font-bold text-[10px] sm:text-xs md:text-sm" x-text="currentMonthName + ' ' + currentYear"></span>
                                <button @click="changeMonth(1)" type="button" class="p-0.5 md:p-1 text-[10px] sm:text-xs md:text-sm">&gt;</button>
                            </div>

                            {{-- روزهای هفته --}}
                            <div class="grid grid-cols-7 text-center text-[7px] sm:text-[8px] md:text-[10px] text-gray-500 mb-0.5 md:mb-1">
                                <span>ش</span><span>ی</span><span>د</span><span>س</span><span>چ</span><span>پ</span><span>ج</span>
                            </div>

                            {{-- روزهای ماه --}}
                            <div class="grid grid-cols-7 gap-0.5 text-center grow">
                                <template x-for="empty in startDayOffset">
                                    <div></div>
                                </template>
                                
                                <template x-for="day in daysInMonth">
                                    <button type="button" 
                                            @click="selectDate(day)"
                                            :class="{
                                                'bg-blue-600 text-white': isSelected(day), 
                                                'bg-gray-100 text-gray-400 cursor-not-allowed': isBlocked(day), 
                                                'hover:bg-blue-100': !isBlocked(day)
                                            }"
                                            class="h-full flex items-center justify-center rounded transition-colors text-[8px] sm:text-[10px] md:text-[12px]">
                                        <span x-text="day"></span>
                                    </button>
                                </template>
                            </div>

                            {{-- دکمه تأیید --}}
                            <div class="flex justify-center mt-1 md:mt-2">
                                <button type="button" 
                                        @click="confirmDate()"
                                        :disabled="!selectedDate"
                                        class="px-2 py-0.5 md:px-3 md:py-1 rounded bg-green-600 text-white text-[10px] sm:text-xs md:text-sm font-medium hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed">
                                    تأیید
                                </button>
                            </div>
                        </div>
                    </div>
                    <script>
                    document.addEventListener('alpine:init', () => {
                        Alpine.data('datePicker', () => ({
                            showCalendar: false,
                            selectedDate: '',      // انتخاب موقت کاربر
                            finalDate: '',         // تاریخ نهایی پس از تأیید (وارد hidden می‌شود)
                            
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
                                // فقط انتخاب موقت، تقویم باز می‌ماند
                                this.selectedDate = `${this.year}/${this.month}/${day}`;
                            },

                            confirmDate() {
                                if (!this.selectedDate) return;
                                // ذخیره‌سازی نهایی
                                this.finalDate = this.selectedDate;
                                // ارسال رویداد برای نمایش در باکس خارجی
                                this.$dispatch('date-confirmed', { date: this.finalDate });
                                // بستن تقویم (در صورت نیاز)
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
                    <div class="absolute bg-white overflow-hidden"
                        style="left: 0.027%; top: 7.32%; width: 15.73%; height: 73.66%;"
                        x-data="timePickerInline()"
                        x-init="initPicker()">

                        {{-- SVG حاشیه --}}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 289.98 520.18"
                            class="w-full h-full pointer-events-none absolute z-10 text-gray-700">
                            <rect x="0" y="0" width="289.98" height="520.18" fill="none" stroke="currentColor"/>
                        </svg>

                        {{-- استایل‌های چرخنده --}}
                        <style>
                            .wheel-column {
                                position: relative;
                                width: 45%;
                                height: 120px; /* نمایش ۳ آیتم */
                                overflow: hidden;
                                border-radius: 12px;
                                background: #f8fafc;
                                box-shadow: inset 0 0 10px rgba(0,0,0,0.05);
                                user-select: none;
                                touch-action: pan-y; /* فقط اسکرول عمودی روی صفحات لمسی */
                                outline: none; /* حذف outline فوکوس پیش‌فرض */
                            }
                            /* فوکوس ملایم برای دسترسی‌پذیری */
                            .wheel-column:focus-visible {
                                box-shadow: 0 0 0 2px #3b82f6;
                            }
                            .wheel-scroll {
                                height: 100%;
                                overflow-y: auto;
                                scrollbar-width: none; /* مخفی کردن اسکرول‌بار */
                                -ms-overflow-style: none;
                                cursor: default;
                                /* Padding جهت قرارگیری آیتم انتخاب‌شده در مرکز */
                                padding: 40px 0;
                                /* 🔥 حذف اسنپ اجباری برای درگ آزاد با موس */
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
                                cursor: pointer; /* نشان‌دهنده قابلیت کلیک */
                            }
                            .wheel-item.selected {
                                font-size: 1.6rem;
                                font-weight: bold;
                                color: #1e293b;
                                background: rgba(59,130,246,0.1);
                                border-radius: 8px;
                                margin: 0 8px;
                            }
                            /* محو شدن بالا و پایین */
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
                                background: linear-gradient(to bottom, #f8fafc 0%, transparent 100%);
                            }
                            .wheel-column::after {
                                bottom: 0;
                                background: linear-gradient(to top, #f8fafc 0%, transparent 100%);
                            }
                            /* در حال درگ با کلیک راست، نشانگر grab را نشان بده */
                            .wheel-scroll.dragging {
                                cursor: grabbing;
                            }
                        </style>

                        {{-- محتوای داخلی --}}
                        <div class="relative h-full w-full">

                            {{-- نمای دو بخشی (پیش‌فرض) --}}
                            <div x-show="mode === 'split'"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="h-full flex flex-col">

                                {{-- بخش ساعت ورودی --}}
                                <div @click="openPicker('entry')"
                                    class="flex-1 flex items-center justify-center border-b border-gray-300 cursor-pointer
                                            hover:bg-blue-50 transition-colors duration-200">
                                    <span class="text-sm sm:text-base">ساعت ورودی:
                                        <span x-text="entryTime || '--:--'" class="font-mono"></span>
                                    </span>
                                </div>

                                {{-- بخش ساعت خروجی --}}
                                <div @click="openPicker('exit')"
                                    class="flex-1 flex items-center justify-center cursor-pointer
                                            hover:bg-blue-50 transition-colors duration-200">
                                    <span class="text-sm sm:text-base">ساعت خروجی:
                                        <span x-text="exitTime || '--:--'" class="font-mono"></span>
                                    </span>
                                </div>
                            </div>

                            {{-- نمای ویرایش (چرخنده یکسان برای ورود و خروج) --}}
                            <div x-show="mode === 'entry-edit' || mode === 'exit-edit'"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="h-full flex flex-col items-center justify-center p-2" dir="ltr">

                                <p class="text-center font-medium mb-3 text-sm sm:text-base"
                                x-text="mode === 'entry-edit' ? 'انتخاب ساعت ورودی' : 'انتخاب ساعت خروجی'"></p>

                                {{-- چرخنده ساعت و دقیقه --}}
                                <div class="flex items-center justify-center gap-2 w-full" style="height: 160px;">
                                    {{-- ستون ساعت --}}
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

                                    <span class="text-xl font-bold text-gray-600">:</span>

                                    {{-- ستون دقیقه --}}
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
                                        class="mt-4 px-4 py-1.5 bg-blue-600 text-white rounded shadow
                                            hover:bg-blue-700 transition-colors text-sm sm:text-base">
                                    تایید
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- اسکریپت Alpine --}}
                    <script>
                        function timePickerInline() {
                            const ITEM_HEIGHT = 40; // باید با ارتفاع wheel-item در CSS یکسان باشد

                            return {
                                mode: 'split',
                                entryTime: null,
                                exitTime: null,
                                hourIndex: 8,   // پیش‌فرض ۰۸
                                minuteIndex: 0,  // پیش‌فرض ۰۰

                                // وضعیت ویرایش
                                editingType: null,
                                editingOriginalTime: null,

                                // وضعیت درگ با کلیک راست
                                dragging: {
                                    active: false,
                                    type: null,
                                    startY: 0,
                                    startScroll: 0
                                },

                                initPicker() {
                                    // رویدادهای سراسری موس برای درگ
                                    window.addEventListener('mousemove', this.onMouseMove.bind(this));
                                    window.addEventListener('mouseup', this.stopDrag.bind(this));
                                },

                                openPicker(type) {
                                    // ذخیره زمان فعلی برای امکان لغو
                                    this.editingType = type;
                                    this.editingOriginalTime = type === 'entry' ? this.entryTime : this.exitTime;

                                    // تنظیم مقادیر اولیه بر اساس زمان فعلی
                                    const currentTime = type === 'entry' ? this.entryTime : this.exitTime;
                                    if (currentTime) {
                                        const [h, m] = currentTime.split(':').map(Number);
                                        this.hourIndex = h;
                                        this.minuteIndex = m;
                                    } else {
                                        // ⬇️ تغییر این بخش: استفاده از ساعت و دقیقهٔ سیستم
                                        const now = new Date();
                                        this.hourIndex = now.getHours();
                                        this.minuteIndex = now.getMinutes();
                                    }

                                    this.mode = type === 'entry' ? 'entry-edit' : 'exit-edit';

                                    // اسکرول به موقعیت صحیح (بدون انیمیشن برای نمایش سریع)
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

                                // رویداد اسکرول طبیعی (چرخ ماوس، درگ لمسی)
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

                                // ═══════════════════════ درگ با کلیک راست ═══════════════════════
                                startDrag(event, type) {
                                    if (event.button !== 2) return; // فقط کلیک راست
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
                                    // حرکت موس به بالا (deltaY منفی) اسکرول را کاهش می‌دهد
                                    let newScrollTop = this.dragging.startScroll - deltaY;

                                    const maxIndex = this.dragging.type === 'hour' ? 23 : 59;
                                    const maxScroll = maxIndex * ITEM_HEIGHT;
                                    newScrollTop = Math.max(0, Math.min(maxScroll, newScrollTop));

                                    const scrollRef = this.dragging.type === 'hour' ? this.$refs.hourScroll : this.$refs.minuteScroll;
                                    if (scrollRef) {
                                        scrollRef.scrollTop = newScrollTop;
                                        // onScroll به‌طور خودکار فراخوانی می‌شود و ایندکس را به‌روز می‌کند
                                    }
                                },

                                stopDrag() {
                                    if (!this.dragging.active) return;
                                    const type = this.dragging.type;
                                    this.dragging.active = false;
                                    this.dragging.type = null;
                                    // اسنپ به نزدیک‌ترین آیتم با انیمیشن نرم
                                    this.$nextTick(() => {
                                        this.scrollToIndex(type, true);
                                    });
                                },
                                // ════════════════════════════════════════════════════════════

                                // ════════════ کلیک روی آیتم برای انتخاب مستقیم ════════════
                                clickItem(index, type) {
                                    if (type === 'hour') {
                                        this.hourIndex = index;
                                    } else {
                                        this.minuteIndex = index;
                                    }
                                    this.scrollToIndex(type, true);
                                },

                                // ════════════ پشتیبانی از صفحه‌کلید ════════════
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
                                    // بازگرداندن زمان اصلی
                                    if (this.editingType === 'entry') {
                                        this.entryTime = this.editingOriginalTime;
                                    } else if (this.editingType === 'exit') {
                                        this.exitTime = this.editingOriginalTime;
                                    }
                                    this.mode = 'split';
                                },

                                confirmTime() {
                                    const hour = ('0' + this.hourIndex).slice(-2);
                                    const minute = ('0' + this.minuteIndex).slice(-2);
                                    const timeStr = `${hour}:${minute}`;

                                    if (this.mode === 'entry-edit') {
                                        this.entryTime = timeStr;
                                    } else if (this.mode === 'exit-edit') {
                                        this.exitTime = timeStr;
                                    }

                                    this.mode = 'split';
                                },

                                // پاک‌سازی event listener هنگام حذف کامپوننت (اختیاری)
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
                            <rect class="cls-1" x="0" y="0" width="714.41" height="78.52"/>
                        </svg>
                        <button type="submit" 
                                class="absolute inset-0 w-full h-full bg-transparent border-none outline-none cursor-pointer font-bold transition-all duration-200 hover:scale-[1.01] active:scale-[0.99] text-[10px] sm:text-sm md:text-base lg:text-lg">
                            ارسال درخواست رزرو
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
{{-- استایل svg ها --}}
<style>
.cls-1 {
    fill: none;
    stroke: #000;
    stroke-miterlimit: 10;
    stroke-width: 4;
}
</style>
@endsection