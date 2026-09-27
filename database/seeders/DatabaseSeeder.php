<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Semester;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Remove Old Demo Admin
        |--------------------------------------------------------------------------
        */

        User::where('email', 'admin@unisched.com')->delete();


        /*
        |--------------------------------------------------------------------------
        | Main Administrator
        |--------------------------------------------------------------------------
        */

        User::updateOrCreate(
            [
                'email' => env('ADMIN_EMAIL'),
            ],
            [
                'name' => 'Main Administrator',
                'password' => Hash::make(env('ADMIN_PASSWORD')),
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Semesters
        |--------------------------------------------------------------------------
        */

        for ($i = 1; $i <= 11; $i++) {

            Semester::updateOrCreate(
                [
                    'number' => $i,
                ],
                [
                    'name' => $this->ordinal($i) . ' Semester',
                    'is_active' => true,
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Time Slots
        |--------------------------------------------------------------------------
        */

        $timeSlots = [

            [
                'name' => 'Slot 1',
                'start_time' => '08:00:00',
                'end_time' => '09:20:00',
                'sort_order' => 1,
            ],

            [
                'name' => 'Slot 2',
                'start_time' => '09:30:00',
                'end_time' => '10:50:00',
                'sort_order' => 2,
            ],

            [
                'name' => 'Slot 3',
                'start_time' => '11:00:00',
                'end_time' => '12:20:00',
                'sort_order' => 3,
            ],

            [
                'name' => 'Slot 4',
                'start_time' => '13:00:00',
                'end_time' => '14:20:00',
                'sort_order' => 4,
            ],

            [
                'name' => 'Slot 5',
                'start_time' => '14:30:00',
                'end_time' => '15:50:00',
                'sort_order' => 5,
            ],

            [
                'name' => 'Slot 6',
                'start_time' => '16:00:00',
                'end_time' => '17:20:00',
                'sort_order' => 6,
            ],
        ];


        foreach ($timeSlots as $slot) {

            TimeSlot::updateOrCreate(
                [
                    'start_time' => $slot['start_time'],
                    'end_time' => $slot['end_time'],
                ],
                [
                    'name' => $slot['name'],
                    'sort_order' => $slot['sort_order'],
                    'is_active' => true,
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Rooms & Labs
        |--------------------------------------------------------------------------
        */

        $rooms = [

            ['401', 'Classroom 401', 'classroom'],
            ['402', 'Classroom 402', 'classroom'],
            ['403', 'Classroom 403', 'classroom'],
            ['404', 'Classroom 404', 'classroom'],
            ['405', 'Classroom 405', 'classroom'],

            ['413', 'Classroom 413', 'classroom'],
            ['414', 'Classroom 414', 'classroom'],
            ['415', 'Classroom 415', 'classroom'],
            ['416', 'Classroom 416', 'classroom'],
            ['417', 'Classroom 417', 'classroom'],
            ['418', 'Classroom 418', 'classroom'],

            ['701', 'Classroom 701', 'classroom'],
            ['702', 'Classroom 702', 'classroom'],
            ['703', 'Classroom 703', 'classroom'],
            ['704', 'Classroom 704', 'classroom'],

            ['215', 'Classroom 215', 'classroom'],
            ['216', 'Classroom 216', 'classroom'],

            ['B003', 'Classroom B003', 'classroom'],
            ['B004', 'Classroom B004', 'classroom'],
            ['B005', 'Classroom B005', 'classroom'],

            ['406', 'Computer Lab 406', 'computer_lab'],
            ['407', 'Computer Lab 407', 'computer_lab'],
            ['408', 'Computer Lab 408', 'computer_lab'],
            ['409', 'Computer Lab 409', 'computer_lab'],
            ['410', 'Computer Lab 410', 'computer_lab'],

            ['412', 'EEE Lab 412', 'eee_lab'],
            ['419', 'Physics Lab 419', 'physics_lab'],
        ];


        foreach ($rooms as $room) {

            Room::updateOrCreate(
                [
                    'room_number' => $room[0],
                ],
                [
                    'room_name' => $room[1],
                    'room_type' => $room[2],
                    'capacity' => null,
                    'is_active' => true,
                ]
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Semester Ordinal
    |--------------------------------------------------------------------------
    */

    private function ordinal(int $number): string
    {
        if (
            $number % 100 >= 11 &&
            $number % 100 <= 13
        ) {
            return $number . 'th';
        }

        return $number . match ($number % 10) {

            1 => 'st',

            2 => 'nd',

            3 => 'rd',

            default => 'th',
        };
    }
}