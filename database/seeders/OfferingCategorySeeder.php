<?php

namespace Database\Seeders;

use App\Models\OfferingCategory;
use Illuminate\Database\Seeder;

class OfferingCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Persepuluhan',
                'slug' => 'persepuluhan',
                'description' => 'Persembahan persepuluhan dari penghasilan jemaat',
                'bank_name' => 'Bank Mandiri',
                'bank_account_number' => '1230001234567',
                'bank_account_name' => 'GBKP Bandar Lampung',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Persembahan Umum',
                'slug' => 'persembahan-umum',
                'description' => 'Persembahan umum jemaat GBKP Bandar Lampung',
                'bank_name' => 'Bank BCA',
                'bank_account_number' => '9876543210',
                'bank_account_name' => 'GBKP Bandar Lampung',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Uang Kas Runggun',
                'slug' => 'uang-kas-runggun',
                'description' => 'Uang kas runggun untuk kegiatan persekutuan',
                'bank_name' => 'Bank BRI',
                'bank_account_number' => '567890123456',
                'bank_account_name' => 'GBKP Bandar Lampung',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($categories as $category) {
            OfferingCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
