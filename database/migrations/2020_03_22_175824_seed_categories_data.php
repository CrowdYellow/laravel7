<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \Illuminate\Support\Facades\DB;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'name'        => 'PHP',
                'description' => 'PHP',
            ],
            [
                'name'        => '前端',
                'description' => '前端',
            ],
            [
                'name'        => 'GO',
                'description' => 'GO',
            ],
            [
                'name'        => '分享',
                'description' => '分享创造，分享发现',
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
}
