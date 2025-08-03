<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailTemplate;

class EmailTemplateController extends Controller
{
    public function index()
    {
        $templates = EmailTemplate::all()->groupBy('program');
        return view('admin.email-templates.index', compact('templates'));
    }

    public function store(Request $request)
{
    $request->validate([
        'program' => 'required',
        'status_type' => 'required|in:pending,accepted,rejected',
        'subject' => 'required|string',
        'body' => 'required|string',
    ]);

    // Cek apakah sudah ada
    $exists = EmailTemplate::where('program', $request->program)
        ->where('status_type', $request->status_type)
        ->exists();

    if ($exists) {
        return back()->with('error', 'Template untuk status ini sudah ada.');
    }

    EmailTemplate::create([
        'program' => $request->program,
        'status_type' => $request->status_type,
        'name' => ucfirst($request->program) . ' - ' . ucfirst($request->status_type), // Auto-generate
        'subject' => $request->subject,
        'body' => $request->body,
        'type' => 'notification',
        'is_active' => true
    ]);

    return back()->with('success', 'Template berhasil dibuat.');
}

    public function update(Request $request, $id)
    {
         $request->validate([
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
        'is_active' => 'nullable|boolean',
    ]);

    try {
        $template = EmailTemplate::findOrFail($id);

        $template->update([
            'subject' => $request->subject,
            'body' => $request->message,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->back()->with('success', 'Email template updated successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to update template: ' . $e->getMessage());
    }   
 }
}