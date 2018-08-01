<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //App\Tag::truncate();
        DB::table('tags')->delete();
        DB::table('post_tag')->truncate();
        $tags = config('project.tags');
        $shoplists = config ('project.shoplist');

        foreach($tags as $slug => $name) {
            App\Tag::create([
                'name' => $name[0],
                'category' => $name[1],
                'slug' => str_slug($slug)
            ]);
        }

        foreach($shoplists as $name => $nation) {
            App\Shoplist::create([
                'name' => $name,
                'category' => $nation[0],
                'nation' => $nation[1],
            ]);
        }

        $this->command->info('Seeded: tags table');

        $faker = app(Faker\Generator::class);
        $users = App\User::all();
        $posts = App\Post::all();
        $tags = App\Tag::all();

        foreach($posts as $post) {
            $post->tags()->sync(
                $faker->randomElements(
                    $tags->pluck('id')->toArray(), rand(1, 3)
                )
            );
        }
        $this->command->info('Seeded: post_tag table');
    }
}
