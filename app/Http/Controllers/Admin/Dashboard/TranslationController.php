<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Translation;
use App\Services\TranslationService;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function __construct(
        private TranslationService $translationService
    ) {}

    /**
     * نمایش لیست ترجمه‌ها با فیلتر گروه و زبان
     */
    public function index(Request $request)
    {
        $locales = $this->translationService->getLocales();
        $selectedLocale = $request->get('locale', $locales[0] ?? 'fa');

        $groups = $this->translationService->getGroups($selectedLocale);
        $selectedGroup = $request->get('group', $groups[0] ?? '');

        $query = Translation::ofLocale($selectedLocale);

        if ($selectedGroup) {
            $query->ofGroup($selectedGroup);
        }

        $translations = $query->orderBy('key')->paginate(25)
            ->appends($request->only('locale', 'group'));

        return view('admin.translations.index', compact(
            'translations',
            'locales',
            'selectedLocale',
            'groups',
            'selectedGroup'
        ));
    }

    /**
     * فرم ویرایش یک ترجمه
     */
    public function edit(Translation $translation)
    {
        // گرفتن همه زبان‌ها برای نمایش ترجمه‌های متناظر در همان گروه و کلید
        $allTranslations = Translation::where('key', $translation->key)
            ->where('group', $translation->group)
            ->pluck('value', 'locale')
            ->toArray();

        $locales = $this->translationService->getLocales();

        return view('admin.translations.edit', compact('translation', 'allTranslations', 'locales'));
    }

    /**
     * بروزرسانی ترجمه
     */
    public function update(Request $request, Translation $translation)
    {
        $validated = $request->validate([
            'value' => 'nullable|string|max:65535',
        ]);

        $translation->update(['value' => $validated['value']]);

        // همگام‌سازی تغییرات با فایل lang
        $this->translationService->updateFile($translation);

        return redirect()
            ->route('admin.translations.index', [
                'locale' => $translation->locale,
                'group'  => $translation->group,
            ])
            ->with('success', 'ترجمه با موفقیت به‌روزرسانی شد.');
    }
}