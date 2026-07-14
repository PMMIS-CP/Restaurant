<?php

namespace Database\Seeders;

use App\Models\Reserve;
use Illuminate\Database\Seeder;

class ReserveSeeder extends Seeder
{
    public function run(): void
    {
        $reservations = [
            [
                'name'             => 'علی محمدی',
                'phone'            => '09121234567',
                'email'            => 'ali@example.com',
                'event_type'       => 'شام',
                'guest_count'      => 4,
                'reservation_date' => now()->addDays(3)->toDateString(),
                'entry_time'       => '19:00',
                'exit_time'        => '22:00',
                'description'      => 'مهمانی خانوادگی',
                'status'           => 'confirmed',
            ],
            [
                'name'             => 'سارا احمدی',
                'phone'            => '09351234567',
                'email'            => 'sara@example.com',
                'event_type'       => 'ناهار کاری',
                'guest_count'      => 8,
                'reservation_date' => now()->addDays(5)->toDateString(),
                'entry_time'       => '12:30',
                'exit_time'        => '15:00',
                'description'      => 'جلسه کاری',
                'status'           => 'pending',
            ],
            [
                'name'             => 'رضا کریمی',
                'phone'            => '09191112233',
                'email'            => 'reza@example.com',
                'event_type'       => 'تولد',
                'guest_count'      => 10,
                'reservation_date' => now()->addWeeks(1)->toDateString(),
                'entry_time'       => '18:00',
                'exit_time'        => '23:00',
                'description'      => 'جشن تولد ۳۰ سالگی',
                'status'           => 'confirmed',
            ],
        ];

        foreach ($reservations as $res) {
            Reserve::create($res);
        }
    }
}