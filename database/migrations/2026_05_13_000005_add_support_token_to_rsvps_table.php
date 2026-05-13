<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rsvps', function (Blueprint $table) {
            $table->string('support_token')->nullable()->unique()->after('status');
        });

        DB::table('rsvps')->select('id')->orderBy('id')->lazy()->each(function ($rsvp) {
            DB::table('rsvps')
                ->where('id', $rsvp->id)
                ->update(['support_token' => Str::random(40)]);
        });

    }

    public function down(): void
    {
        Schema::table('rsvps', function (Blueprint $table) {
            $table->dropUnique(['support_token']);
            $table->dropColumn('support_token');
        });
    }
};
