<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('config_biayas', function (Blueprint $table) {
            // Menambahkan kolom jenjang_id yang merujuk ke tabel config_jenjangs
            $table->uuid('jenjang_id')->nullable()->after('jalur_id');

            // Menambahkan foreign key constraint
            $table->foreign('jenjang_id')
                  ->references('id')
                  ->on('config_jenjangs')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('config_biayas', function (Blueprint $table) {
            // Menghapus foreign key constraint dan kolom jenjang_id
            $table->dropForeign(['jenjang_id']);
            $table->dropColumn('jenjang_id');
        });
    }
};
