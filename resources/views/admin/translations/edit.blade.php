@extends('admin.layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">ویرایش ترجمه</h3>
        </div>

        <form method="POST" action="{{ route('admin.translations.update', $translation) }}" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            {{-- کلید --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">کلید</label>
                <input type="text" disabled value="{{ $translation->key }}"
                       class="w-full rounded-lg bg-gray-100 border-gray-300 text-gray-500 cursor-not-allowed dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600">
            </div>

            {{-- گروه --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">گروه</label>
                <input type="text" disabled value="{{ $translation->group }}"
                       class="w-full rounded-lg bg-gray-100 border-gray-300 text-gray-500 cursor-not-allowed dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600">
            </div>

            {{-- زبان جاری --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">زبان جاری</label>
                <input type="text" disabled value="{{ $translation->locale }}"
                       class="w-full rounded-lg bg-gray-100 border-gray-300 text-gray-500 cursor-not-allowed dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600">
            </div>

            {{-- مقدار ترجمه --}}
            <div>
                <label for="value" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    متن ترجمه ({{ $translation->locale }})
                </label>
                <textarea name="value" id="value" rows="5"
                          class="w-full rounded-lg shadow-sm focus:ring focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 @error('value') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                >{{ old('value', $translation->value) }}</textarea>
                @error('value')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- ترجمه‌های متناظر در زبان‌های دیگر --}}
            @if(count($allTranslations) > 1)
            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">ترجمه‌های دیگر این کلید:</h4>
                <ul class="space-y-2">
                    @foreach($allTranslations as $locale => $value)
                        @if($locale !== $translation->locale)
                        <li class="flex items-start gap-2 text-sm">
                            <span class="font-mono font-bold text-indigo-600 dark:text-indigo-400 w-10">{{ strtoupper($locale) }}:</span>
                            <span class="text-gray-700 dark:text-gray-300">{{ $value ?? '(خالی)' }}</span>
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- دکمه‌ها --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition">
                    ذخیره تغییرات
                </button>
                <a href="{{ route('admin.translations.index', ['locale' => $translation->locale, 'group' => $translation->group]) }}" 
                   class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700 transition">
                    بازگشت
                </a>
            </div>
        </form>
    </div>
</div>
@endsection