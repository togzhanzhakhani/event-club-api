<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\City;
use App\Models\EventCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            'Almaty',
            'Astana',
            'Shymkent',
            'Karaganda',
        ];
        foreach ($cities as $city) {
            City::create([
                'name' => $city,
            ]);
        }
        $categories = [
            [
                'name' => 'Technology',
                'icon' => 'code',
                'color' => '#4F46E5',
            ],
            [
                'name' => 'Business',
                'icon' => 'briefcase',
                'color' => '#059669',
            ],
            [
                'name' => 'Art',
                'icon' => 'palette',
                'color' => '#F59E0B',
            ],
            [
                'name' => 'Workshop',
                'icon' => 'megaphone',
                'color' => '#EC4899',
            ]
        ];
        foreach ($categories as $category) {
            EventCategory::create($category);
        }
    }
}
