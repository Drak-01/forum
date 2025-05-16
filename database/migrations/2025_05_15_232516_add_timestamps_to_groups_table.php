<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::table('groups', function (Blueprint $table) {
        $table->timestamps(); // ajoute created_at et updated_at
    });
}

public function down()
{
    Schema::table('groups', function (Blueprint $table) {
        $table->dropTimestamps();
    });
}

};
