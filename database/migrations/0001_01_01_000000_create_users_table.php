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
            $table->boolean('ver_crud')->default(0);
            $table->boolean('crear_crud')->default(0);
            $table->boolean('modificar_crud')->default(0);
            $table->boolean('desactivar_crud')->default(0);
            $table->boolean('eliminar_crud')->default(0);
            $table->timestamps();

            $table->boolean('active')->default(1);
        });
        DB::table('rols')->insert([
            'nombre' => 'Root',
            'ver_crud' => 1,
            'crear_crud' => 1,
            'modificar_crud' => 1,
            'desactivar_crud' => 1,
            'eliminar_crud' => 1,
        ]);
        DB::table('rols')->insert([
            'nombre' => 'Jefe de Planta',
            'ver_crud' => 1,
            'crear_crud' => 1,
            'modificar_crud' => 1,
            'desactivar_crud' => 1,
        ]);
        DB::table('rols')->insert([
            'nombre' => 'Secretaria',
            'ver_crud' => 1,
            'crear_crud' => 1,
            'modificar_crud' => 1,
            'desactivar_crud' => 1,
        ]);
        DB::table('rols')->insert([
            'nombre' => 'Pasante',
            'ver_crud' => 1,
            'crear_crud' => 1,
            'modificar_crud' => 1,
            'desactivar_crud' => 1,
        ]);
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->date('nacimiento');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default(Hash::make('123abc'));
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedBigInteger('rol_fk');
            $table->foreign('rol_fk')->references('id')->on('rols')->onDelete('cascade');

            $table->boolean('active')->default(1);
        });
        DB::table('usuarios')->insert([
            'nombre' => 'Administrador',
            'apellido' => '',
            'nacimiento' => date("Y-m-d"),
            'email' => 'admin@system32.com',
            'password' => Hash::make('123abc'),
            'rol_fk' => 1,
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
