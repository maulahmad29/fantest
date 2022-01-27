<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpresenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epresences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users')->nullable()->index();
            $table->string('type', 3);
            $table->boolean('is_approve')->default(false);
            $table->timestamp('waktu');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('epresence');
    }
}
