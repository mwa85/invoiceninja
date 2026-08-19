<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Add custom_fields json column to entities that currently use custom_value1..4
        Schema::table('clients', function (Blueprint $table) {
            if (! Schema::hasColumn('clients', 'custom_fields')) {
                $table->json('custom_fields')->nullable()->after('custom_value4');
            }
        });

        Schema::table('invoices', function (Blueprint $table) {
            if (! Schema::hasColumn('invoices', 'custom_fields')) {
                $table->json('custom_fields')->nullable()->after('custom_value4');
            }
        });

        Schema::table('quotes', function (Blueprint $table) {
            if (! Schema::hasColumn('quotes', 'custom_fields')) {
                $table->json('custom_fields')->nullable()->after('custom_value4');
            }
        });

        Schema::table('tasks', function (Blueprint $table) {
            if (! Schema::hasColumn('tasks', 'custom_fields')) {
                $table->json('custom_fields')->nullable()->after('custom_value4');
            }
        });

        Schema::table('projects', function (Blueprint $table) {
            if (! Schema::hasColumn('projects', 'custom_fields')) {
                $table->json('custom_fields')->nullable()->after('custom_value4');
            }
        });

        // Add to other entities if needed in follow-up commits
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            if (Schema::hasColumn('clients', 'custom_fields')) {
                $table->dropColumn('custom_fields');
            }
        });

        Schema::table('invoices', function (Blueprint $table) {
            if (Schema::hasColumn('invoices', 'custom_fields')) {
                $table->dropColumn('custom_fields');
            }
        });

        Schema::table('quotes', function (Blueprint $table) {
            if (Schema::hasColumn('quotes', 'custom_fields')) {
                $table->dropColumn('custom_fields');
            }
        });

        Schema::table('tasks', function (Blueprint $table) {
            if (Schema::hasColumn('tasks', 'custom_fields')) {
                $table->dropColumn('custom_fields');
            }
        });

        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'custom_fields')) {
                $table->dropColumn('custom_fields');
            }
        });
    }
};
