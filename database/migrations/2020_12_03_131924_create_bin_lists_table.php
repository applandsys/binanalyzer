<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBinListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bin_lists', function (Blueprint $table) {
            $table->id();
            $table->string("binprefix");
            $table->string("country",50)->nullable();
            $table->string("bank",200)->nullable();
            $table->string("brand",20)->nullable();
            $table->string("type",20)->nullable();
            $table->string("sub_brand",100)->nullable();
            $table->enum('prepaid', ['yes', 'no','unchecked'])->default('unchecked');
			$table->string("comments")->nullable();
			$table->enum('binlist', ['yes', 'no','unchecked'])->default('unchecked');
			$table->enum('bankbinlist', ['yes', 'no','unchecked'])->default('unchecked');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bin_lists');
    }
}
