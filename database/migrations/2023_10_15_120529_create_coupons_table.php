<?php

use App\Models\User;
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
        Schema::create('coupons', function (Blueprint $table) {
            $table->ulid()->primary();
            $table->string('code')->unique();
            $table->string('description');
            $table->double('discount_value');
            $table->string('discount_type');
            $table->integer('time_used');
            $table->integer('max_usage');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->foreignIdFor(User::class, 'created_by')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignIdFor(User::class, 'updated_by')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });

        Schema::create('product_coupon', function (Blueprint $table) {
            $table->ulid()->primary();
            $table->foreignUlid('product_ulid')
                ->references('ulid')
                ->on('products')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
        Schema::dropIfExists('product_coupon');
    }
};
