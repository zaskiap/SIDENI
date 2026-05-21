<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama', 100)->nullable()->after('name');
            $table->string('jenis_kelamin', 20)->nullable()->after('nama');
            $table->boolean('faktor_alkohol')->default(false)->after('jenis_kelamin');
            $table->boolean('faktor_berganti_pasangan')->default(false)->after('faktor_alkohol');
            $table->boolean('faktor_jarum_suntik')->default(false)->after('faktor_berganti_pasangan');
            $table->boolean('faktor_seks_tanpa_kondom')->default(false)->after('faktor_jarum_suntik');
        });
    }
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nama','jenis_kelamin','faktor_alkohol','faktor_berganti_pasangan','faktor_jarum_suntik','faktor_seks_tanpa_kondom']);
        });
    }
};
