<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InspectionRequest extends Model
{
    protected $fillable = [
        'user_id',
        'operation_position',
        'ucss_purchases',
        'post_repair_water_material',
        'janitorial_services',
        'date_time_requested',
        'office_department',
        'purpose',
        'requested_by',
        'name_of_requesting_officer',
        'participants',
        'sales_invoice_official_receipt',
        'approved_purchase_request',
        'invoice_delivery_receipt_materials',
        'special_order_designation',
        'request_for_post_repair_inspection',
        'inventory_custodian_slip',
        'property_acknowledge_receipt',
        'cnas',
        'others_document',
        'others_document_text',
        'remarks_data',
        'file_path',
        'status',
        'admin_remarks',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'operation_position' => 'boolean',
        'ucss_purchases' => 'boolean',
        'post_repair_water_material' => 'boolean',
        'janitorial_services' => 'boolean',
        'sales_invoice_official_receipt' => 'boolean',
        'approved_purchase_request' => 'boolean',
        'invoice_delivery_receipt_materials' => 'boolean',
        'special_order_designation' => 'boolean',
        'request_for_post_repair_inspection' => 'boolean',
        'inventory_custodian_slip' => 'boolean',
        'property_acknowledge_receipt' => 'boolean',
        'cnas' => 'boolean',
        'others_document' => 'boolean',
        'date_time_requested' => 'datetime',
        'reviewed_at' => 'datetime',
        'remarks_data' => 'array',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // Helper methods
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isDenied(): bool
    {
        return $this->status === 'denied';
    }

    public function getRequestTypesAttribute(): array
    {
        $types = [];
        if ($this->operation_position) $types[] = 'Operation Position';
        if ($this->ucss_purchases) $types[] = 'UCSS Purchases';
        if ($this->post_repair_water_material) $types[] = 'Post-Repair/Water Material';
        if ($this->janitorial_services) $types[] = 'Janitorial Services';
        return $types;
    }
}
