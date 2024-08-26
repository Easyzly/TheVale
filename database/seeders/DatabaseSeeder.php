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

        // Initial Scene
        $scene1 = Scene::create([
            'title' => 'The Eyrie Entrance',
            'description' => 'You stand before the imposing gates of The Eyrie, the ancestral seat of House Arryn.',
            'button' => 'Enter The Eyrie',
            'parent_id' => null,
            'redirect_id' => null,
            'button_redirect' => null,
        ]);

// Scene 2: Inside The Eyrie
        $scene2 = Scene::create([
            'title' => 'The Great Hall',
            'description' => 'You enter the Great Hall. Lords and Ladies of the Vale are gathered, discussing the future of the realm.',
            'button' => 'Approach the High Table',
            'parent_id' => $scene1->id,
            'redirect_id' => null,
            'button_redirect' => null,
        ]);

// Scene 3: Meet Lady Lysa
        $scene3 = Scene::create([
            'title' => 'Meeting with Lady Lysa Arryn',
            'description' => 'Lady Lysa Arryn sits upon the high seat, her eyes sharp as she assesses you.',
            'button' => 'Speak with Lady Lysa',
            'parent_id' => $scene2->id,
            'redirect_id' => null,
            'button_redirect' => null,
        ]);

// Scene 4: The Moon Door
        $scene4 = Scene::create([
            'title' => 'The Moon Door',
            'description' => 'The infamous Moon Door opens before you, a direct drop into the sky. Lysa watches with a calculating gaze.',
            'button' => 'Look into the abyss',
            'parent_id' => $scene3->id,
            'redirect_id' => $scene1->id,
            'button_redirect' => 'You died, try again',
        ]);

// Scene 5: Choice - Loyalist or Rebel
        $scene5a = Scene::create([
            'title' => 'Pledge Loyalty to House Arryn',
            'description' => 'You kneel before Lady Lysa, pledging your loyalty to House Arryn and The Vale.',
            'button' => 'Pledge Loyalty',
            'parent_id' => $scene3->id,
            'redirect_id' => null,
            'button_redirect' => null,
        ]);

        $scene5b = Scene::create([
            'title' => 'Defy House Arryn',
            'description' => 'You declare that the rule of House Arryn must end, challenging Lady Lysa\'s authority.',
            'button' => 'Defy Lady Lysa',
            'parent_id' => $scene3->id,
            'redirect_id' => null,
            'button_redirect' => null,
        ]);

// Scene 6: After Loyalty or Defiance
        $scene6a = Scene::create([
            'title' => 'Rewarded for Loyalty',
            'description' => 'Lady Lysa rewards your loyalty, granting you a place of honor in her court.',
            'button' => 'Accept the honor',
            'parent_id' => $scene5a->id,
            'redirect_id' => null,
            'button_redirect' => null,
        ]);

        $scene6b = Scene::create([
            'title' => 'Punished for Defiance',
            'description' => 'Lady Lysa orders you to be thrown through the Moon Door for your defiance.',
            'button' => 'Meet your fate',
            'parent_id' => $scene5b->id,
            'redirect_id' => $scene4->id, // Redirect to Moon Door scene
            'button_redirect' => 'Return to the Moon Door',
        ]);

// Additional Scenes

// Scene 7: Secret Meeting
        $scene7 = Scene::create([
            'title' => 'A Secret Meeting',
            'description' => 'A servant quietly pulls you aside, revealing a secret passage leading to a hidden chamber where a mysterious figure awaits.',
            'button' => 'Follow the Servant',
            'parent_id' => $scene2->id,
            'redirect_id' => null,
            'button_redirect' => null,
        ]);

// Scene 8: Meet the Mysterious Figure
        $scene8 = Scene::create([
            'title' => 'The Mysterious Figure',
            'description' => 'In the hidden chamber, a cloaked figure offers you an alternative path. They suggest overthrowing Lysa and taking control of the Vale.',
            'button' => 'Consider the offer',
            'parent_id' => $scene7->id,
            'redirect_id' => null,
            'button_redirect' => null,
        ]);

// Scene 9a: Alliance with the Mysterious Figure
        $scene9a = Scene::create([
            'title' => 'Forge an Alliance',
            'description' => 'You agree to ally with the mysterious figure, beginning a plot to overthrow Lady Lysa.',
            'button' => 'Begin the plot',
            'parent_id' => $scene8->id,
            'redirect_id' => null,
            'button_redirect' => null,
        ]);

// Scene 9b: Refuse the Offer
        $scene9b = Scene::create([
            'title' => 'Refuse the Offer',
            'description' => 'You decline the offer and decide to remain loyal to House Arryn.',
            'button' => 'Return to the Great Hall',
            'parent_id' => $scene8->id,
            'redirect_id' => $scene2->id,
            'button_redirect' => 'Back to the Great Hall',
        ]);

// Scene 10a: Successful Coup
        $scene10a = Scene::create([
            'title' => 'The Coup Succeeds',
            'description' => 'Your alliance succeeds in overthrowing Lady Lysa. You now control the Vale, but new challenges lie ahead.',
            'button' => 'Prepare for the challenges',
            'parent_id' => $scene9a->id,
            'redirect_id' => null,
            'button_redirect' => null,
        ]);

// Scene 10b: Betrayed by the Mysterious Figure
        $scene10b = Scene::create([
            'title' => 'Betrayed',
            'description' => 'The mysterious figure betrays you at the last moment, revealing their true allegiance to Lady Lysa. You are captured and taken to the Moon Door.',
            'button' => 'attack the Moon Door',
            'parent_id' => $scene9a->id,
            'redirect_id' => $scene4->id, // Redirect to Moon Door scene
            'button_redirect' => 'Return to the Moon Door',
        ]);

// Scene 11: Endings based on Loyalty
        $scene11a = Scene::create([
            'title' => 'A Loyalist\'s Reward',
            'description' => 'Your unwavering loyalty to House Arryn earns you a prestigious position, securing your place in the Vale\'s history.',
            'button' => 'Embrace your destiny',
            'parent_id' => $scene6a->id,
            'redirect_id' => null,
            'button_redirect' => null,
        ]);

        $scene11b = Scene::create([
            'title' => 'A Rebel\'s Fall',
            'description' => 'Your rebellion against Lady Lysa leads to your demise, as you fall through the Moon Door into the abyss.',
            'button' => 'Meet your end',
            'parent_id' => $scene6b->id,
            'redirect_id' => $scene4->id, // Redirect to Moon Door scene
            'button_redirect' => 'Return to the Moon Door',
        ]);

    }
}
