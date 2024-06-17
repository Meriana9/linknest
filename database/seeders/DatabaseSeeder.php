<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Group;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Création des utilisateurs
        User::factory(10)->create()->each(function ($user) {
            // Création de contacts pour chaque utilisateur
            $contacts = Contact::factory(10)->create(['user_id' => $user->id]);

            // Création des catégories et des tags
            //$categories = Category::factory(5)->create();
            $tags = Tag::factory(10)->create();

            foreach ($contacts as $contact) {
                // Assigner des catégories et des tags aux contacts
                /* $contact->categories()->attach(
                    $categories->random(2)->pluck('id')->toArray()
                ) */;
                $contact->tags()->attach(
                    $tags->random(3)->pluck('id')->toArray()
                );
            }
        });

        // Création des groupes
        Group::factory(5)->create();
    }
}
