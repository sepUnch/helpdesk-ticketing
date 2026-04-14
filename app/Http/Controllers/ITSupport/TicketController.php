<?php

namespace App\Http\Controllers\ITSupport;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\TicketLog;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with('user', 'category')->latest();

        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $tickets = $query->get();
        $categories = Category::all();

        return view('it-support.dashboard', compact('tickets', 'categories'));
    }

    public function show(Ticket $ticket)
    {
        $ticket->load('user', 'category', 'logs.user');
        return view('it-support.tickets.show', compact('ticket'));
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'note' => 'nullable|string',
        ]);

        $transitions = [
            'open' => 'on_progress',
            'on_progress' => 'resolved',
            'resolved' => 'closed',
        ];

        if (!isset($transitions[$ticket->status])) {
            return back()->withErrors(['status' => 'Status tidak dapat diubah lagi.']);
        }

        $oldStatus = $ticket->status;
        $newStatus = $transitions[$oldStatus];

        $ticket->update(['status' => $newStatus]);

        TicketLog::create([
            'ticket_id' => $ticket->id,
            'changed_by' => auth()->id(),
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'note' => $request->note,
        ]);

        return back()->with('success', 'Status ticket berhasil diupdate!');
    }
}