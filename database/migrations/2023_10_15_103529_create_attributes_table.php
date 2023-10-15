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
        Schema::create('attributes', function (Blueprint $table) {
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

        Schema::create('attribute_values', function (Blueprint $table) {
            $table->ulid()->primary();
            $table->string('name');
            $table->foreignUlid('attribute_ulid')
                ->references('ulid')
                ->on('attributes')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });

        Schema::create('product_attribute', function (Blueprint $table) {
            $table->ulid()->primary();
            $table->foreignUlid('attribute_ulid')
                ->references('ulid')
                ->on('attributes')
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
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('attribute_values');
        Schema::dropIfExists('product_attribute');
    }
};
