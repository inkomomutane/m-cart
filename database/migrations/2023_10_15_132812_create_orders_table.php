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
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->ulid()->primary();
            $table->string('name');
            $table->string('color');
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

        Schema::create('orders', function (Blueprint $table) {
            $table->ulid()->primary();
            $table->foreignIdFor(User::class, 'costumer_ulid')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignUlid('coupon_ulid')
                ->references('ulid')
                ->on('coupons')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignUlid('status_ulid')
                ->references('ulid')
                ->on('order_statuses')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->dateTime('approved_at');
            $table->dateTime('delivered_to_carrier_at')->nullable();
            $table->dateTime('delivered_to_costumer_at')->nullable();
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->ulid()->primary();
            $table->double('price');
            $table->integer('quantity');
            $table->foreignUlid('order_ulid')
                ->references('ulid')
                ->on('orders')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignUlid('product_ulid')
                ->references('ulid')
                ->on('products')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignUlid('shipping_ulid')
                ->nullable()
                ->references('ulid')
                ->on('shippings')
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
        Schema::dropIfExists('order_statuses');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_items');
    }
};
