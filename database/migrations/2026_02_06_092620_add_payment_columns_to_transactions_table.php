<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
             if (!Schema::hasColumn('transactions', 'invoice_code')) {
                $table->string('invoice_code')->nullable()->after('id');
            }    

            $table->decimal('cash_amount', 15, 2)->default(0)->after('total');
            $table->decimal('change_amount', 15, 2)->default(0)->after('cash_amount');
            $table->string('payment_method', 20)->default('cash')->after('change_amount');
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
             $columns = ['cash_amount', 'change_amount', 'payment_method'];
            if (Schema::hasColumn('transactions', 'invoice_code')) {
                $columns[] = 'invoice_code';
            }
            $table->dropColumn($columns);
        });
    }
};