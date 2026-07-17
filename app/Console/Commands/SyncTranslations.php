<?php

namespace App\Console\Commands;

use App\Services\TranslationService;
use Illuminate\Console\Command;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Attributes\Description;

#[Signature('translations:sync')]
#[Description('همگام‌سازی تمام فایل‌های ترجمه با دیتابیس')]
class SyncTranslations extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(TranslationService $service): int
    {
        $this->info('در حال همگام‌سازی ترجمه‌ها...');
        $service->syncFromFiles();
        $this->info('تمام ترجمه‌ها با موفقیت همگام‌سازی شدند.');

        return self::SUCCESS;
    }
}