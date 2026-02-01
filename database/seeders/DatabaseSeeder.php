<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\City;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Hall;
use App\Models\Venue;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // $cities = [
        //     'Almaty',
        //     'Astana',
        //     'Shymkent',
        //     'Karaganda',
        // ];
        // foreach ($cities as $city) {
        //     City::create([
        //         'name' => $city,
        //     ]);
        // }
        // $categories = [
        //     [
        //         'name' => 'Technology',
        //         'icon' => 'code',
        //         'color' => '#4F46E5',
        //     ],
        //     [
        //         'name' => 'Business',
        //         'icon' => 'briefcase',
        //         'color' => '#059669',
        //     ],
        //     [
        //         'name' => 'Art',
        //         'icon' => 'palette',
        //         'color' => '#F59E0B',
        //     ],
        //     [
        //         'name' => 'Workshop',
        //         'icon' => 'megaphone',
        //         'color' => '#EC4899',
        //     ]
        // ];
        // foreach ($categories as $category) {
        //     EventCategory::create($category);
        // }
        $almaty = City::where('name', 'Almaty')->first();
        $astana = City::where('name', 'Astana')->first();
        Venue::create([
            'city_id' => $almaty->id,
            'name' => 'Event Hub Almaty',
            'address' => 'Abay Ave 52',
            'latitude' => 43.238949,
            'longitude' => 76.889709,
        ]);
        Venue::create([
            'city_id' => $almaty->id,
            'name' => 'Startup Space Almaty',
            'address' => 'Dostyk Ave 123',
            'latitude' => 43.250000,
            'longitude' => 76.900000,
        ]);
        Venue::create([
            'city_id' => $astana->id,
            'name' => 'Tech Arena Astana',
            'address' => 'Mangilik El 55',
            'latitude' => 51.090000,
            'longitude' => 71.418000,
        ]);
        $venues = Venue::all();
        foreach ($venues as $venue) {
            Hall::create([
                'venue_id' => $venue->id,
                'name' => 'Main Hall',
                'capacity' => 150,
            ]);
            Hall::create([
                'venue_id' => $venue->id,
                'name' => 'Workshop Room',
                'capacity' => 50,
            ]);
        }
        $categoryTech = EventCategory::where('name', 'Technology')->first();
        $categoryBusiness = EventCategory::where('name', 'Business')->first();
        $venue = Venue::first();
        $hall = Hall::where('venue_id', $venue->id)->first();
        Event::create([
            'title' => 'Startup Networking Night',
            'description' => 'Free networking event for founders and developers.',
            'event_type' => 'offline',
            'starts_at' => Carbon::now()->addDays(2),
            'ends_at' => Carbon::now()->addDays(2)->addHours(3),
            'venue_id' => $venue->id,
            'hall_id' => $hall->id,
            'category_id' => $categoryBusiness->id,
            'is_paid' => false,
            'price' => null,
            'status' => 'published',
            'image' => 'events/networking.jpg',
            'max_participants' => 120,
        ]);
        Event::create([
            'title' => 'AI & Machine Learning Summit',
            'description' => 'Deep dive into AI & Machine and best practices.',
            'event_type' => 'offline',
            'starts_at' => Carbon::now()->addDays(5),
            'ends_at' => Carbon::now()->addDays(5)->addHours(4),
            'venue_id' => $venue->id,
            'hall_id' => $hall->id,
            'category_id' => $categoryTech->id,
            'is_paid' => true,
            'price' => 5000,
            'status' => 'published',
            'image' => 'events/laravel.jpg',
            'max_participants' => 80,
        ]);
    }
}
