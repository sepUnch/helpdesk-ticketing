<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\TicketLog;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())
            ->with('category')
            ->latest()
            ->get();
        return view('employee.dashboard', compact('tickets'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('employee.tickets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
        ]);

        $ticket = Ticket::create([
            'ticket_no' => Ticket::generateTicketNo(),
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'open',
        ]);

        // Catat log awal
        TicketLog::create([
            'ticket_id' => $ticket->id,
            'changed_by' => auth()->id(),
            'old_status' => null,
            'new_status' => 'open',
            'note' => 'Ticket dibuat oleh ' . auth()->user()->name,
        ]);

        return redirect()->route('employee.dashboard')
            ->with('success', 'Ticket berhasil dibuat! No: ' . $ticket->ticket_no);
    }

    public function show(Ticket $ticket)
    {
        if ($ticket->user_id !== auth()->id()) abort(403);
        $ticket->load('category', 'logs.user');
        return view('employee.tickets.show', compact('ticket'));
    }
}