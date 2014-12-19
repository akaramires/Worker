<?php

    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateUsersTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up ()
        {
            Schema::create('roles', function (Blueprint $table) {
                $table->increments('id');
                $table->string('slug')->unique();
                $table->string('name');
                $table->softDeletes();
                $table->timestamps();
            });

            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('wp_id');
                $table->string('username', 32)->unique();
                $table->string('email')->unique();
                $table->string('password', 60);
                $table->string('first_name', 32);
                $table->string('last_name', 32);
                $table->boolean('active');
                $table->integer('role_id')->unsigned();
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
                $table->rememberToken();
                $table->softDeletes();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down ()
        {
            Schema::drop('users');
            Schema::drop('roles');
        }

    }
