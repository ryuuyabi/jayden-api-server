<?php

use App\Enums\IsActive;
use App\Enums\IsNotion;
use App\Enums\User\UserStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('sub')->unique()->comment('ユーザサブ');
            $table->string('personal_name', 30)->unique()->comment('個人名 @から始まる');
            $table->string('nickname', 30)->nullable()->comment('ニックネーム');
            $table->string('email', 100)->unique()->comment('メールアドレス');
            $table->unsignedTinyInteger('status')->default(UserStatus::ACTIVITY)->comment('ステータス');
            $table->boolean('is_notion')->default(IsNotion::ON)->comment('通知判定');
            $table->boolean('is_active')->default(IsActive::OFF)->comment('行動判定');
            $table->string('icon_image_url')->nullable()->comment('アイコン画像URL');
            $table->dateTime('created_at')->comment('作成日');
            $table->dateTime('updated_at')->comment('更新日');
            $table->dateTime('deleted_at')->nullable()->comment('削除日');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
