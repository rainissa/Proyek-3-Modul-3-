<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('activity_date');
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->string('location', 100)->nullable();
            $table->unsignedInteger('capacity')->nullable();
        });
        Schema::table('activities', function (Blueprint $table) {
            $table->string('status', 20)->default('draft')->change();
        });
    }

    public function down(): void
    {
    Schema::table('activities', function (Blueprint $table) {
        $table->dropColumn(['start_at', 'end_at', 'location', 'capacity']);
        $table->date('activity_date')->nullable();
    });

    Schema::table('activities', function (Blueprint $table) {
        $table->string('status', 20)->default('Planned')->change();
    });
}
};
