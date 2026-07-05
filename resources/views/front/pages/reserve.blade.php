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
            {{-- خط قرمز جدید با افکت چشمک‌زن --}}
            <div class="absolute inset-0 w-full h-full pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1843.22 706.24" class="w-full h-full">
                    {{-- اضافه شدن animate-pulse برای افکت روشن و خاموش --}}
                    <line class="fill-none stroke-red-500 stroke-[3px] [stroke-miterlimit:10] animate-pulse" x1="1063.66" y1="0.5" x2="1842.72" y2="0.5"/>
                </svg>
            </div>

            {{-- متن روی خط --}}
            <div class="absolute" style="left: 57.7%; top: -3.5%; width: 42.4%;">
                <p class="text-red-600 text-[14.5px] font-bold leading-tight">
                    برای ثبت درخواست رزرو رستوران سنتی کاخ موراکو فرم زیر را تکمیل کنید تا با شما تماس بگیریم.
                </p>
            </div>

            <div class="absolute w-full h-full">
                {{-- ایمیل --}}
                <label for="email" class="absolute text-right text-sm text-black" 
                    style="left: 48.65%; top: calc(7.32% - 14px); width: 16.58%;">
                    ایمیل
                </label>
                <div class="absolute" style="left: 48.65%; top: 7.32%; width: 16.58%; height: 57px;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute">
                        <rect class="cls-1" x="0" y="0" width="305.61" height="57.14"/>
                    </svg>
                    <input type="email" id="email" placeholder="مثال: example@email.com" 
                        class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-4 text-right font-normal text-sm text-black">
                </div>

                {{-- شماره تماس --}}
                <label for="phone" class="absolute text-right text-sm text-black" 
                    style="left: 66.02%; top: calc(7.32% - 14px); width: 16.58%;">
                    شماره تماس
                </label>
                <div class="absolute" style="left: 66.02%; top: 7.32%; width: 16.58%; height: 57px;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute">
                        <rect class="cls-1" x="0" y="0" width="305.61" height="57.14"/>
                    </svg>
                    <input type="tel" id="phone" placeholder="مثال: 09123456789" 
                        class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-4 text-right font-normal text-sm text-black">
                </div>

                {{-- نام و نام خانوادگی --}}
                <label for="name" class="absolute text-right text-sm text-black" 
                    style="left: 83.39%; top: calc(7.32% - 14px); width: 16.58%;">
                    نام و نام خانوادگی
                </label>
                <div class="absolute" style="left: 83.39%; top: 7.32%; width: 16.58%; height: 57px;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute">
                        <rect class="cls-1" x="0" y="0" width="305.61" height="57.14"/>
                    </svg>
                    <input type="text" id="name" placeholder="مثال: علی رضایی" 
                        class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-4 text-right font-normal text-sm text-black">
                </div>

                {{-- تعداد نفرات --}}
                <label for="guest_count" class="absolute text-right text-sm text-black" 
                    style="left: 48.65%; top: calc(21.18% - 14px); width: 16.58%;">
                    تعداد مهمان
                </label>
                <div class="absolute" style="left: 48.65%; top: 21.18%; width: 16.58%; height: 57px;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305.61 57.14" class="w-full h-full pointer-events-none absolute">
                        <rect class="cls-1" x="0" y="0" width="305.61" height="57.14"/>
                    </svg>
                    <select id="guest_count" class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-4 text-right cursor-pointer appearance-none">
                        <option value="" disabled selected hidden>تعداد را وارد کنید</option> 
                        <option value="1-4">۱ تا ۴ نفر</option>
                        <option value="5-10">۵ تا ۱۰ نفر</option>
                        <option value="25-50">۲۵ تا ۵۰ نفر</option>
                        <option value="50-100">۵۰ تا ۱۰۰ نفر</option>
                    </select>
                </div>

                {{-- نوع مراسم --}}
                <label for="event_type" class="absolute text-right text-sm text-black" 
                    style="left: 66.02%; top: calc(21.18% - 14px); width: 33.95%;">
                    نوع مراسم
                </label>
                <div class="absolute" style="left: 66.02%; top: 21.18%; width: 33.95%; height: 57px;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 625.75 57.14" class="w-full h-full pointer-events-none absolute">
                        <rect class="cls-1" x="0" y="0" width="625.75" height="57.14"/>
                    </svg>
                    <select id="event_type" class="absolute inset-0 w-full h-full bg-transparent border-none outline-none px-4 text-right cursor-pointer appearance-none">
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

                {{-- توضیحات --}}
                <div class="absolute" style="left: 48.65%; top: 37.11%; width: 51.32%; height: 43.87%;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 945.89 309.84"
                        class="w-full h-full pointer-events-none absolute">
                        <rect class="cls-1" x="0" y="0" width="945.89" height="309.84"/>
                    </svg>
                    <textarea placeholder="توضیحات خود را اینجا بنویسید..." 
                            class="absolute inset-0 w-full h-full bg-transparent border-none outline-none p-6 text-right resize-none placeholder-gray-500"></textarea>
                </div>
                {{-- تاریخ --}}
                <div class="absolute bg-white overflow-hidden" 
                    style="left: 16.89%; top: 7.32%; width: 28.22%; height: 73.66%;" 
                    x-data="datePicker()">
                    
                    <input type="hidden" name="reservation_date" x-model="selectedDate">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 520.18 520.18" class="w-full h-full pointer-events-none absolute z-10">
                        <rect class="cls-1" x="0" y="0" width="520.18" height="520.18" fill="none" stroke="currentColor"/>
                    </svg>

                    {{-- محتوای تقویم --}}
                    <div class="w-full h-full flex flex-col p-2 z-20 relative">
                        
                        {{-- نمایش تاریخ رزرو --}}
                        <div class="text-xs font-semibold text-gray-700 mb-1 border-b pb-1 text-right">
                            تاریخ رزرو: 
                            <span x-text="selectedDate ? selectedDate : 'انتخاب نشده'"></span>
                        </div>

                        {{-- هدر تقویم --}}
                        <div class="flex justify-between items-center mb-2">
                            <button @click="changeMonth(-1)" type="button" class="p-1">&lt;</button>
                            <span class="font-bold text-sm" x-text="currentMonthName + ' ' + currentYear"></span>
                            <button @click="changeMonth(1)" type="button" class="p-1">&gt;</button>
                        </div>

                        {{-- روزهای هفته --}}
                        <div class="grid grid-cols-7 text-center text-[10px] text-gray-500 mb-1">
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
                                        :class="{'bg-blue-600 text-white': isSelected(day), 'bg-gray-100 text-gray-400 cursor-not-allowed': isBlocked(day), 'hover:bg-blue-100': !isBlocked(day)}"
                                        class="h-full flex items-center justify-center rounded transition-colors text-[12px]">
                                    <span x-text="day"></span>
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
                <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('datePicker', () => ({
                        showCalendar: false,
                        selectedDate: '',
                        
                        // وضعیت (State) را به مقادیر ساده تغییر دادیم
                        year: new persianDate().year(),
                        month: new persianDate().month(),
                        
                        blockedDates: ['1406/4/4', '1406/4/5'], // فرمت ساده
                        
                        // محاسبات را در getter انجام می‌دهیم (بدون ذخیره شیء در state)
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
                    x-data="timePicker()">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 289.98 520.18" class="w-full h-full pointer-events-none absolute z-10">
                        <rect class="cls-1" x="0" y="0" width="289.98" height="520.18" fill="none" stroke="currentColor"/>
                    </svg>

                    <div class="w-full h-full flex flex-col p-1.5 z-20 relative overflow-y-auto">
                        {{-- نمایش بازه انتخاب شده --}}
                        <div class="text-[15px] font-bold text-gray-700 mb-2 border-b pb-1 text-center h-8 flex items-center justify-center leading-tight">
                            <span x-text="rangeText"></span>
                        </div>
                        
                        {{-- دکمه‌های ساعت در دو ستون با ارتفاع کمتر --}}
                        <div class="grid grid-cols-2 gap-0.5">
                            <template x-for="hour in hours" :key="hour">
                                <button type="button" 
                                        @click="selectHour(hour)"
                                        :class="isSelected(hour) ? 'bg-blue-600 text-white' : 'bg-gray-100 hover:bg-gray-200'"
                                        class="p-[9.5px] rounded text-[11.5px] transition-colors border text-center font-medium leading-none whitespace-nowrap overflow-hidden">
                                    <span x-text="formatRange(hour)"></span>
                                </button>
                            </template>
                        </div>
                        
                        <input type="hidden" name="selected_hours" :value="JSON.stringify(selectedHours)">
                    </div>
                </div>

                <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('timePicker', () => ({
                        hours: Array.from({ length: 18 }, (_, i) => i + 6),
                        selectedHours: [],

                        get rangeText() {
                            if (this.selectedHours.length === 0) return 'انتخاب زمان';

                            const startHour = this.selectedHours[0];
                            const endHour = this.selectedHours[this.selectedHours.length - 1];

                            const endDisplay = endHour + 1 === 24 ? '00:00' : (endHour + 1) + ':00';
                            return `${startHour}:00 الی ${endDisplay}`;
                        },

                        formatRange(h) {
                            const next = h + 1;
                            return `${h}:00 الی ${next === 24 ? '00:00' : next + ':00'}`;
                        },

                        selectHour(hour) {
                            const len = this.selectedHours.length;

                            if (len === 0) {
                                this.selectedHours = [hour];
                            } else if (len === 1 && this.selectedHours[0] === hour) {
                                this.selectedHours = [];
                            } else {
                                const first = this.selectedHours[0];
                                const start = Math.min(first, hour);
                                const end   = Math.max(first, hour);
                                this.selectedHours = Array.from({ length: end - start + 1 }, (_, i) => start + i);
                            }
                        },

                        isSelected(hour) {
                            return this.selectedHours.includes(hour);
                        }
                    }));
                });
                </script>

                {{-- دکمه ثبت --}}
                <div class="absolute" style="left: 31.36%; top: 88.81%; width: 38.76%; height: 11.12%;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 714.41 78.52"
                        class="w-full h-full pointer-events-none absolute">
                        <rect class="cls-1" x="0" y="0" width="714.41" height="78.52"/>
                    </svg>
                    <button type="submit" 
                            class="absolute inset-0 w-full h-full bg-transparent border-none outline-none cursor-pointer font-bold transition-all duration-200 hover:scale-[1.01] active:scale-[0.99]">
                        ارسال درخواست رزرو
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
.cls-1 {
    fill: none;
    stroke: #000;
    stroke-miterlimit: 10;
    stroke-width: 4;
}
</style>
@endsection