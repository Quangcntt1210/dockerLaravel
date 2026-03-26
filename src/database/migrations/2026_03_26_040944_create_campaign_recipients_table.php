<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_recipients', function (Blueprint $table) {
    $table->id();
    $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
    $table->foreignId('subscriber_id')->constrained()->onDelete('cascade');
    $table->string('status')->default('pending')->index(); 
    $table->dateTime('sent_at')->nullable();
    $table->timestamps();
    
    // Đảm bảo 1 subscriber không nhận trùng 1 campaign 2 lần
    $table->unique(['campaign_id', 'subscriber_id']); 
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_recipients');
    }
}
