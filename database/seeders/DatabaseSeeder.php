<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\City;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Hall;
use App\Models\Post;
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
        // $almaty = City::where('name', 'Almaty')->first();
        // $astana = City::where('name', 'Astana')->first();
        // Venue::create([
        //     'city_id' => $almaty->id,
        //     'name' => 'Event Hub Almaty',
        //     'address' => 'Abay Ave 52',
        //     'latitude' => 43.238949,
        //     'longitude' => 76.889709,
        // ]);
        // Venue::create([
        //     'city_id' => $almaty->id,
        //     'name' => 'Startup Space Almaty',
        //     'address' => 'Dostyk Ave 123',
        //     'latitude' => 43.250000,
        //     'longitude' => 76.900000,
        // ]);
        // Venue::create([
        //     'city_id' => $astana->id,
        //     'name' => 'Tech Arena Astana',
        //     'address' => 'Mangilik El 55',
        //     'latitude' => 51.090000,
        //     'longitude' => 71.418000,
        // ]);
        // $venues = Venue::all();
        // foreach ($venues as $venue) {
        //     Hall::create([
        //         'venue_id' => $venue->id,
        //         'name' => 'Main Hall',
        //         'capacity' => 150,
        //     ]);
        //     Hall::create([
        //         'venue_id' => $venue->id,
        //         'name' => 'Workshop Room',
        //         'capacity' => 50,
        //     ]);
        // }
        // $categoryTech = EventCategory::where('name', 'Technology')->first();
        // $categoryBusiness = EventCategory::where('name', 'Business')->first();
        // $venue = Venue::first();
        // $hall = Hall::where('venue_id', $venue->id)->first();
        // Event::create([
        //     'title' => 'Startup Networking Night',
        //     'description' => 'Free networking event for founders and developers.',
        //     'starts_at' => Carbon::now()->addDays(2),
        //     'venue_id' => $venue->id,
        //     'hall_id' => $hall->id,
        //     'category_id' => $categoryBusiness->id,
        //     'price' => null,
        //     'image' => 'events/networking.jpg',
        //     'max_participants' => 120,
        // ]);
        // Event::create([
        //     'title' => 'AI & Machine Learning Summit',
        //     'description' => 'Deep dive into AI & Machine and best practices.',
        //     'starts_at' => Carbon::now()->addDays(5),
        //     'venue_id' => $venue->id,
        //     'hall_id' => $hall->id,
        //     'category_id' => $categoryTech->id,
        //     'price' => 5000,
        //     'image' => 'events/laravel.jpg',
        //     'max_participants' => 80,
        // ]);
        $categories = EventCategory::pluck('id')->toArray();
        $posts = [
            [
                'title' => 'Upcoming Tech Events This Month',
                'content' => 'Discover the most exciting tech meetups, hackathons, and conferences happening this month in our venues.',
                'image' => 'posts/tech-events.jpg',
                'category_id' => $categories[array_rand($categories)] ?? null,
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Community Events: Why Offline Still Matters',
                'content' => 'Offline events help build stronger professional communities. Here’s why in-person events still matter.',
                'image' => 'posts/community.jpg',
                'category_id' => $categories[array_rand($categories)] ?? null,
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'Free Workshops and Meetups This Week',
                'content' => 'Join free workshops, lectures, and networking events happening across different cities.',
                'image' => 'posts/free-events.jpg',
                'category_id' => $categories[array_rand($categories)] ?? null,
                'created_at' => Carbon::now()->subDay(),
                'updated_at' => Carbon::now()->subDay(),
            ],
        ];
        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}