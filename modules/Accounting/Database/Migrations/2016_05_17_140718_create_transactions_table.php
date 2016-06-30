<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->decimal('amount', 12, 2);
            $table->enum('type', ['Income', 'Expense']);
            $table->date('date');
            $table->tinyInteger('category_id');
            $table->tinyInteger('account_id');
            $table->string('description', 200);
            $table->boolean('verified')->unsigned()->default(0);
            $table->smallInteger('created_by');
            $table->smallInteger('modified_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }

}
