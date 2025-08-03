<?php
require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    // Data admin yang akan diupdate/insert
    $adminData = [
        [
            'id' => 1,
            'name' => 'Valencia',
            'email' => 'valencia@aura.com',
            'password' => 'VoC98%890$',
            'action' => 'update'
        ],
        [
            'id' => 2, 
            'name' => 'Gracesiella',
            'email' => 'gracesiella@aura.com',
            'password' => 'gRmS19#0^5',
            'action' => 'update'
        ],
        [
            'name' => 'Evelyn',
            'email' => 'evelyn@aura.com', 
            'password' => 'eNlV93*30%',
            'action' => 'insert'
        ],
        [
            'name' => 'Amanda',
            'email' => 'amanda@aura.com',
            'password' => 'aNbM78&17#', 
            'action' => 'insert'
        ]
    ];

    DB::beginTransaction();

    foreach ($adminData as $admin) {
        $hashedPassword = Hash::make($admin['password']);
        
        if ($admin['action'] === 'update') {
            // Update existing admin
            $updated = DB::table('admins')
                ->where('id', $admin['id'])
                ->update([
                    'name' => $admin['name'],
                    'email' => $admin['email'],
                    'password' => $hashedPassword,
                    'updated_at' => now()
                ]);
            
            echo "Updated admin ID {$admin['id']}: {$admin['email']}\n";
            
        } else {
            // Insert new admin
            $inserted = DB::table('admins')->insert([
                'name' => $admin['name'],
                'email' => $admin['email'],
                'role' => 'admin',
                'password' => $hashedPassword,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            echo "Inserted new admin: {$admin['email']}\n";
        }
    }

    DB::commit();
    echo "\nAll admin updates completed successfully!\n";
    
} catch (Exception $e) {
    DB::rollBack();
    echo "Error: " . $e->getMessage() . "\n";
}
?>