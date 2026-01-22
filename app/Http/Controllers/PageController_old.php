<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageSection;
use App\Support\SectionRegistry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class PageControllerOld extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pages = Page::orderBy('order')->get();
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'html' => View::make('dashboard.pages.index', compact('pages'))->render()
            ]);
        }
        
        return view('dashboard.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $page = new Page();
        $sectionsRegistry = SectionRegistry::all();
        $layouts = [];
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'html' => View::make('dashboard.pages.form', compact('page', 'sectionsRegistry', 'layouts'))->render()
            ]);
        }
        
        return view('dashboard.pages.form', compact('page', 'sectionsRegistry', 'layouts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title_ar' => 'required_without:title_en|nullable|string|max:255',
            'title_en' => 'required_without:title_ar|nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug',
            'status' => 'required|in:draft,published',
            'excerpt_ar' => 'nullable|string|max:5000',
            'excerpt_en' => 'nullable|string|max:5000',
            'content' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'يوجد أخطاء في البيانات',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $slug = $data['slug'] ?: Str::slug($data['title_en'] ?: $data['title_ar'] ?: 'page');
        $slug = $this->uniqueSlug($slug);

        $page = Page::create([
            'slug' => $slug,
            'title' => [
                'ar' => $data['title_ar'] ?? '',
                'en' => $data['title_en'] ?? '',
            ],
            'excerpt' => [
                'ar' => $data['excerpt_ar'] ?? '',
                'en' => $data['excerpt_en'] ?? '',
            ],
            'content' => $data['content'] ?? null,
            'status' => $data['status'],
            'published_at' => $data['status'] === 'published' ? now() : null,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'تم إنشاء الصفحة بنجاح',
                'redirect' => route('dashboard.pages.edit', $page),
                'page_id' => $page->id
            ]);
        }

        return redirect()
            ->route('dashboard.pages.edit', $page)
            ->with('success', 'تم إنشاء الصفحة');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Page $page)
    {
        $sectionsRegistry = SectionRegistry::all();

        $sections = $page->sections()->orderBy('order')->get();

        // Build Layouts
        $layouts = $sections
            ->whereNotNull('layout_id')
            ->groupBy('layout_id')
            ->map(function ($group) {
                $columns = $group->groupBy('column_index')
                    ->map(function ($colGroup) {
                        $colGroup = $colGroup->sortBy('order')->values();
                        $first = $colGroup->first();
                        $data = is_array($first->data) ? $first->data : [];
                        $col = (int) ($data['col'] ?? 12);

                        return [
                            'col' => $col,
                            'sections' => $colGroup,
                        ];
                    })
                    ->sortKeys()
                    ->values();

                return [
                    'id' => $group->first()->layout_id,
                    'columns' => $columns,
                ];
            })
            ->values();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'html' => View::make('dashboard.pages.form', compact(
                    'page',
                    'sectionsRegistry',
                    'layouts'
                ))->render()
            ]);
        }

        return view('dashboard.pages.form', compact(
            'page',
            'sectionsRegistry',
            'layouts'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $validator = Validator::make($request->all(), [
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug,' . $page->id,
            'status' => 'required|in:draft,published',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'يوجد أخطاء في البيانات',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $page->update([
            'title' => [
                'ar' => $data['title_ar'],
                'en' => $data['title_en'],
            ],
            'slug' => $data['slug'] ?? $page->slug,
            'status' => $data['status'],
            'published_at' => $data['status'] === 'published' && !$page->published_at ? now() : $page->published_at,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'تم تحديث بيانات الصفحة بنجاح',
                'page' => $page->fresh()
            ]);
        }

        return redirect()->route('dashboard.pages.edit', $page)
            ->with('success', 'تم تحديث بيانات الصفحة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Page $page)
    {
        $page->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'تم نقل الصفحة إلى سلة المحذوفات',
                'redirect' => route('dashboard.pages.index')
            ]);
        }

        return redirect()->route('dashboard.pages.index')->with('success', 'تم نقل الصفحة إلى سلة المحذوفات');
    }

    // ================== LAYOUT MANAGEMENT ==================

    /**
     * Store a new layout
     */
    public function store_layout(Request $request, Page $page)
    {
        $validator = Validator::make($request->all(), [
            'columns' => 'required|array|min:1',
            'columns.*.col' => 'required|integer|min:1|max:12',
            'columns.*.order' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'يوجد أخطاء في البيانات',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        $layoutId = Str::uuid()->toString();
        $nextOrder = (int) ($page->sections()->max('order') ?? 0);

        foreach ($validated['columns'] as $index => $column) {
            $nextOrder++;

            PageSection::create([
                'page_id' => $page->id,
                'type' => 'empty',
                'layout_id' => $layoutId,
                'column_index' => $index,
                'order' => $nextOrder,
                'is_active' => true,
                'data' => [
                    'col' => (int) $column['col'],
                ],
            ]);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'تم إنشاء الـ Layout بنجاح',
                'reload' => true
            ]);
        }

        return redirect()
            ->route('dashboard.pages.edit', $page)
            ->with('success', 'تم إنشاء الـ Layout بنجاح');
    }

    /**
     * Delete layout
     */
    public function destroyLayout(Request $request, Page $page, string $layoutId)
    {
        $deleted = PageSection::where('page_id', $page->id)
            ->where('layout_id', $layoutId)
            ->delete();

        if ($deleted) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم حذف الـ Layout بالكامل',
                    'reload' => true
                ]);
            }
            return back()->with('success', 'تم حذف الـ Layout بالكامل');
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'لم يتم العثور على الـ Layout'
            ], 404);
        }
        
        return back()->with('error', 'لم يتم العثور على الـ Layout');
    }

    // ================== SECTION MANAGEMENT ==================

    /**
     * Add new section to column
     */
    public function addSection(Request $request, Page $page)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'layout_id' => 'required|string',
            'column_index' => 'required|integer|min:0|max:20',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'يوجد أخطاء في البيانات',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $ref = PageSection::where('page_id', $page->id)
            ->where('layout_id', $data['layout_id'])
            ->where('column_index', $data['column_index'])
            ->orderBy('order')
            ->first();

        $col = 12;
        if ($ref && is_array($ref->data) && isset($ref->data['col'])) {
            $col = (int) $ref->data['col'];
        }

        $nextOrder = (int) ($page->sections()->max('order') ?? 0) + 1;

        $section = PageSection::create([
            'page_id' => $page->id,
            'type' => $data['type'],
            'layout_id' => $data['layout_id'],
            'column_index' => (int) $data['column_index'],
            'data' => ['col' => $col],
            'is_active' => true,
            'order' => $nextOrder,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'تمت إضافة القسم بنجاح',
                'reload' => true
            ]);
        }

        return back()->with('success', 'تمت إضافة القسم');
    }

    /**
     * Update single section
     */
    public function updateSection(Request $request, PageSection $section)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'data' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'يوجد أخطاء في البيانات',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $section->update([
            'type' => $data['type'],
            'data' => $data['data'] ?? [],
            'is_active' => $request->boolean('is_active'),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'تم تحديث القسم بنجاح'
            ]);
        }

        return back()->with('success', 'تم تحديث القسم');
    }

    /**
     * Delete single section
     */
    public function deleteSection(Request $request, PageSection $section)
    {
        $section->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'تم حذف القسم بنجاح',
                'reload' => true
            ]);
        }

        return back()->with('success', 'تم حذف القسم');
    }

    /**
     * Move section up
     */
    public function moveSectionUp(Request $request, PageSection $section)
    {
        $prevSection = PageSection::where('page_id', $section->page_id)
            ->where('layout_id', $section->layout_id)
            ->where('column_index', $section->column_index)
            ->where('order', '<', $section->order)
            ->orderByDesc('order')
            ->first();

        if ($prevSection) {
            $tempOrder = $section->order;
            $section->update(['order' => $prevSection->order]);
            $prevSection->update(['order' => $tempOrder]);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'تم تحريك القسم للأعلى',
                'reload' => true
            ]);
        }

        return back()->with('success', 'تم تحريك القسم للأعلى');
    }

    /**
     * Move section down
     */
    public function moveSectionDown(Request $request, PageSection $section)
    {
        $nextSection = PageSection::where('page_id', $section->page_id)
            ->where('layout_id', $section->layout_id)
            ->where('column_index', $section->column_index)
            ->where('order', '>', $section->order)
            ->orderBy('order')
            ->first();

        if ($nextSection) {
            $tempOrder = $section->order;
            $section->update(['order' => $nextSection->order]);
            $nextSection->update(['order' => $tempOrder]);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'تم تحريك القسم للأسفل',
                'reload' => true
            ]);
        }

        return back()->with('success', 'تم تحريك القسم للأسفل');
    }

    /**
     * Batch update sections
     */
    public function batchUpdateSections(Request $request, Page $page)
    {
        $sections = $request->input('sections', []);

        foreach ($sections as $id => $payload) {
            $section = PageSection::where('page_id', $page->id)->where('id', $id)->first();
            if (!$section) continue;

            if (!empty($payload['_delete'])) {
                $section->delete();
                continue;
            }

            $data = $payload['data'] ?? [];
            $isActive = isset($payload['is_active']) ? (bool)$payload['is_active'] : $section->is_active;
            $order = isset($payload['order']) ? (int)$payload['order'] : $section->order;

            $type = $section->type;
            if (isset($payload['type']) && is_string($payload['type']) && $payload['type'] !== '') {
                $type = $payload['type'];
            }

            $section->update([
                'type' => $type,
                'data' => $data,
                'is_active' => $isActive,
                'order' => $order,
            ]);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'تم حفظ جميع التغييرات',
                'reload' => true
            ]);
        }

        return back()->with('success', 'تم حفظ جميع التغييرات');
    }

    // ================== TRASH MANAGEMENT ==================

    /**
     * Restore from trash
     */
    public function restore(Request $request, int $id)
    {
        $page = Page::onlyTrashed()->findOrFail($id);
        $page->restore();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'تم استرجاع الصفحة بنجاح'
            ]);
        }

        return back()->with('success', 'تم استرجاع الصفحة');
    }

    /**
     * Delete permanently
     */
    public function forceDelete(Request $request, int $id)
    {
        $page = Page::onlyTrashed()->findOrFail($id);
        $page->forceDelete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'تم حذف الصفحة نهائيًا'
            ]);
        }

        return back()->with('success', 'تم حذف الصفحة نهائيًا');
    }

    /**
     * Bulk actions
     */
    public function bulk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'action' => ['required', Rule::in(['trash', 'restore', 'delete'])],
            'ids' => ['required', 'array'],
            'ids.*' => ['integer'],
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'يوجد أخطاء في البيانات',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ids = $request->ids;
        $message = '';

        if ($request->action === 'trash') {
            Page::whereIn('id', $ids)->delete();
            $message = 'تم نقل المحدد إلى السلة';
        } elseif ($request->action === 'restore') {
            Page::onlyTrashed()->whereIn('id', $ids)->restore();
            $message = 'تم استرجاع المحدد';
        } else {
            Page::onlyTrashed()->whereIn('id', $ids)->forceDelete();
            $message = 'تم حذف المحدد نهائيًا';
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'reload' => true
            ]);
        }

        return back()->with('success', $message);
    }

    // ================== OTHER METHODS ==================

    /**
     * Preview Page
     */
    public function preview(Request $request, Page $page)
    {
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'html' => View::make('pages.preview', compact('page'))->render(),
                'url' => route('pages.show', $page->slug)
            ]);
        }

        return view('pages.preview', compact('page'));
    }

    /**
     * Toggle Status
     */
    public function toggleStatus(Request $request, Page $page)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'يوجد أخطاء في البيانات',
                'errors' => $validator->errors()
            ], 422);
        }

        $page->status = $request->status == 1 ? 'published' : 'draft';
        $page->published_at = $page->status === 'published' ? now() : null;
        $page->save();

        return response()->json([
            'success' => true,
            'message' => $page->status === 'published' 
                ? 'تم نشر الصفحة' 
                : 'تم تحويل الصفحة إلى مسودة'
        ]);
    }

    /**
     * Reorder Pages
     */
    public function reorder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order' => 'required|array',
            'order.*' => 'integer|exists:pages,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'يوجد أخطاء في البيانات',
                'errors' => $validator->errors()
            ], 422);
        }

        foreach ($request->order as $index => $id) {
            Page::where('id', $id)->update([
                'order' => $index + 1
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'تم حفظ ترتيب الصفحات'
        ]);
    }

    // ================== HELPER METHODS ==================

    /**
     * Generate unique slug
     */
    private function uniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $base = Str::slug($slug) ?: 'page';
        $candidate = $base;
        $i = 2;

        while (
            Page::withTrashed()
                ->where('slug', $candidate)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $candidate = "{$base}-{$i}";
            $i++;
        }

        return $candidate;
    }
}