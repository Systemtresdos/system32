<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rols', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('cargo');
            $table->timestamps();
        });
        DB::table('rols')->insert([
            'nombre' => 'Cliente',
            'cargo' => 'Usuario sin ningun permiso administrativo.',
        ]);
        DB::table('rols')->insert([
            'nombre' => 'Empleado',
            'cargo' => 'Usuario con acceso a crud, solo puede ver, editar y  modificar datos.',
        ]);
        DB::table('rols')->insert([
            'nombre' => 'Administrador',
            'cargo' => 'Usuario con acceso y control total al crud.',
        ]);
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->date('nacimiento');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedBigInteger('rol_fk');
            $table->foreign('rol_fk')->references('id')->on('rols')->onDelete('cascade');
        });
        DB::table('usuarios')->insert([
            'nombre' => 'Administrador',
            'apellido' => '',
            'nacimiento' => date("Y-m-d"),
            'email' => 'admin@system32.com',
            'password' => Hash::make('123abc'),
            'rol_fk' => 3,
        ]);
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
