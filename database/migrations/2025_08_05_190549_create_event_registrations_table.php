<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');//Event_id adında bir yabancı anahtar (foreign key) oluştur, bu anahtar events tablosunun id sütununa bağlansın (constrained)
                                                                                            // ve eğer bağlı olduğu kayıt silinirse (onDelete), bu kaydı da otomatik olarak sil (cascade)"
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled'])->default('pending');//beklemede,onaylandı,reddedildi,iptal edildi
            $table->text('notes')->nullable();
            $table->datetime('registered_at');

            $table->timestamps();
            $table->unique(['event_id', 'user_id']); // Aynı etkinliğe aynı kişinin birden fazla başvuru engeli

        });

    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
