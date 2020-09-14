<?php

use Illuminate\Database\Seeder;

class TimeSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('time_slots')->insert([
            [
                'start_time' => 8,
                'end_time' => 10,
                'shift' => 'Morning',
            ],
            [
            'start_time' => 10,
            'end_time' => 12,
            'shift' => 'Morning',
        ],
            [
                'start_time' => 12,
                'end_time' => 2,
                'shift' => 'Morning',
            ],
            [
                'start_time' => 2,
                'end_time' => 4,
                'shift' => 'Evening',
            ],
            [
                'start_time' => 4,
                'end_time' => 6,
                'shift' => 'Evening',
            ],
            [
                'start_time' => 6,
                'end_time' => 8,
                'shift' => 'Evening',
            ],
            [
                'start_time' => 8,
                'end_time' => 10,
                'shift' => 'Night',
            ],
            [
                'start_time' => 10,
                'end_time' => 12,
                'shift' => 'Night',
            ]

        ]);
    }
}
