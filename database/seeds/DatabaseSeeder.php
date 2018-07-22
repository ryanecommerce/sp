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
        DB::table('tags_news')->delete();
        DB::table('post_tag')->truncate();
        DB::table('news_tag')->truncate();
        $tags = config('project.tags');
        $tags_news = config('project.tags_news');

        foreach($tags as $slug => $name) {
            App\Tag::create([
                'name' => $name,
                'slug' => str_slug($slug)
            ]);
        }

        foreach($tags_news as $slug => $name) {
            App\Tag_news::create([
                'name' => $name,
                'slug' => str_slug($slug)
            ]);
        }

        $this->command->info('Seeded: tags table');

        $faker = app(Faker\Generator::class);
        $users = App\User::all();
        $posts = App\Post::all();
        $tags = App\Tag::all();
        $tags_news = App\Tag_news::all();


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
