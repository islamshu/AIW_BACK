<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\Media;

class PagePreviewController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)
        ->where('status', 'published')
        ->firstOrFail();

        $all = $page->sections()
            ->orderBy('order')
            ->get()
            ->map(fn($section) => $this->hydrateSectionMedia($section)); // ⭐ هنا

        $layouts = $all->groupBy('layout_id')->map(function ($layoutSections, $layoutId) {

            $containers = $layoutSections->where('type', 'empty')
                ->sortBy('column_index')
                ->values();

            $realSections = $layoutSections->where('type', '!=', 'empty')
                ->where('is_active', true)
                ->sortBy('order')
                ->values();

            $columns = $containers->map(function ($container) use ($realSections) {

                $colIndex = (int) $container->column_index;
                $colWidth = (int) (data_get($container->data, 'col') ?? 12);

                $sectionsForThisColumn = $realSections
                    ->where('column_index', $colIndex)
                    ->values();

                return [
                    'col' => $colWidth,
                    'column_index' => $colIndex,
                    'container' => $container,
                    'sections' => $sectionsForThisColumn
                ];
            })->values();

            return [
                'id' => $layoutId,
                'columns' => $columns,
            ];
        })->values();

        return view('website.pages.preview', compact('page', 'layouts'));
    }
    public function showdash($id)
    {
        $page = Page::findOrFail($id);

        $all = $page->sections()
            ->orderBy('order')
            ->get()
            ->map(fn($section) => $this->hydrateSectionMedia($section)); // ⭐ هنا

        $layouts = $all->groupBy('layout_id')->map(function ($layoutSections, $layoutId) {

            $containers = $layoutSections->where('type', 'empty')
                ->sortBy('column_index')
                ->values();

            $realSections = $layoutSections->where('type', '!=', 'empty')
                ->where('is_active', true)
                ->sortBy('order')
                ->values();

            $columns = $containers->map(function ($container) use ($realSections) {

                $colIndex = (int) $container->column_index;
                $colWidth = (int) (data_get($container->data, 'col') ?? 12);

                $sectionsForThisColumn = $realSections
                    ->where('column_index', $colIndex)
                    ->values();

                return [
                    'col' => $colWidth,
                    'column_index' => $colIndex,
                    'container' => $container,
                    'sections' => $sectionsForThisColumn
                ];
            })->values();

            return [
                'id' => $layoutId,
                'columns' => $columns,
            ];
        })->values();

        return view('website.pages.preview', compact('page', 'layouts'));
    }

    private function hydrateSectionMedia($section)
    {
        $data = $section->data ?? [];

        // صورة عامة للقسم (Hero / Text / Stats ...)
        if (!empty($data['image_id'])) {
            $media = Media::find($data['image_id']);
            $data['image'] = $media?->url;
        }

        // صورة خلفية (CTA)
        if (!empty($data['background_image_id'])) {
            $media = Media::find($data['background_image_id']);
            $data['background_image'] = $media?->url;
        }

        // Repeater items
        if (!empty($data['items']) && is_array($data['items'])) {
            foreach ($data['items'] as $i => $item) {
                if (!empty($item['image_id'])) {
                    $media = Media::find($item['image_id']);
                    $data['items'][$i]['image'] = $media?->url;
                }
            }
        }

        $section->data = $data;
        return $section;
    }
}
