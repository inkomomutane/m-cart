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
        Schema::create('products', function (Blueprint $table) {
            $table->ulid()->primary();
            $table->string('name');
            $table->string('sku');
            $table->double('regular_price')->default(0);
            $table->double('discount_price')->default(0);
            $table->integer('quantity')->default(0);
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->double('weight')->default(0);
            $table->boolean('published')->default(false);
            $table->foreignIdFor(User::class, 'published_by')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('products');
    }
};
