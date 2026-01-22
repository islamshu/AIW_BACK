@php
    $meta = $sectionsRegistry[$section->type] ?? [];
    $data = is_array($section->data) ? $section->data : [];
@endphp

<div class="section-chip js-section-chip" id="section-{{ $section->id }}">
    <input type="hidden" name="sections[{{ $section->id }}][id]" value="{{ $section->id }}">
    <input type="hidden" name="sections[{{ $section->id }}][layout_id]" value="{{ $layout['id'] }}">
    <input type="hidden" name="sections[{{ $section->id }}][column_index]" value="{{ $colIndex }}">
    <input type="hidden" name="sections[{{ $section->id }}][order]" value="{{ $section->order }}">
    <input type="hidden" name="sections[{{ $section->id }}][_delete]" class="js-delete-flag" value="0">
    <input type="hidden" name="sections[{{ $section->id }}][type]" value="{{ $section->type }}">
    <input type="hidden" name="sections[{{ $section->id }}][is_active]" value="0">
    
    <div class="section-header">
        <div class="section-title">
            <strong>{{ $meta['icon'] ?? '🧱' }} {{ $meta['label'] ?? $section->type }}</strong>
            @if(!$section->is_active)
            <span class="badge badge-warning ml-2">مخفي</span>
            @endif
        </div>
        
        <div class="d-flex align-items-center">
            <div class="custom-control custom-switch mr-2">
                <input type="checkbox" class="custom-control-input" 
                       name="sections[{{ $section->id }}][is_active]" 
                       id="active-{{ $section->id }}" 
                       value="1" {{ $section->is_active ? 'checked' : '' }}>
                <label class="custom-control-label" for="active-{{ $section->id }}"></label>
            </div>
            
            <button type="button" class="btn btn-danger btn-sm js-mark-delete">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
    
    <hr class="my-3">
    
    <!-- HERO Section -->
    @if($section->type === 'hero')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold">العنوان عربي</label>
                <input type="text" class="form-control" 
                       name="sections[{{ $section->id }}][data][title_ar]"
                       value="{{ $data['title_ar'] ?? '' }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold">Title English</label>
                <input type="text" class="form-control" 
                       name="sections[{{ $section->id }}][data][title_en]"
                       value="{{ $data['title_en'] ?? '' }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="font-weight-bold">الوصف عربي</label>
                <textarea class="form-control" rows="3"
                          name="sections[{{ $section->id }}][data][desc_ar]">{{ $data['desc_ar'] ?? '' }}</textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="font-weight-bold">Description English</label>
                <textarea class="form-control" rows="3"
                          name="sections[{{ $section->id }}][data][desc_en]">{{ $data['desc_en'] ?? '' }}</textarea>
            </div>
        </div>
    </div>
    @endif
    
    <!-- TEXT Section -->
    @if($section->type === 'text')
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label class="font-weight-bold">النص عربي</label>
                <textarea class="form-control" rows="4"
                          name="sections[{{ $section->id }}][data][text_ar]">{{ $data['text_ar'] ?? '' }}</textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="font-weight-bold">Text English</label>
                <textarea class="form-control" rows="4"
                          name="sections[{{ $section->id }}][data][text_en]">{{ $data['text_en'] ?? '' }}</textarea>
            </div>
        </div>
    </div>
    @endif
    
    <!-- REPEATER Section -->
    @if($section->type === 'repeater')
    @php
        $items = $data['items'] ?? [];
        $displayMode = $data['display_mode'] ?? 'multi';
    @endphp
    
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold">عنوان القسم (عربي)</label>
                <input type="text" class="form-control" 
                       name="sections[{{ $section->id }}][data][title_ar]"
                       value="{{ $data['title_ar'] ?? '' }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold">Section Title (English)</label>
                <input type="text" class="form-control" 
                       name="sections[{{ $section->id }}][data][title_en]"
                       value="{{ $data['title_en'] ?? '' }}">
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label class="font-weight-bold d-block mb-2">طريقة العرض</label>
        <select class="form-control" name="sections[{{ $section->id }}][data][display_mode]">
            <option value="multi" {{ $displayMode === 'multi' ? 'selected' : '' }}>كل عنصر داخل كارد مستقل</option>
            <option value="single" {{ $displayMode === 'single' ? 'selected' : '' }}>جميع العناصر داخل كارد واحد</option>
        </select>
    </div>
    
    <div class="mb-3">
        <button type="button" class="btn btn-outline-primary js-add-repeater-item" 
                data-section="{{ $section->id }}">
            <i class="fas fa-plus mr-1"></i>
            إضافة عنصر
        </button>
    </div>
    
    <div class="repeater-items" data-section="{{ $section->id }}">
        @foreach($items as $index => $item)
        <div class="repeater-item border rounded p-3 mb-3">
            <input type="hidden" 
                   name="sections[{{ $section->id }}][data][items][{{ $index }}][order]" 
                   value="{{ $item['order'] ?? $index }}">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>العنوان (عربي)</label>
                        <input type="text" class="form-control" 
                               name="sections[{{ $section->id }}][data][items][{{ $index }}][title_ar]"
                               value="{{ $item['title_ar'] ?? '' }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Title (English)</label>
                        <input type="text" class="form-control" 
                               name="sections[{{ $section->id }}][data][items][{{ $index }}][title_en]"
                               value="{{ $item['title_en'] ?? '' }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>الوصف (عربي)</label>
                        <textarea class="form-control" rows="3"
                                  name="sections[{{ $section->id }}][data][items][{{ $index }}][desc_ar]">{{ $item['desc_ar'] ?? '' }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Description (English)</label>
                        <textarea class="form-control" rows="3"
                                  name="sections[{{ $section->id }}][data][items][{{ $index }}][desc_en]">{{ $item['desc_en'] ?? '' }}</textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-danger btn-block js-remove-repeater-item">
                        <i class="fas fa-trash mr-1"></i>حذف العنصر
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>