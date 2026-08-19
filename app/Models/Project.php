*** Begin Patch
*** Update File: app/Models/Project.php
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
     public function toSearchableArray(): array
     {
@@
-            'custom_value1' => (string) $this->custom_value1,
-            'custom_value2' => (string) $this->custom_value2,
-            'custom_value3' => (string) $this->custom_value3,
-            'custom_value4' => (string) $this->custom_value4,
+            // legacy searchable keys are preserved by backfill; prefer custom_fields when available
+            'custom_value1' => (string) ($this->custom_fields['custom1'] ?? $this->custom_value1),
+            'custom_value2' => (string) ($this->custom_fields['custom2'] ?? $this->custom_value2),
+            'custom_value3' => (string) ($this->custom_fields['custom3'] ?? $this->custom_value3),
+            'custom_value4' => (string) ($this->custom_fields['custom4'] ?? $this->custom_value4),
*** End Patch
