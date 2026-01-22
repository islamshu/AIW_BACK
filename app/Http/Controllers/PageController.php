<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageSection;
use App\Support\SectionRegistry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    // All Pages + filters + search + counts
    public function index(Request $request)
    {
        $pages = Page::orderBy('order')->get();

        return view('dashboard.pages.index', compact('pages'));
    }

    // Add New
    public function create()
    {
        $page = new Page();
        $sectionsRegistry =   collect(SectionRegistry::all())
        ->except(['hero_extra']);
        $layouts = [];

        return view('dashboard.pages.form', compact('page', 'sectionsRegistry', 'layouts'));
    }


    // Store New Page
    public function store(Request $request)
    {
        $data = $this->validatePage($request);

        $slug = $data['slug'] ?: Str::slug($data['title']['en'] ?: $data['title']['ar'] ?: 'page');
        $slug = $this->uniqueSlug($slug);

        $page = Page::create([
            'slug' => $slug,
            'title' => $data['title'],
            'excerpt' => $data['excerpt'] ?? null,
            'content' => $data['content'] ?? null,
            'status' => $data['status'],
            'published_at' => $data['status'] === 'published' ? now() : null,
        ]);

        return redirect()
            ->route('dashboard.pages.edit', $page)
            ->with('success', 'تم إنشاء الصفحة');
    }
    public function saveAll(Request $request, Page $page)
{
    // 1️⃣ تحديث بيانات الصفحة
    $pageData = $request->validate([
        'title_ar' => 'required|string|max:255',
        'title_en' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255|unique:pages,slug,' . $page->id,
        'status' => 'required|in:draft,published',
    ]);

    $page->update([
        'title' => [
            'ar' => $pageData['title_ar'],
            'en' => $pageData['title_en'],
        ],
        'slug' => $pageData['slug'] ?: $page->slug,
        'status' => $pageData['status'],
        'published_at' => $pageData['status'] === 'published' ? ($page->published_at ?? now()) : null,
    ]);

    // 2️⃣ تحديث الأقسام (Sections)
    $sections = $request->input('sections', []);
    
    foreach ($sections as $id => $payload) {
        $section = PageSection::where('page_id', $page->id)->where('id', $id)->first();
        if (!$section) continue;

        // حذف القسم إذا كان محدد للحذف
        if (!empty($payload['_delete'])) {
            $section->delete();
            continue;
        }

        // تحديث بيانات القسم
        $data = $payload['data'] ?? [];
        $isActive = isset($payload['is_active']) ? (bool)$payload['is_active'] : false;
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

    return redirect()
        ->route('dashboard.pages.edit', $page)
        ->with('success', '✅ تم حفظ جميع التغييرات بنجاح');
}

    // Edit Page
    public function edit(Page $page)
    {
        $sectionsRegistry = collect(SectionRegistry::all())
        ->except(['hero_extra']);

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

        return view('dashboard.pages.form', compact(
            'page',
            'sectionsRegistry',
            'layouts'
        ));
    }

    // Update Page Data Only
    public function update(Request $request, Page $page)
    {
        // تحقق من البيانات الأساسية للصفحة
        $data = $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug,' . $page->id,
            'status' => 'required|in:draft,published',
        ]);

        // تحديث بيانات الصفحة فقط
        $page->update([
            'title' => [
                'ar' => $data['title_ar'],
                'en' => $data['title_en'],
            ],
            'slug' => $data['slug'],
            'status' => $data['status'],
        ]);

        return redirect()->route('dashboard.pages.edit', $page)
            ->with('success', 'تم تحديث بيانات الصفحة بنجاح');
    }

    // ================== LAYOUT MANAGEMENT ==================

    // Create New Layout
    public function store_layout(Request $request, Page $page)
    {
        $validated = $request->validate([
            'columns' => 'required|array|min:1',
            'columns.*.col' => 'required|integer|min:1|max:12',
            'columns.*.order' => 'required|integer|min:0',
        ]);

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

        return redirect()
            ->route('dashboard.pages.edit', $page)
            ->with('success', 'تم إنشاء الـ Layout بنجاح');
    }

    // Delete Layout
    public function destroyLayout(Page $page, string $layoutId)
    {
        PageSection::where('page_id', $page->id)
            ->where('layout_id', $layoutId)
            ->delete();

        return back()->with('success', 'تم حذف الـ Layout بالكامل');
    }

    // ================== SECTION MANAGEMENT ==================

    // Add New Section to Column
    public function addSection(Request $request, Page $page)
    {
        $request->validate([
            'type' => 'required|string',
            'layout_id' => 'required|string',
            'column_index' => 'required|integer|min:0|max:20',
        ]);

        $ref = PageSection::where('page_id', $page->id)
            ->where('layout_id', $request->layout_id)
            ->where('column_index', $request->column_index)
            ->orderBy('order')
            ->first();

        $col = 12;
        if ($ref && is_array($ref->data) && isset($ref->data['col'])) {
            $col = (int) $ref->data['col'];
        }

        $nextOrder = (int) ($page->sections()->max('order') ?? 0) + 1;

        PageSection::create([
            'page_id' => $page->id,
            'type' => $request->type,
            'layout_id' => $request->layout_id,
            'column_index' => (int)$request->column_index,
            'data' => ['col' => $col],
            'is_active' => true,
            'order' => $nextOrder,
        ]);

        return back()->with('success', 'تمت إضافة القسم');
    }

    // Update Single Section
    public function updateSection(Request $request, PageSection $section)
    {
        $request->validate([
            'type' => 'required|string',
            'data' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        $section->update([
            'type' => $request->type,
            'data' => $request->data ?? [],
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'تم تحديث القسم');
    }

    // Delete Single Section
    public function deleteSection(PageSection $section)
    {
        $section->delete();
        return back()->with('success', 'تم حذف القسم');
    }

    // Move Section Up
    public function moveSectionUp(PageSection $section)
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

        return back()->with('success', 'تم تحريك القسم للأعلى');
    }

    // Move Section Down
    public function moveSectionDown(PageSection $section)
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

        return back()->with('success', 'تم تحريك القسم للأسفل');
    }

    // Batch Update Sections
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
            $isActive = isset($payload['is_active']) ? (bool)$payload['is_active'] : false;
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

        return back()->with('success', 'تم حفظ جميع التغييرات');
    }

    // ================== TRASH MANAGEMENT ==================

    // Move to Trash (Soft delete)
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('dashboard.pages.index')->with('success', 'تم نقل الصفحة إلى سلة المحذوفات');
    }

    // Restore from trash
    public function restore(int $id)
    {
        $page = Page::onlyTrashed()->findOrFail($id);
        $page->restore();
        return back()->with('success', 'تم استرجاع الصفحة');
    }

    // Delete permanently
    public function forceDelete(int $id)
    {
        $page = Page::onlyTrashed()->findOrFail($id);
        $page->forceDelete();
        return back()->with('success', 'تم حذف الصفحة نهائيًا');
    }

    // Bulk actions (trash / restore / delete permanently)
    public function bulk(Request $request)
    {
        $request->validate([
            'action' => ['required', Rule::in(['trash', 'restore', 'delete'])],
            'ids' => ['required', 'array'],
            'ids.*' => ['integer'],
        ]);

        $ids = $request->ids;

        if ($request->action === 'trash') {
            Page::whereIn('id', $ids)->delete();
            return back()->with('success', 'تم نقل المحدد إلى السلة');
        }

        if ($request->action === 'restore') {
            Page::onlyTrashed()->whereIn('id', $ids)->restore();
            return back()->with('success', 'تم استرجاع المحدد');
        }

        Page::onlyTrashed()->whereIn('id', $ids)->forceDelete();
        return back()->with('success', 'تم حذف المحدد نهائيًا');
    }

    // ================== HELPER METHODS ==================

    private function validatePage(Request $request, ?int $ignoreId = null): array
    {
        $rules = [
            'title_ar' => ['nullable', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('pages', 'slug')->ignore($ignoreId)],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'excerpt_ar' => ['nullable', 'string', 'max:5000'],
            'excerpt_en' => ['nullable', 'string', 'max:5000'],
            'content' => ['nullable', 'string'],
        ];

        $v = $request->validate($rules);

        if (empty($v['title_ar']) && empty($v['title_en'])) {
            abort(422, 'يجب إدخال عنوان عربي أو إنجليزي على الأقل');
        }

        return [
            'slug' => $v['slug'] ?? null,
            'status' => $v['status'],
            'title' => [
                'ar' => $v['title_ar'] ?? '',
                'en' => $v['title_en'] ?? '',
            ],
            'excerpt' => [
                'ar' => $v['excerpt_ar'] ?? '',
                'en' => $v['excerpt_en'] ?? '',
            ],
            'content' => $v['content'] ?? null,
        ];
    }

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

    // Preview Page
    public function preview(Page $page)
    {
        // يمكنك إضافة منطق المعاينة هنا
        return view('pages.preview', compact('page'));
    }
    public function toggleStatus(Request $request, Page $page)
    {
        $page->status = $request->status == 1 ? 'published' : 'draft';
        $page->save();

        return response()->json([
            'success' => true,
            'message' => $page->status === 'published'
                ? 'تم نشر الصفحة'
                : 'تم تحويل الصفحة إلى مسودة'
        ]);
    }
    public function reorder(Request $request)
    {
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

}
