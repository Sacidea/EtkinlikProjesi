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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('location');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->datetime('registration_start');//kayıt başlangıç tarihi
            $table->datetime('registration_end');
            $table->integer('max_participants')->nullable();
            $table->decimal('price', 8, 2)->default(0);
            $table->enum('status', ['draft', 'published', 'cancelled'])->default('draft');//durum(taslak,yaınlandı,iptal edildi)
            $table->foreignId('organizer_id')->constrained('users');//Bu tabloya organizer_id adında bir yabancı anahtar ekle ve bu alanın değerlerinin users tablosunun id sütununda bulunmasını zorunlu kılar
            $table->timestamps();//created_at ve updated_at sütunlarını ekler
            $table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
