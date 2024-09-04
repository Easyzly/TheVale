<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Scene;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // Initial Scene - Waking Up
        $scene1 = Scene::create([
            'title' => 'Waking Up',
            'description' => 'You wake up early in the morning, the sun shining through your window. Today is the day of the grand celebration at the castle.',
            'button' => 'Go to the Castle',
            'help' => 'Either option leads to a different path to adventure'
        ]);

        $scene1a = Scene::create([
            'title' => 'Head to the City/Town',
            'description' => 'Instead of going to the castle, you decide to visit the city/town. The streets are bustling with activity.',
            'button' => 'Go to the City/Town',
            'parent_id' => $scene1->id,
            'help' => 'Working from 9 to 5 will never bring you anywhere so consider your choice'
        ]);

        // Castle Path
        $scene2 = Scene::create([
            'title' => 'Entering the Castle',
            'description' => 'You arrive at the castle, where the celebration is in full swing. The air is filled with laughter, music, and the smell of roasted meats.',
            'button' => 'Enter the Castle',
            'parent_id' => $scene1->id,
            'help' => 'You should enter the great hall'
        ]);

        $scene3 = Scene::create([
            'title' => 'A Dangerous Encounter',
            'description' => 'As you explore the castle, you suddenly notice a thief about to attack Lady Lyca. You have a split second to decide what to do.',
            'button' => 'Enter the great hall',
            'parent_id' => $scene2->id,
            'help' => 'Walk the path of a knight or seek your opportunities right'
        ]);

        $scene3a = Scene::create([
            'title' => 'Let the Thief Kill Lyca',
            'description' => 'You decide to do nothing and let the thief carry out his plan.',
            'button' => 'Let Lyca Die',
            'parent_id' => $scene3->id,
        ]);

        $scene3b = Scene::create([
            'title' => 'Help the Thief',
            'description' => 'You decide to help the thief, seeing this as an opportunity to take control of the situation.',
            'button' => 'Help the Thief',
            'parent_id' => $scene3->id,
        ]);

        // Outcomes
        $scene4 = Scene::create([
            'title' => 'Knighted for Bravery',
            'description' => 'You save Lady Lyca, and in gratitude, she has you knighted. You have won great honor!',
            'button' => 'Save Lyca',
            'parent_id' => $scene3->id,
        ]);

        $scene5 = Scene::create([
            'title' => 'The Moon Door',
            'description' => 'Lady Lyca is dead. You are captured and brought to the Moon Door, where you are thrown out into the abyss.',
            'button' => 'Meet Your Fate',
            'parent_id' => $scene3a->id,
            'redirect_id' => $scene1->id, // Loop back to the start
            'button_redirect' => 'Start Over',
        ]);

        $scene6 = Scene::create([
            'title' => 'Crowned King',
            'description' => 'With Lyca dead by your hand, you seize control and are crowned king. Power is now yours!',
            'button' => 'Rule as King',
            'parent_id' => $scene3b->id,
        ]);

        // City/Town Path
        $scene2a = Scene::create([
            'title' => 'Visit the Bar',
            'description' => 'You enter a local bar, where you see a thief causing trouble. You can either confront him or talk to him.',
            'button' => 'Go to the Bar',
            'parent_id' => $scene1a->id,
        ]);

        $scene2b = Scene::create([
            'title' => 'Go to Work',
            'description' => 'You decide to head to work. After a long day, you go back home to sleep and start the day again.',
            'button' => 'Go to Work',
            'parent_id' => $scene1a->id,
            'redirect_id' => $scene1->id, // Start over after work
            'button_redirect' => 'Start Over',
        ]);

        $scene3c = Scene::create([
            'title' => 'Confront the Thief',
            'description' => 'You decide to confront the thief. A fight breaks out, and you emerge victorious, earning the respect of the townsfolk. You are later knighted for your bravery.',
            'button' => 'Arrest the thief',
            'parent_id' => $scene2a->id,
        ]);

        $scene3d = Scene::create([
            'title' => 'Talk to the Thief',
            'description' => 'You talk to the thief and learn of his plan to kill Lady Lyca at the castle. You decide to join him.',
            'button' => 'Join the Thief',
            'parent_id' => $scene2a->id,
            'redirect_id' => $scene3->id,
            'button_redirect' => 'Enter the hall',
            'help' => 'Either option leads to a different path to adventure'
        ]);

        // Outcomes from Talking to the Thief
        $scene4a = Scene::create([
            'title' => 'Save lyca',
            'description' => 'You and snitch on the thief and become a knight of the vale',
            'button' => 'Snitch on the thief',
            'parent_id' => $scene3d->id,
        ]);
    }
}
