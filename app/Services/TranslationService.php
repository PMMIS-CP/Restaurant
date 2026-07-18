<?php

namespace App\Services;

use App\Models\Translation;
use Illuminate\Support\Facades\File;

class TranslationService
{
    /**
     * بارگذاری اولیه همه ترجمه‌ها از فایل‌های lang به دیتابیس
     */
    public function syncFromFiles(): void
    {
        $locales = $this->getLocales();

        foreach ($locales as $locale) {
            $path = base_path("lang/{$locale}");

            if (!File::isDirectory($path)) {
                continue;
            }

            $files = File::allFiles($path);

            foreach ($files as $file) {
                $group = $file->getFilenameWithoutExtension();
                $translations = require $file->getPathname();

                $flat = $this->dot($translations);

                foreach ($flat as $key => $value) {
                    // فقط مقادیر رشته‌ای یا null را ذخیره کن
                    if (is_array($value)) {
                        continue; // از آرایه‌های خالی یا تو در تو رد شو
                    }

                    Translation::updateOrCreate(
                        [
                            'key'    => $key,
                            'group'  => $group,
                            'locale' => $locale,
                        ],
                        ['value' => $value]
                    );
                }
            }
        }
    }

    /**
     * به‌روزرسانی فایل زبان متناظر با یک رکورد ترجمه
     */
    public function updateFile(Translation $translation): void
    {
        $locale = $translation->locale;
        $group  = $translation->group;
        $path   = base_path("lang/{$locale}/{$group}.php");

        // اگر فایل وجود ندارد، یکی جدید می‌سازیم
        $allTranslations = File::exists($path) ? require $path : [];

        // تبدیل آرایه چندبعدی به یک‌بعدی
        $flat = $this->dot($allTranslations);

        // بروزرسانی مقدار کلید
        $flat[$translation->key] = $translation->value;

        // بازگرداندن به ساختار چندبعدی و ذخیره
        $nested = $this->undot($flat);
        $this->writeTranslationFile($path, $nested);
    }

    /**
     * دریافت لیست زبان‌های موجود از پوشه lang
     */
    public function getLocales(): array
    {
        $path = base_path('lang');
        if (!File::isDirectory($path)) {
            return [];
        }

        return collect(File::directories($path))
            ->map(fn($dir) => basename($dir))
            ->toArray();
    }

    /**
     * دریافت لیست گروه‌های موجود برای یک زبان
     */
    public function getGroups(string $locale): array
    {
        $path = base_path("lang/{$locale}");
        if (!File::isDirectory($path)) {
            return [];
        }

        return collect(File::files($path))
            ->map(fn($file) => $file->getFilenameWithoutExtension())
            ->toArray();
    }

    // --- متدهای کمکی برای آرایه‌ها ---

    private function dot(array $array, string $prepend = ''): array
    {
        $results = [];
        foreach ($array as $key => $value) {
            if (is_array($value) && !empty($value)) {
                $results = array_merge($results, $this->dot($value, $prepend . $key . '.'));
            } elseif (is_array($value) && empty($value)) {
                // آرایه خالی را نادیده بگیر یا null ذخیره کن
                // $results[$prepend . $key] = null;
                continue;
            } else {
                $results[$prepend . $key] = $value;
            }
        }
        return $results;
    }

    private function undot(array $dotArray): array
    {
        $result = [];
        foreach ($dotArray as $key => $value) {
            $keys = explode('.', $key);
            $temp = &$result;
            foreach ($keys as $i => $segment) {
                if ($i === count($keys) - 1) {
                    $temp[$segment] = $value;
                } else {
                    if (!isset($temp[$segment]) || !is_array($temp[$segment])) {
                        $temp[$segment] = [];
                    }
                    $temp = &$temp[$segment];
                }
            }
        }
        return $result;
    }

    private function writeTranslationFile(string $path, array $data): void
    {
        $content = "<?php\n\nreturn " . $this->arrayToPhpCode($data) . ";\n";
        File::ensureDirectoryExists(dirname($path));
        File::put($path, $content);
    }

    private function arrayToPhpCode(array $data, int $indentLevel = 0): string
    {
        $indent = str_repeat('    ', $indentLevel);
        $nextIndent = str_repeat('    ', $indentLevel + 1);
        
        if (empty($data)) {
            return '[]';
        }
        
        $lines = [];
        $lines[] = '[';
        
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $nestedValue = $this->arrayToPhpCode($value, $indentLevel + 1);
                $lines[] = "{$nextIndent}'{$key}' => {$nestedValue},";
            } elseif (is_null($value)) {
                $lines[] = "{$nextIndent}'{$key}' => null,";
            } elseif (is_bool($value)) {
                $lines[] = "{$nextIndent}'{$key}' => " . ($value ? 'true' : 'false') . ",";
            } elseif (is_numeric($value)) {
                $lines[] = "{$nextIndent}'{$key}' => {$value},";
            } else {
                $escapedValue = var_export($value, true);
                $lines[] = "{$nextIndent}'{$key}' => {$escapedValue},";
            }
        }
        
        $lines[] = "{$indent}]";
        
        return implode("\n", $lines);
    }
}