<?php

namespace Maxfactor\CMS\Pages\Database\Seeds;

use Illuminate\Database\Seeder;
use Maxfactor\CMS\Pages\Models\Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Primary pages
        $primary_pages = factory(Page, 10)->create();

        // Secondary pages
        $secondary_pages = factory(Page, 10)->create()->each(function ($page) use ($primary_pages) {
            $page->update([
                'parent_id' => $primary_pages->random()->id,
            ]);
        });

        // Tertiary pages
        factory(Page, 10)->create()->each(function ($page) use ($secondary_pages) {
            $page->update([
                'parent_id' => $secondary_pages->random()->id,
            ]);
        });

        // Create a homepage template to make front-end work
        factory(Page)->create([
            'name' => 'Homepage',
            'slug' => 'homepage',
            'active' => true,
        ]);
    }
}
