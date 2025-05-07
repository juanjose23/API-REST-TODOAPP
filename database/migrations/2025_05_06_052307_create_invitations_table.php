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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('role')->default('member'); // Puedes agregar un rol de invitado
            $table->enum('status', ['pending', 'accepted', 'declined'])->default('pending'); // Estado de la invitación
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('invitations');
    }
    
};
