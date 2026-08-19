*** Begin Patch
*** Update File: app/Models/Invoice.php
@@
     protected $fillable = [
@@
-        'custom_value1',
-        'custom_value2',
-        'custom_value3',
-        'custom_value4',
+        // legacy custom_value1..4 migrated to custom_fields
+        'custom_fields',
@@
     protected $casts = [
@@
-        'e_invoice' => 'object',
+        'e_invoice' => 'object',
         'sync' => InvoiceSync::class,
+        'custom_fields' => 'array',
 
     ];
*** End Patch
