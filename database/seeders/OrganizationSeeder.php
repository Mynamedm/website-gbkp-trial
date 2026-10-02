<?php

namespace Database\Seeders;

use App\Models\OrganizationMember;
use App\Models\OrganizationSetting;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        OrganizationSetting::current()->update([
            'title' => 'Struktur Organisasi',
            'subtitle' => 'Pengurus GBKP Bandar Lampung',
            'description' => 'Susunan pengurus GBKP Bandar Lampung.',
            'periode' => '2024 - 2029',
        ]);

        OrganizationMember::query()->delete();

        $struktur = [
            [
                'position' => 'Ketua Umum',
                'name' => 'Pdt. Yohanes Kurniawan',
                'sort_order' => 1,
                'children' => [
                    [
                        'position' => 'Wakil Ketua Umum',
                        'name' => 'Pdt. Maria Anna Sibela',
                        'sort_order' => 1,
                        'children' => [
                            ['position' => 'Ketua Katekis Kelas I', 'name' => 'Sela Amelia', 'sort_order' => 1],
                            ['position' => 'Ketua Katekis Kelas II', 'name' => 'Yohanes Bagas Saputra', 'sort_order' => 2],
                        ],
                    ],
                    [
                        'position' => 'Sekretaris Umum',
                        'name' => 'Rina Marlina',
                        'sort_order' => 2,
                        'children' => [
                            ['position' => 'Staf Sekretariat', 'name' => 'Dewi Kartika', 'sort_order' => 1],
                            ['position' => 'Notulen Umum', 'name' => 'Notulen Umum', 'sort_order' => 2],
                        ],
                    ],
                    ['position' => 'Bendahara', 'name' => 'Budi Santoso', 'sort_order' => 3],
                    ['position' => 'Ketua Komite Altar', 'name' => 'Anton Wijaya', 'sort_order' => 4, 'is_active' => false],
                ],
            ],
            [
                'position' => 'Ketua Elim',
                'name' => 'Pdt. Samuel Ginting',
                'sort_order' => 2,
                'children' => [
                    ['position' => 'Sekretaris Elim', 'name' => 'Marta Sihombing', 'sort_order' => 1],
                    ['position' => 'Bendahara Elim', 'name' => 'Johan Prasetyo', 'sort_order' => 2],
                    ['position' => 'Pelayan Firdaus', 'name' => 'Rut Tampubolon', 'sort_order' => 3],
                ],
            ],
        ];

        $this->seedBranch($struktur);
    }

    private function seedBranch(array $nodes, ?int $parentId = null): void
    {
        foreach ($nodes as $node) {
            $member = OrganizationMember::create([
                'parent_id' => $parentId,
                'position' => $node['position'],
                'name' => $node['name'] ?? null,
                'sort_order' => $node['sort_order'] ?? 0,
                'is_active' => $node['is_active'] ?? true,
            ]);

            if (! empty($node['children'])) {
                $this->seedBranch($node['children'], $member->id);
            }
        }
    }
}