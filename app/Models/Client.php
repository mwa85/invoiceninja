*** Begin Patch
*** Update File: app/Models/Client.php
@@
     protected $fillable = [
@@
-        'custom_value1',
-        'custom_value2',
-        'custom_value3',
-        'custom_value4',
+        // legacy custom_value1..4 are backfilled into custom_fields json
+        'custom_fields',
@@
     protected $casts = [
@@
-        'e_invoice' => 'object',
+        'e_invoice' => 'object',
         'sync' => ClientSync::class,
+        'custom_fields' => 'array',
     ];
*** End Patch
