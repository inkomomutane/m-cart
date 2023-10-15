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
        Schema::create('shippings', function (Blueprint $table) {
            $table->ulid()->primary();
            $table->string('name');
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

        Schema::create('shipping_product', function (Blueprint $table) {

            $table->ulid()->primary();
            $table->double('ship_charge');
            $table->boolean('free')->default(false);
            $table->integer('estimated_days');

            $table->foreignUlid('shipping_ulid')
                ->references('ulid')
                ->on('shippings')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

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
        Schema::dropIfExists('shippings');
        Schema::dropIfExists('shipping_product');
    }
};
