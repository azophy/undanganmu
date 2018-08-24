<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // kosongkang dulu isi table
        DB::table('users')->truncate();

        // edit struktur table
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
            $table->string('username', 50)->unique();
            $table->integer('id_role')->default(0);
        });

        // isi ulang default account
        DB::table('users')->insert([
            [
                'name'     => 'Admin Account',
                'email'    => 'admin@undangan.mu', 
                'username' => 'admin',
                'password' => Hash::make('password'),
                'id_role'  => 10,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'password',
                'username',
                'id_role',
            ]);
        });
    }
}
