<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Traits\Uploadable;

class TestimonialController extends Controller
{
    use Uploadable;

    protected $image_path = 'upload_files/testimonials';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $testimonials = Testimonial::query()
            ->when($request->search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            })
            ->orderBy('order')
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return inertia('Admin/Testimonial/Index', [
            'testimonials' => $testimonials,
            'filters' => $request->only(['search'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Testimonial/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        try {
            $input = $request->all();

            if ($request->hasFile('photo')) {
                $file = $request->file('photo')->getClientOriginalName();
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $filename = $this->uploadFile($request->file('photo'), $filename, $this->image_path);
                $input['photo'] = $filename;
            }

            Testimonial::create($input);

            session()->flash('success', 'Testimoni berhasil ditambahkan!');
            return redirect()->route('admin.testimonials.index');
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
        $testimonial = Testimonial::findOrFail($id);

        return inertia('Admin/Testimonial/Edit', [
            'testimonial' => $testimonial
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        try {
            $testimonial = Testimonial::findOrFail($id);
            $input = $request->all();

            if ($request->hasFile('photo')) {
                // Delete old photo
                if ($testimonial->photo) {
                    $this->deleteFile($testimonial->photo, $this->image_path);
                }
                $file = $request->file('photo')->getClientOriginalName();
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $filename = $this->uploadFile($request->file('photo'), $filename, $this->image_path);
                $input['photo'] = $filename;
            } else {
                $input['photo'] = $testimonial->photo;
            }

            $testimonial->update($input);

            session()->flash('success', 'Testimoni berhasil diperbarui!');
            return redirect()->route('admin.testimonials.index');
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
            $testimonial = Testimonial::findOrFail($id);
            
            if ($testimonial->photo) {
                $this->deleteFile($testimonial->photo, $this->image_path);
            }
            
            $testimonial->delete();

            session()->flash('success', 'Testimoni berhasil dihapus!');
            return redirect()->route('admin.testimonials.index');
        } catch (\Exception $e) {
            session()->flash('failed', $e->getMessage());
            return redirect()->back();
        }
    }
}
