<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $programs = Program::query()
            ->when($request->search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%');
            })
            ->when($request->category, function ($query, $category) {
                return $query->where('category', $category);
            })
            ->orderBy('category')
            ->orderBy('order')
            ->orderBy('id', 'asc')
            ->paginate(10)
            ->withQueryString();

        $categories = Program::distinct()->pluck('category')->filter()->values();

        return inertia('Admin/Program/Index', [
            'programs' => $programs,
            'categories' => $categories,
            'filters' => $request->only(['search', 'category'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $existingCategories = Program::distinct()->pluck('category')->filter()->values();
        
        return inertia('Admin/Program/Create', [
            'existingCategories' => $existingCategories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'badge_text' => 'nullable|string|max:255',
            'badge_color' => 'required|string|max:50',
            'original_price' => 'required|numeric|min:0',
            'promo_price' => 'required|numeric|min:0',
            'duration' => 'nullable|string|max:255',
            'alert_text' => 'nullable|string',
            'alert_color' => 'nullable|string|max:50',
            'features' => 'nullable|array',
            'button_text' => 'required|string|max:255',
            'button_color' => 'required|string|max:50',
            'whatsapp_message' => 'nullable|string',
            'action_type' => 'required|in:whatsapp,register',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        try {
            Program::create($request->all());

            session()->flash('success', 'Program berhasil ditambahkan!');
            return redirect()->route('admin.programs.index');
        } catch (\Exception $e) {
            session()->flash('failed', $e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $program = Program::findOrFail($id);
        $existingCategories = Program::distinct()->pluck('category')->filter()->values();

        return inertia('Admin/Program/Edit', [
            'program' => $program,
            'existingCategories' => $existingCategories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'badge_text' => 'nullable|string|max:255',
            'badge_color' => 'required|string|max:50',
            'original_price' => 'required|numeric|min:0',
            'promo_price' => 'required|numeric|min:0',
            'duration' => 'nullable|string|max:255',
            'alert_text' => 'nullable|string',
            'alert_color' => 'nullable|string|max:50',
            'features' => 'nullable|array',
            'button_text' => 'required|string|max:255',
            'button_color' => 'required|string|max:50',
            'whatsapp_message' => 'nullable|string',
            'action_type' => 'required|in:whatsapp,register',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        try {
            $program = Program::findOrFail($id);
            $program->update($request->all());

            session()->flash('success', 'Program berhasil diperbarui!');
            return redirect()->route('admin.programs.index');
        } catch (\Exception $e) {
            session()->flash('failed', $e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $program = Program::findOrFail($id);
            $program->delete();

            session()->flash('success', 'Program berhasil dihapus!');
            return redirect()->route('admin.programs.index');
        } catch (\Exception $e) {
            session()->flash('failed', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Duplicate a program
     */
    public function duplicate($id)
    {
        try {
            $program = Program::findOrFail($id);
            $newProgram = $program->replicate();
            $newProgram->name = $program->name . ' (Copy)';
            $newProgram->save();

            session()->flash('success', 'Program berhasil diduplikasi!');
            return redirect()->route('admin.programs.index');
        } catch (\Exception $e) {
            session()->flash('failed', $e->getMessage());
            return redirect()->back();
        }
    }
}
