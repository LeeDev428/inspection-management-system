<?php

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
        Schema::create('inspection_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Request Type Checkboxes
            $table->boolean('operation_position')->default(false);
            $table->boolean('ucss_purchases')->default(false);
            $table->boolean('post_repair_water_material')->default(false);
            $table->boolean('janitorial_services')->default(false);
            
            // Date and Time
            $table->dateTime('date_time_requested')->nullable();
            
            // Office/Department and Purpose
            $table->string('office_department')->nullable();
            $table->text('purpose')->nullable();
            
            // Requested By and Participants
            $table->string('requested_by')->nullable();
            $table->string('name_of_requesting_officer')->nullable();
            $table->text('participants')->nullable();
            
            // Documentary Requirements Checkboxes
            $table->boolean('sales_invoice_official_receipt')->default(false);
            $table->boolean('approved_purchase_request')->default(false);
            $table->boolean('invoice_delivery_receipt_materials')->default(false);
            $table->boolean('special_order_designation')->default(false);
            $table->boolean('request_for_post_repair_inspection')->default(false);
            $table->boolean('inventory_custodian_slip')->default(false);
            $table->boolean('property_acknowledge_receipt')->default(false);
            $table->boolean('cnas')->default(false);
            $table->boolean('others_document')->default(false);
            $table->string('others_document_text')->nullable();
            
            // Remarks Table Fields
            $table->json('remarks_data')->nullable(); // Store array of remarks with dates and C/NC status
            
            // File Upload Path (for hardcopy)
            $table->string('file_path')->nullable();
            
            // Status
            $table->enum('status', ['pending', 'approved', 'denied'])->default('pending');
            $table->text('admin_remarks')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('reviewed_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_requests');
    }
};
