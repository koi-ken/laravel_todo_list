<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('users', function (Blueprint $table) {
	        $table->increments('id');
	        $table->string('email', 255)->unique();
	        $table->string('username',255)->unique();
	        $table->string('password', 255)->nullable();
	        $table->text('profile')->nullable();
	        $table->rememberToken();
	        $table->boolean('delete_flug')->default(false);
	        $table->timestamp('created_at', $precision=0);
	        $table->timestamp('updated_at', $precision=0)->nullable();
	        $table->timestamp('deleted_at', $precision=0)->nullable();
	    });

	    Schema::create('tasks', function (Blueprint $table) {
	        $table->increments('id');
	        $table->text('task');
	        $table->boolean('finished_task')->default(false);
	        $table->boolean('delete_flug')->default(false);
	        $table->timestamp('created_at', $precision=0);
	        $table->timestamp('updated_at', $precision=0)->nullable();
	        $table->timestamp('deleted_at', $precision=0)->nullable();
	        //$table->unsignedBigInteger('user_id');
					$table->unsignedInteger('user_id');
	        $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
	    });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    // 外部キー制約をつけているので、参照元から先に削除しないと、エラーになるので注意
    Schema::dropIfExists('tasks');
    Schema::dropIfExists('users');
		}
};
