<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class MenuCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name_fa' => 'ایرانی',
                'name_en' => 'Iranian',
                'name_ar' => 'إيراني',
                'image'   => 'menu/ایرانی.webp',
            ],
            [
                'name_fa' => 'سالاد',
                'name_en' => 'Salad',
                'name_ar' => 'سلطة',
                'image'   => 'menu/سالاد.webp',
            ],
            [
                'name_fa' => 'مخصوص',
                'name_en' => 'Special',
                'name_ar' => 'خاص',
                'image'   => 'menu/مخصوص.webp',
            ],
        ];

        foreach ($categories as $cat) {
            $this->copyImageIfNeeded($cat['image']);

            MenuCategory::create([
                'name_fa' => $cat['name_fa'],
                'name_en' => $cat['name_en'],
                'name_ar' => $cat['name_ar'],
                'image'   => $cat['image'],
            ]);
        }
    }

    private function copyImageIfNeeded(string $storagePath): void
    {
        $source = public_path('assets/images/' . $storagePath); // public/assets/images/menu/...
        $destination = storage_path('app/public/' . $storagePath);

        if (File::exists($source) && !File::exists($destination)) {
            File::ensureDirectoryExists(dirname($destination));
            File::copy($source, $destination);
        }
    }
}