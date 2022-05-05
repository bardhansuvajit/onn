<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCategoryParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_parents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->tinyInteger('position')->default(0);
            $table->tinyInteger('status')->default(1)->comment('1: active, 0: inactive');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        $data = [
            ['name' => 'Innerwear', 'slug' => 'innerwear', 'position' => 1],
            ['name' => 'Outerwear', 'slug' => 'outerwear', 'position' => 2],
            ['name' => 'Winter wear', 'slug' => 'winter-wear', 'position' => 3],
            ['name' => 'Footkins', 'slug' => 'footkins', 'position' => 4],
        ];

        DB::table('category_parents')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_parents');
    }
}
