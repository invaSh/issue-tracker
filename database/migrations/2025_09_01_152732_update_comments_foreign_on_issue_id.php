<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['issue_id']);

            $table->foreign('issue_id')
                ->references('id')
                ->on('issues')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        //
    }
};
