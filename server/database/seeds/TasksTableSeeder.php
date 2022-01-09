<?php

use App\Tasks\Domain\Models\Task;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create([
            'title' => 'Tutorial Task',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio cumque ratione beatae dolores dolorum. Molestias sed, neque ullam, eaque quasi laudantium ipsa officiis, exercitationem nesciunt perspiciatis sequi vitae maxime ab.',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio cumque ratione beatae dolores dolorum. Molestias sed',
            'media' => ["videos/XKTNfPMikiF4PKn5XIfSmBrglHhav4644NZ2b4w4.mp4"],
            'media_type' => 'video',
            'type' => 'tutorial',
        ]);
        Task::create([
            'title' => 'Library Task',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio cumque ratione beatae dolores dolorum. Molestias sed, neque ullam, eaque quasi laudantium ipsa officiis, exercitationem nesciunt perspiciatis sequi vitae maxime ab.',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio cumque ratione beatae dolores dolorum. Molestias sed',
            'media' => ["img/9NLX91evBUR3jyOKeDtT5DR6DKFRrCsVaPHOtA9O.jpeg"],
            'media_type' => 'image',
            'type' => 'library',
        ]);
        Task::create([
            'title' => 'Ad Task',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio cumque ratione beatae dolores dolorum. Molestias sed, neque ullam, eaque quasi laudantium ipsa officiis, exercitationem nesciunt perspiciatis sequi vitae maxime ab.',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio cumque ratione beatae dolores dolorum. Molestias sed',
            'media' => ["img/9NLX91evBUR3jyOKeDtT5DR6DKFRrCsVaPHOtA9O.jpeg"],
            'media_type' => 'image',
            'type' => 'library',
        ]);
    }
}
