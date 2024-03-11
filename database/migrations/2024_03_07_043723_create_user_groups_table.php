<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('user_groups')) {
            Schema::create('user_groups', function (Blueprint $table) {
                $table->id()->primary()->autoIncrement();
                $table->string('name');
                $table->string('permission_type');
                $table->text('permissions');
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
            });
        }
        
        DB::table('user_groups')->delete();
        DB::table('user_groups')->insert(
            array(
                'id' => '1',
                'name' => "Admin",
                'permission_type' => 'all',
                'permissions' => '["\/user","\/user\/create","\/user\/edit","\/user\/delete","\/user-group","\/user-group\/create","\/user-group\/edit","\/user-group\/delete","\/item","\/item\/create","\/item\/edit","\/item\/delete","\/item\/all","\/manufacturer","\/manufacturer\/create","\/manufacturer\/edit","\/manufacturer\/delete","\/manufacturer\/all"]',
                'created_at' => "2024-03-08 00:49:12",
                'updated_at' => "2024-03-11 06:46:00",
            )
        );
        DB::table('user_groups')->insert(
            array(
                'id' => '2',
                'name' => "User",
                'permission_type' => 'custom',
                'permissions' => '["\/user","\/user\/create","\/item\/delete","\/item\/all"]',
                'created_at' => "2024-03-08 00:49:12",
                'updated_at' => "2024-03-11 06:46:00",
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_groups');
    }
};
