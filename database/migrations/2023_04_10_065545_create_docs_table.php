<?php

use App\Models\Department;
use App\Models\Extension;
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
        Schema::create('docs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('author_id');
            $table->string('file');
            $table->foreignIdFor(Department::class)->constrained();
            $table->foreignIdFor(Extension::class)->constrained();
            $table->unsignedBigInteger('download_count')->default(0);
            $table->boolean('is_published')->default(1);
            $table->date('published_date')->default(now());
            $table->date('unpublished_date')->nullable();
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docs');
    }
};
