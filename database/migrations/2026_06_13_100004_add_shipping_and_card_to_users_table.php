<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->text('address')->nullable()->after('phone');
            $table->string('card_nickname')->nullable()->after('address');
            $table->string('card_last_four')->nullable()->after('card_nickname');
            $table->string('card_expiry')->nullable()->after('card_last_four');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'address', 'card_nickname', 'card_last_four', 'card_expiry']);
        });
    }
};
