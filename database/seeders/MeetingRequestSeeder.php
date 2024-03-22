<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MeetingRequest;

class MeetingRequestSeeder extends Seeder
{
    public function run()
    {
        MeetingRequest::create([
            'name' => 'Team Meeting',
            'place' => 'Conference Room A',
            'start_date' => '2024-03-25',
            'start_time' => '09:00:00',
        ]);

        MeetingRequest::create([
            'name' => 'Client Presentation',
            'place' => 'Board Room',
            'start_date' => '2024-04-01',
            'start_time' => '14:30:00',
        ]);
    }
}
