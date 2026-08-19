*** Begin Patch
*** Update File: app/Models/Task.php
@@
     protected $fillable = [
@@
-        'custom_value1',
-        'custom_value2',
-        'custom_value3',
-        'custom_value4',
+        // migrated legacy custom_value1..4
+        'custom_fields',
@@
     protected $casts = [
         'meta' => TaskMeta::class,
         'updated_at' => 'timestamp',
         'created_at' => 'timestamp',
         'deleted_at' => 'timestamp',
+        'custom_fields' => 'array',
     ];
*** End Patch
