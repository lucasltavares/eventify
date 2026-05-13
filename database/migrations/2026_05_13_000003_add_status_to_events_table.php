<?php

use App\Models\Event;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('status')->default(Event::STATUS_SCHEDULED)->after('is_active');
        });

        DB::table('events')
            ->whereDate('event_date', '<', today())
            ->update(['status' => Event::STATUS_FINISHED]);

        DB::table('events')
            ->whereDate('event_date', '>=', today())
            ->update(['status' => Event::STATUS_SCHEDULED]);
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
