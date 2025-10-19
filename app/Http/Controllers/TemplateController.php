<?php

namespace App\Http\Controllers;

use App\Mail\ReminderEmail;
use App\Models\Client;
use App\Models\Template;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::paginate(10);
        return view('templates.index', compact('templates'));
    }

    public function create()
    {
        return view('templates.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'include_sent' => 'required|boolean',
            'count' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = basename($imagePath);
        }
        Template::create($validated);
        return redirect()->route('templates.index')->with('success', 'Template created successfully.');
    }

    public function run(Request $request, int $templateId)
    {
        $now = Carbon::now();
//
        $template = Template::where('id', $templateId)->first();

        $query = Client::query();

        // Apply conditions based on include_sended
        if ($template->include_sent) {
            $clients = $query->orderByDesc('id');
        } else {
            $clients = $query->whereNotNull('is_sent')->orderByDesc('id');
        }
        if ($template->count > 0) {
            $clients = $clients->limit($template->count)->get();
        } else {
            $clients = $clients->get();
        }
        foreach ($clients as $client) {
            // Simulate sending email (replace with actual Mail facade usage)
            Mail::to($client->email)->send(new ReminderEmail($template));
            $client->update(['send' => $now]);
        }

        // Reset schedule_time after processing
        $template->update(['schedule_time' => null]);

        return redirect()->route('templates.index')->with('success', 'Template Running successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Template $template)
    {
        //
    }

    public function edit(Template $template)
    {
        return view('templates.form', compact('template'));
    }

    public function update(Request $request, Template $template)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'include_sended' => 'required|boolean',
            'count' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $template->update($validated);
        return redirect()->route('templates.index')->with('success', 'Template updated successfully.');
    }

    public function destroy(Template $template)
    {
        $template->delete();
        return redirect()->route('templates.index')->with('success', 'Template deleted successfully.');
    }
}
