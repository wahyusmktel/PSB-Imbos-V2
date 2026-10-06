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
        Schema::table('config_ppdbs', function (Blueprint $table) {
            $table->string('no_wa_humas')->nullable()->after('link_group_sma'); // Tambahkan kolom no_wa_humas setelah status
        });
    }

    public function down()
    {
        Schema::table('config_ppdbs', function (Blueprint $table) {
            $table->dropColumn('no_wa_humas'); // Hapus kolom jika rollback
        });
    }
};
