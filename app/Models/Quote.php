*** Begin Patch
*** Update File: app/Models/Quote.php
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
@@
-        'sync' => QuoteSync::class,
+        'sync' => QuoteSync::class,
+        'custom_fields' => 'array',
 
     ];
*** End Patch
