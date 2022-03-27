2022_03_26_081635_create_star_records_table<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('share_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('share_user_id');
            $table->bigInteger('from_user_id');
            $table->bigInteger('post_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('share_posts');
    }
}
