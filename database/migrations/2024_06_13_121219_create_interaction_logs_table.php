<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_interaction_logs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteractionLogsTable extends Migration
{
    public function up()
    {
        Schema::create('interaction_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('contact_id')->constrained()->onDelete('cascade');
            $table->string('type'); // Type d'interaction (email, appel, réunion, etc.)
            $table->timestamp('interaction_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('interaction_logs');
    }
}
