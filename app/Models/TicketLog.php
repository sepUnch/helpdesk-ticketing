<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketLog extends Model
{
    protected $fillable = [
        'ticket_id', 'changed_by',
        'old_status', 'new_status', 'note'
    ];

    public function ticket() {
        return $this->belongsTo(Ticket::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'changed_by');
    }
}