<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_no', 'user_id', 'category_id',
        'title', 'description', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function logs() {
        return $this->hasMany(TicketLog::class);
    }

    // Auto-generate ticket number
    public static function generateTicketNo() {
        $prefix = 'TKT-' . date('Ymd') . '-';
        $last = self::where('ticket_no', 'like', $prefix . '%')->latest()->first();
        $number = $last ? (intval(substr($last->ticket_no, -4)) + 1) : 1;
        return $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}