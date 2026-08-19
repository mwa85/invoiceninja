<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('custom_field_definitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id')->nullable()->index();
            $table->string('entity_type'); // client, invoice, quote, task, project, etc.
            $table->string('name');
            $table->string('label');
            $table->string('type')->default('text');
            $table->json('options')->nullable();
            $table->boolean('is_required')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['company_id','entity_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('custom_field_definitions');
    }
};
