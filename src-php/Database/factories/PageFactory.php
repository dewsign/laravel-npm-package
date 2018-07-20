<?php

use Faker\Generator as Faker;
use Maxfactor\CMS\Pages\Models\Page;

$factory->define(Page::class, function (Faker $faker) {
    $name = $faker->sentence($words = 4);

    $featured_image = [
        'content' => [
            'image_id' => 'sample',
            'image_ext' => 'jpg',
        ],
        'image_alt' => __('Alt Text'),
    ];

    $page_content = [
        [
            'id' => 1,
            'order' => 1,
            'type' => 'textarea',
            'label' => 'Body',
            'name' => 'body',
            'content' => $faker->paragraph(10),
        ],
    ];

    return [
        'name' => $faker->sentence(),
        'slug' => str_slug($name),
        'priority' => $faker->boolean ? $faker->unique()->numberBetween(0, 1000) : 0,
        'sort' => $faker->boolean ? $faker->unique()->numberBetween(0, 100) : 0,
        'active' => $faker->boolean(),
        'featured_image' => $faker->boolean ? $featured_image : null,
        'page_content' => $page_content,
    ];
});
