<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKnowledgeRequest;
use App\Http\Requests\UpdateKnowledgeRequest;
use App\Models\Knowledge;
use App\Services\KnowledgeService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class KnowledgeController extends Controller
{
    use AuthorizesRequests;

    public function __construct(private KnowledgeService $knowledgeService) {}

    public function index()
    {
        $knowledges = Auth::user()->knowledges()->latest()->get();
        return view('knowledges.index', compact('knowledges'));
    }

    public function create()
    {
        return view('knowledges.create');
    }

    public function store(StoreKnowledgeRequest $request)
    {
        $this->knowledgeService->storeKnowledge(
            $request->validated(),
            Auth::id(),
            $request->file('image_path')
        );

        return redirect()->route('knowledges.index')->with('success', 'Knowledge saved successfully.');
    }

    public function show(Knowledge $knowledge)
    {
        $this->authorize('view', $knowledge);
        return view('knowledges.show', compact('knowledge'));
    }

    public function edit(Knowledge $knowledge)
    {
        $this->authorize('update', $knowledge);
        return view('knowledges.edit', compact('knowledge'));
    }

    public function update(UpdateKnowledgeRequest $request, Knowledge $knowledge)
    {
        $this->authorize('update', $knowledge);

        $this->knowledgeService->updateKnowledge(
            $knowledge,
            $request->validated(),
            $request->file('image_path')
        );

        return redirect()->route('knowledges.index')->with('success', 'Knowledge updated successfully.');
    }

    public function destroy(Knowledge $knowledge)
    {
        $this->authorize('delete', $knowledge);
        
        $this->knowledgeService->deleteKnowledge($knowledge);
        
        return redirect()->route('knowledges.index')->with('success', 'Knowledge deleted successfully.');
    }
}
