<?php

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
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->string('shipping_status')->after('price'); //PACKAGING|SHIPPING|SHIPPED
            $table->string('resi')->after('shipping_status');
            $table->softDeletes()->after('resi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->dropColumn('shipping_status'); //PACKAGING|SHIPPING|SHIPPED
            $table->dropColumn('resi');
            $table->dropColumn('deleted_at');
        });
    }
};
