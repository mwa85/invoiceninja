<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Backfill existing custom_value1..4 into custom_fields and create mapping definitions
        // We'll create a default definition per company per entity for the legacy custom fields (custom1..custom4)

        // Entities to process
        $entities = [
            'clients' => ['model' => 'client', 'columns' => ['custom_value1','custom_value2','custom_value3','custom_value4']],
            'invoices' => ['model' => 'invoice', 'columns' => ['custom_value1','custom_value2','custom_value3','custom_value4']],
            'quotes' => ['model' => 'quote', 'columns' => ['custom_value1','custom_value2','custom_value3','custom_value4']],
            'tasks' => ['model' => 'task', 'columns' => ['custom_value1','custom_value2','custom_value3','custom_value4']],
            'projects' => ['model' => 'project', 'columns' => ['custom_value1','custom_value2','custom_value3','custom_value4']],
        ];

        $companies = DB::table('companies')->select('id')->cursor();

        foreach ($companies as $company) {
            $company_id = $company->id;

            foreach ($entities as $table => $info) {
                // Create default definitions for this company if they do not exist
                for ($i = 1; $i <= 4; $i++) {
                    $name = "custom{$i}";
                    $exists = DB::table('custom_field_definitions')
                                ->where('company_id', $company_id)
                                ->where('entity_type', $info['model'])
                                ->where('name', $name)
                                ->exists();

                    if (! $exists) {
                        DB::table('custom_field_definitions')->insert([
                            'company_id' => $company_id,
                            'entity_type' => $info['model'],
                            'name' => $name,
                            'label' => "Custom {$i}",
                            'type' => 'text',
                            'options' => null,
                            'is_required' => false,
                            'sort_order' => $i,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }

                // Backfill rows in chunks to avoid memory spikes
                $chunkSize = 200;
                $count = DB::table($table)->count();
                if ($count == 0) {
                    continue;
                }

                DB::table($table)->orderBy('id')->select(array_merge(['id'], $info['columns']))->chunk($chunkSize, function ($rows) use ($table, $info) {
                    foreach ($rows as $r) {
                        $json = [];

                        for ($i = 1; $i <= 4; $i++) {
                            $col = "custom_value{$i}";
                            if (isset($r->{$col}) && $r->{$col} !== null && $r->{$col} !== '') {
                                $json["custom{$i}"] = $r->{$col};
                            }
                        }

                        if (! empty($json)) {
                            DB::table($table)->where('id', $r->id)->update(['custom_fields' => json_encode($json)]);
                        }
                    }
                });
            }
        }

    }

    public function down()
    {
        // We will not attempt to undo the backfill. The column and definitions can be dropped via migrations if desired.
    }
};
