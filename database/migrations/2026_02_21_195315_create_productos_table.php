<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');      
            $table->string('nombre');         
            $table->text('descripcion');      
            $table->decimal('precio', 10, 2);
            
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('proveedor_id');
            
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
            
            $table->foreign('categoria_id')->references('id')->on('categorias')->restrictOnDelete();
            $table->foreign('marca_id')->references('id')->on('marcas')->restrictOnDelete();
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
