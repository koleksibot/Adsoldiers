<?php

use App\Libraries\Domain\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    protected $categories;

    public function __construct()
    {
        $this->categories = [
            'Cars & Vehicles',
            'Home & Garden',
            'Food & Drinks',
            'Entertainment',
            'Games',
            'Sport',
            'Health',
            'Travelling',
            'Business & Management',
            'Technology',
            'Beauty & Body Care',
            'News',
            'Kids',
        ];
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $category) {
            $this->creatLibrareisCategories($category);
        }
    }
    /**
     * Create_Lib_categories description
     *
     * @param [string] $category [array of string of  categories to create]
     *
     * @return [Library_categories Object] [create objects in librarry categories in DB]
     */
    public function creatLibrareisCategories($category)
    {
        Category::create(
            [
                'name' => $category,
                'cover_img' => '[\"img\\\/ad1.jpeg\"]',
            ]
        )->libraries()->attach($this->LibrariesIdGetter());
    }
    /**
     * LibrariesIdGetter get the number of id of created liberaries to attach them to categories
     *
     * @return Integer LibraryID
     */
    public function LibrariesIdGetter()
    {
        return  array_values(range(1, 30));
    }
}
