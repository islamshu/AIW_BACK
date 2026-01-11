<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectorController extends Controller
{
    /* ======================
        INDEX
    =======================*/
    public function index()
    {
        $sectors = Sector::orderBy('order')->get();
        return view('dashboard.sectors.index', compact('sectors'));
    }

    /* ======================
        CREATE
    =======================*/
    public function create()
    {
        $sector = null;
        return view('dashboard.sectors.form', compact('sector'));
    }

    /* ======================
        STORE
    =======================*/
    public function store(Request $request)
    {
        $data = $this->validateData($request);

        // icon OR image
        if ($request->type === 'image' && $request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('sectors', 'public');
            $data['icon'] = null;
        } else {
            $data['image'] = null;
        }

        $data['order'] = Sector::max('order') + 1;
        $data['is_active'] = $request->boolean('is_active');

        Sector::create($data);

        return redirect()
            ->route('sectors.index')
            ->with('success', 'تم إضافة القطاع بنجاح');
    }
    public function toggleStatus($id)
{
    $sector = Sector::find($id);
    $sector->update([
        'is_active' => !$sector->is_active
    ]);

    return response()->json([
        'status' => true,
        'message' => 'تم تحديث الحالة بنجاح'
    ]);
}

    /* ======================
        EDIT
    =======================*/
    public function edit(Sector $sector)
    {
        return view('dashboard.sectors.form', compact('sector'));
    }

    /* ======================
        UPDATE
    =======================*/
    public function update(Request $request, Sector $sector)
    {
        $data = $this->validateData($request);

        if ($request->type === 'image' && $request->hasFile('image')) {
            if ($sector->image) {
                Storage::disk('public')->delete($sector->image);
            }
            $data['image'] = $request->file('image')->store('sectors', 'public');
            $data['icon'] = null;
        }

        if ($request->type === 'icon') {
            if ($sector->image) {
                Storage::disk('public')->delete($sector->image);
            }
            $data['image'] = null;
        }

        $data['is_active'] = $request->boolean('is_active');

        $sector->update($data);

        return redirect()
            ->route('sectors.index')
            ->with('success', 'تم تحديث القطاع');
    }

    /* ======================
        DELETE
    =======================*/
    public function destroy(Sector $sector)
    {
        if ($sector->image) {
            Storage::disk('public')->delete($sector->image);
        }

        $sector->delete();

        return back()->with('success', 'تم حذف القطاع');
    }

    /* ======================
        SORT (Drag & Drop)
    =======================*/
    public function sort(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Sector::where('id', $id)->update([
                'order' => $index + 1
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'تم تحديث ترتيب القطاعات'
        ]);
    }

    /* ======================
        VALIDATION
    =======================*/
    private function validateData(Request $request)
    {
        return $request->validate([
            'title.ar' => 'required|string|max:255',
            'title.en' => 'required|string|max:255',

            'description.ar' => 'required|string',
            'description.en' => 'required|string',

            'badge_text.ar' => 'required|string|max:100',
            'badge_text.en' => 'required|string|max:100',

            'type' => 'required|in:icon,image',

            'icon' => 'nullable|required_if:type,icon|string|max:100',
            'image' => 'nullable|required_if:type,image|image|max:2048',

            'gradient_from' => 'required|string',
            'gradient_to' => 'required|string',

            'market_value' => 'required|integer|min:1|max:999',
            'market_percent' => 'required|integer|min:1|max:100',

            'is_active' => 'nullable|boolean',
        ]);
    }
}
