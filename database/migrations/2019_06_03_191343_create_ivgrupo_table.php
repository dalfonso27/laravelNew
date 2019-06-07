<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIvgrupoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ivgrupo', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('grupo',20)->unique();
            $table->string('containv',15)->nullable();
            $table->string('contacosto',15)->nullable();
            $table->string('contaventa',15)->nullable();
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
        Schema::dropIfExists('ivgrupo');
    }
}
