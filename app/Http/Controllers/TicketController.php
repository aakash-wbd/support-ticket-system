<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\TicketRequest;
use App\Jobs\SendTicketNotification;
use App\Models\Ticket;
use Exception;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $offset    = 10;
            $condition = [];

            if (auth()->user()->role === 'USER') {
                $condition['user_id'] = auth()->id();
            }
            $data  = Ticket::query()->where($condition)->latest()->paginate($offset);
            $start = ($data->currentPage() - 1) * $data->perPage() + 1;
            return view('pages.tickets.list', compact('data', 'start'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.tickets.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        try {
            $query = Ticket::create(array_merge($request->validated(), ['user_id' => auth()->id()]));
            SendTicketNotification::dispatch($query, 'open', 'test@admin.com');
            return redirect()->route('tickets.index')->with('success', 'Ticket created successfully!');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('pages.tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('pages.tickets.form', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketRequest $request, Ticket $ticket)
    {
        try {
            $ticket->update($request->validated());
            if ($ticket->status === 'closed') {
                SendTicketNotification::dispatch($ticket, 'closed', $ticket->user->email);
            }
            return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully!');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        try {
            $ticket->delete();
            return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully!');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function storeComment(CommentRequest $request, Ticket $ticket)
    {
        try {
            $ticket->comments()->create(array_merge($request->validated(), ['user_id' => auth()->id()]));
            return back()->with('success', 'Comment added successfully!');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
