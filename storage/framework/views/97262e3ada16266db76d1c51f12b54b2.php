
<?php $__env->startSection('title', $page->exists ? 'تعديل صفحة' : 'إضافة صفحة جديدة'); ?>
<?php $__env->startSection('style'); ?>
    <style>
        /* =====================================================
                                       ROOT VARIABLES - نظام ألوان احترافي
                                    ===================================================== */
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --danger-gradient: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
            --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --info-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);

            --bg-main: #f5f7fb;
            --bg-card: #ffffff;
            --border-color: #e2e8f0;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 8px 30px rgba(0, 0, 0, 0.12);
            --shadow-xl: 0 20px 50px rgba(0, 0, 0, 0.15);

            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
        }

        /* =====================================================
                                       GENERAL BODY
                                    ===================================================== */
        body {
            background: var(--bg-main);
            font-family: 'Cairo', 'Segoe UI', Tahoma, sans-serif;
            color: var(--text-primary);
        }

        /* =====================================================
                                       PAGE BUILDER CONTAINER
                                    ===================================================== */
        .page-builder {
            background: var(--bg-card);
            padding: 28px;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .page-builder:hover {
            box-shadow: var(--shadow-lg);
        }

        /* =====================================================
                                       ENHANCED CARDS
                                    ===================================================== */
        .card {
            border-radius: var(--radius-lg);
            border: none;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .card-header {
            background: linear-gradient(180deg, #fafbfc 0%, #ffffff 100%);
            border-radius: var(--radius-lg) var(--radius-lg) 0 0 !important;
            border-bottom: 2px solid #f1f5f9;
            font-weight: 700;
            font-size: 1.05rem;
            padding: 18px 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-body {
            padding: 24px;
        }

        /* =====================================================
                                       LAYOUT PRESETS - تصميم متطور
                                    ===================================================== */
        .layout-preset {
            border: 2px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 18px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: var(--bg-card);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .layout-preset::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--primary-gradient);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 0;
        }

        .layout-preset:hover {
            border-color: #667eea;
            transform: translateY(-4px) scale(1.02);
            box-shadow: var(--shadow-lg);
        }

        .layout-preset:hover::before {
            opacity: 0.03;
        }

        .layout-preset.active {
            border-color: #667eea;
            background: linear-gradient(180deg, #f8f9ff, #ffffff);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .layout-preset>* {
            position: relative;
            z-index: 1;
        }

        .preset-preview {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 4px;
            margin-bottom: 12px;
            height: 42px;
        }

        .preset-preview span {
            height: 100%;
            border-radius: 6px;
            background: #e5e7eb;
            transition: all 0.3s ease;
        }

        .preset-preview span.fill {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
        }

        .layout-preset:hover .preset-preview span.fill {
            transform: translateY(-2px);
        }

        /* =====================================================
                                       LAYOUT ROW - تصميم أنيق
                                    ===================================================== */
        .layout-row {
            border: 2px solid var(--border-color);
            border-radius: var(--radius-xl);
            padding: 24px;
            background: linear-gradient(180deg, #ffffff, #fafbfc);
            margin-bottom: 32px;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            position: relative;
        }

        .layout-row::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--primary-gradient);
            border-radius: var(--radius-xl) 0 0 var(--radius-xl);
        }

        .layout-row:hover {
            border-color: #cbd5e1;
            box-shadow: var(--shadow-md);
        }

        .layout-row-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid #f1f5f9;
        }

        .layout-row-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* =====================================================
                                       COLUMNS - تصميم جذاب
                                    ===================================================== */
        .column-box {
            border: 2px dashed #cbd5e1;
            border-radius: var(--radius-lg);
            padding: 20px;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            min-height: 180px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .column-box::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: var(--radius-lg);
            background: var(--primary-gradient);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .column-box:hover {
            border-color: #667eea;
            border-style: solid;
            background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .column-box:hover::before {
            opacity: 0.02;
        }

        .column-box>* {
            position: relative;
            z-index: 1;
        }

        .column-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e2e8f0;
        }

        .column-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* =====================================================
                                       SECTIONS - بطاقات أنيقة
                                    ===================================================== */
        .section-chip {
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 18px 18px 18px 22px;
            margin-bottom: 16px;
            background: linear-gradient(135deg, #fafbfc 0%, #ffffff 100%);
            position: relative;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        .section-chip::before {
            content: "";
            position: absolute;
            left: 0;
            top: 18px;
            bottom: 18px;
            width: 4px;
            background: var(--primary-gradient);
            border-radius: 4px;
        }

        .section-chip:hover {
            border-color: #cbd5e1;
            box-shadow: var(--shadow-md);
            transform: translateX(4px);
        }

        .section-chip.deleted {
            opacity: 0.5;
            border-color: #fca5a5;
            background: linear-gradient(135deg, #fef2f2 0%, #ffffff 100%);
        }

        .section-chip.deleted::before {
            background: var(--danger-gradient);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .section-title {
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--text-primary);
        }

        /* =====================================================
                                       EMPTY STATE
                                    ===================================================== */
        .empty-column {
            text-align: center;
            padding: 40px 24px;
            color: var(--text-secondary);
        }

        .empty-column::before {
            content: '📦';
            display: block;
            font-size: 3rem;
            margin-bottom: 12px;
            opacity: 0.5;
        }

        /* =====================================================
                                       BUTTONS - أزرار احترافية
                                    ===================================================== */
        .btn {
            border-radius: var(--radius-sm);
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            box-shadow: var(--shadow-sm);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-primary {
            background: var(--primary-gradient);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5568d3 0%, #6a3f8f 100%);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: var(--success-gradient);
            color: white;
        }

        .btn-success:hover {
            box-shadow: 0 8px 20px rgba(17, 153, 142, 0.4);
        }

        .btn-danger,
        .btn-outline-danger:hover {
            background: var(--danger-gradient);
            color: white;
            border: none;
        }

        .btn-outline-primary {
            background: white;
            border: 2px solid #667eea;
            color: #667eea;
        }

        .btn-outline-primary:hover {
            background: var(--primary-gradient);
            color: white;
            border-color: transparent;
        }

        .btn-outline-danger {
            background: white;
            border: 2px solid #f43f5e;
            color: #f43f5e;
        }

        .btn-outline-secondary {
            background: white;
            border: 2px solid var(--border-color);
            color: var(--text-secondary);
        }

        .btn-outline-secondary:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: var(--text-primary);
        }

        .btn-lg {
            padding: 14px 32px;
            font-size: 1.05rem;
        }

        .btn-sm {
            padding: 6px 14px;
            font-size: 0.875rem;
        }

        /* =====================================================
                                       BADGES - شارات جميلة
                                    ===================================================== */
        .badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .bg-primary {
            background: var(--primary-gradient) !important;
        }

        .bg-success {
            background: var(--success-gradient) !important;
        }

        .bg-warning {
            background: var(--warning-gradient) !important;
        }

        .bg-secondary {
            background: linear-gradient(135deg, #6b7280 0%, #9ca3af 100%) !important;
        }

        /* =====================================================
                                       FLOATING SETTINGS PANEL - لوحة جانبية احترافية
                                    ===================================================== */
        .page-settings-panel {
            position: fixed;
            top: 90px;
            right: 20px;
            width: 260px;
            z-index: 1050;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .page-settings-panel.collapsed {
            width: 100px;
        }

        .page-settings-panel.dragging {
            cursor: grabbing;
            opacity: 0.95;
        }

        .settings-card {
            background: linear-gradient(135deg, #ffffff 0%, #fafbfc 100%);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            max-height: calc(100vh - 120px);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .settings-header {
            padding: 16px 20px;
            font-weight: 700;
            background: var(--primary-gradient);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            user-select: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .settings-header:hover {
            background: linear-gradient(135deg, #5568d3 0%, #6a3f8f 100%);
        }

        .settings-header .drag-handle {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            cursor: grab;
        }

        .settings-header .drag-handle:active {
            cursor: grabbing;
        }

        .settings-header .collapse-toggle {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .settings-header .collapse-toggle:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .settings-header .collapse-toggle i {
            transition: transform 0.3s ease;
        }

        .page-settings-panel.collapsed .collapse-toggle i {
            transform: rotate(180deg);
        }

        .page-settings-panel.collapsed .settings-header-text {
            display: none;
        }

        .settings-body {
            padding: 18px;
            overflow-y: auto;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            gap: 14px;
            transition: all 0.3s ease;
        }

        .page-settings-panel.collapsed .settings-body {
            display: none;
        }

        .settings-body::-webkit-scrollbar {
            width: 6px;
        }

        .settings-body::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #667eea, #764ba2);
            border-radius: 10px;
        }

        .settings-body::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        /* زر حفظ الكل - مميز جداً */
        .btn-save-all {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 700;
            font-size: 1.05rem;
            padding: 14px 24px;
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            position: relative;
            overflow: hidden;
            border: none;
        }

        .btn-save-all::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-save-all:hover {
            background: linear-gradient(135deg, #5568d3 0%, #6a3f8f 100%);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.6);
            transform: translateY(-2px);
        }

        .btn-save-all:hover::before {
            width: 400px;
            height: 400px;
        }

        .btn-save-all:active {
            transform: translateY(0);
        }

        .btn-save-all i,
        .btn-save-all span {
            position: relative;
            z-index: 1;
        }

        /* Animation عند الحفظ */
        .btn-save-all.saving {
            pointer-events: none;
            background: linear-gradient(135deg, #9ca3af 0%, #6b7280 100%);
        }

        .btn-save-all.saving .fa-save {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* =====================================================
                                       FORM CONTROLS - حقول احترافية
                                    ===================================================== */
        .form-control,
        .form-select {
            border-radius: var(--radius-sm);
            border: 2px solid var(--border-color);
            padding: 10px 14px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        /* =====================================================
                                       REPEATER ITEMS - عناصر متكررة
                                    ===================================================== */
        .repeater-item {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 2px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 20px;
            margin-bottom: 16px;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        .repeater-item:hover {
            border-color: #cbd5e1;
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        /* =====================================================
                                       ICON PICKER
                                    ===================================================== */
        .icon-preview {
            padding: 16px;
            background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
            border-radius: var(--radius-sm);
            text-align: center;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed #e2e8f0;
        }

        /* =====================================================
                                       MODALS - نوافذ منبثقة أنيقة
                                    ===================================================== */
        .modal-content {
            border-radius: var(--radius-lg);
            border: none;
            box-shadow: var(--shadow-xl);
            overflow: hidden;
        }

        .modal-header {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 20px 24px;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
        }

        .modal-body {
            padding: 28px;
        }

        /* =====================================================
                                       ALERTS - تنبيهات جميلة
                                    ===================================================== */
        .alert {
            border-radius: var(--radius-md);
            border: none;
            padding: 16px 20px;
            box-shadow: var(--shadow-sm);
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fecaca 0%, #fca5a5 100%);
            color: #991b1b;
        }

        /* =====================================================
                                       ANIMATIONS
                                    ===================================================== */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .layout-row,
        .column-box,
        .section-chip {
            animation: slideIn 0.4s ease-out;
        }

        /* =====================================================
                                       RESPONSIVE
                                    ===================================================== */
        @media (max-width: 768px) {
            .page-settings-panel {
                width: 100%;
                left: 0;
                right: 0;
                top: auto;
                bottom: 0;
                border-radius: var(--radius-lg) var(--radius-lg) 0 0;
            }

            .page-builder {
                padding: 16px;
            }

            .layout-row {
                padding: 16px;
            }

            .column-box {
                padding: 14px;
            }
        }
    </style>
    <style>
        .layout-option {
            cursor: pointer;
            padding: 15px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .layout-option:hover {
            border-color: #4F46E5;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .layout-option.active {
            border-color: #4F46E5;
            background-color: #f8fafc;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .preview-box>div>div {
            transition: all 0.3s;
        }

        .layout-option:hover .preview-box>div>div {
            opacity: 0.9;
        }
        .section-image-preview {
    background: linear-gradient(135deg, #f8f9fa, #eef1f5);
    border: 2px dashed rgba(13,110,253,.25);
    border-radius: 18px;
    padding: 22px;
    transition: all .3s ease;
}

.section-image-preview:hover {
    border-color: #0d6efd;
    background: #f1f7ff;
}

.section-image-preview img {
    transition: all .3s ease;
}

    </style>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($e); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="container-fluid">

        
        <div class="page-main-full">

            <?php if($page->exists): ?>
                
                <form id="masterForm" method="POST" action="<?php echo e(route('dashboard.pages.saveAll', $page)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    
                    <div class="card shadow-sm page-builder mb-4">
                        <div class="card-header fw-bold bg-white d-flex justify-content-between">
                            <span>
                                <i class="fas fa-file-alt me-2"></i>
                                بيانات الصفحة
                            </span>
                            <span class="badge <?php echo e($page->status === 'published' ? 'bg-success' : 'bg-warning'); ?>">
                                <?php echo e($page->status === 'published' ? '✅ منشورة' : '📝 مسودة'); ?>

                            </span>
                        </div>

                        <div class="card-body">
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">العنوان (عربي)</label>
                                    <input type="text" name="title_ar" class="form-control"
                                        value="<?php echo e(old('title_ar', $page->title['ar'] ?? '')); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Title (English)</label>
                                    <input type="text" name="title_en" class="form-control"
                                        value="<?php echo e(old('title_en', $page->title['en'] ?? '')); ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Slug</label>
                                <input type="text" name="slug" class="form-control"
                                    value="<?php echo e(old('slug', $page->slug ?? '')); ?>">
                                <small class="text-muted">اتركه فارغاً للتوليد التلقائي</small>
                            </div>
                        </div>
                    </div>

                    
                    <div class="card shadow-sm page-builder">
                        <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fas fa-layer-group me-2"></i>
                                Layout Builder
                                <small class="text-muted ms-2">(<?php echo e(count($layouts)); ?> layout)</small>
                            </span>

                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                data-target="#addLayoutModal">
                                <i class="fas fa-plus me-1"></i>
                                إضافة Layout
                            </button>
                        </div>

                        <div class="card-body">

                            <?php if(count($layouts)): ?>

                                <?php $__currentLoopData = $layouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $layoutIndex => $layout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="layout-row" id="layout-<?php echo e($layout['id']); ?>">

                                        <div class="layout-row-header">
                                            <div class="layout-row-title">
                                                🧩 Layout Row #<?php echo e($layoutIndex + 1); ?>

                                                <small class="text-muted">(ID:
                                                    <?php echo e(substr($layout['id'], 0, 8)); ?>...)</small>
                                            </div>

                                            
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                form="delete-layout-<?php echo e($layout['id']); ?>"
                                                onclick="return confirm('هل أنت متأكد من حذف هذا الـ Layout بالكامل؟')">
                                                <i class="fas fa-trash me-1"></i>
                                                حذف Layout
                                            </button>
                                        </div>

                                        <div class="row g-3 mt-3">

                                            <?php $__currentLoopData = $layout['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $colIndex => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $colWidth = (int) ($column['col'] ?? 12);
                                                    $sections = $column['sections'];
                                                ?>

                                                <div class="col-12 col-lg-<?php echo e($colWidth); ?>">
                                                    <div class="column-box">

                                                        <div class="column-header">
                                                            <div class="column-title">
                                                                <i class="fas fa-columns me-2"></i>
                                                                Column <?php echo e($colIndex + 1); ?>

                                                                <span
                                                                    class="badge bg-primary ms-2"><?php echo e($colWidth); ?>/12</span>
                                                            </div>

                                                            <button type="button"
                                                                class="btn btn-sm btn-primary js-open-add-section"
                                                                data-layout="<?php echo e($layout['id']); ?>"
                                                                data-col="<?php echo e($colIndex); ?>">
                                                                <i class="fas fa-plus me-1"></i>
                                                                إضافة قسم
                                                            </button>
                                                        </div>

                                                        <div class="sections-container">

                                                            <?php $__empty_1 = true; $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                                <?php
                                                                    $meta = $sectionsRegistry[$section->type] ?? [];
                                                                    $data = is_array($section->data)
                                                                        ? $section->data
                                                                        : [];
                                                                ?>

                                                                <?php if($section->type !== 'empty'): ?>
                                                                    <div class="section-chip js-section-chip">

                                                                        <input type="hidden"
                                                                            name="sections[<?php echo e($section->id); ?>][id]"
                                                                            value="<?php echo e($section->id); ?>">
                                                                        <input type="hidden"
                                                                            name="sections[<?php echo e($section->id); ?>][layout_id]"
                                                                            value="<?php echo e($layout['id']); ?>">
                                                                        <input type="hidden"
                                                                            name="sections[<?php echo e($section->id); ?>][column_index]"
                                                                            value="<?php echo e($colIndex); ?>">
                                                                        <input type="hidden"
                                                                            name="sections[<?php echo e($section->id); ?>][order]"
                                                                            value="<?php echo e($section->order); ?>">
                                                                        <input type="hidden"
                                                                            name="sections[<?php echo e($section->id); ?>][_delete]"
                                                                            class="js-delete-flag" value="0">
                                                                        <input type="hidden"
                                                                            name="sections[<?php echo e($section->id); ?>][type]"
                                                                            value="<?php echo e($section->type); ?>">
                                                                        <input type="hidden"
                                                                            name="sections[<?php echo e($section->id); ?>][is_active]"
                                                                            value="0">

                                                                        <div class="section-header">
                                                                            <div class="section-title">
                                                                                <strong><?php echo e($meta['icon'] ?? '🧱'); ?>

                                                                                    <?php echo e($meta['label'] ?? $section->type); ?></strong>
                                                                                <?php if(!$section->is_active): ?>
                                                                                    <span
                                                                                        class="badge bg-warning ms-2">مخفي</span>
                                                                                <?php endif; ?>
                                                                            </div>

                                                                            <div class="d-flex gap-2">
                                                                                <input type="checkbox"
                                                                                    name="sections[<?php echo e($section->id); ?>][is_active]"
                                                                                    value="1"
                                                                                    <?php echo e($section->is_active ? 'checked' : ''); ?>>
                                                                                <button type="button"
                                                                                    class="btn btn-sm btn-outline-danger js-mark-delete">
                                                                                    <i class="fas fa-trash"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>

                                                                        <hr>

                                                                        
                                                                        <?php if($section->type === 'hero'): ?>
                                                                        <div class="row g-3">
                                                                            <div class="col-md-6">
                                                                                <label class="fw-bold">العنوان
                                                                                    عربي</label>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    name="sections[<?php echo e($section->id); ?>][data][title_ar]"
                                                                                    value="<?php echo e($data['title_ar'] ?? ''); ?>">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="fw-bold">Title
                                                                                    English</label>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    name="sections[<?php echo e($section->id); ?>][data][title_en]"
                                                                                    value="<?php echo e($data['title_en'] ?? ''); ?>">
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <label class="fw-bold">الوصف
                                                                                    عربي</label>
                                                                                <textarea class="form-control js-editor" name="sections[<?php echo e($section->id); ?>][data][desc_ar]"><?php echo e($data['desc_ar'] ?? ''); ?></textarea>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <label class="fw-bold">Description
                                                                                    English</label>
                                                                                <textarea class="form-control js-editor" name="sections[<?php echo e($section->id); ?>][data][desc_en]"><?php echo e($data['desc_en'] ?? ''); ?></textarea>
                                                                            </div>
                                                                            
<div class="col-12 mt-4 pt-3 border-top">
    <h6 class="fw-bold mb-3">
        <i class="fas fa-mouse-pointer me-2"></i>
        زر الدعوة (CTA)
    </h6>

    <div class="row g-3">

        
        <div class="col-md-6">
            <label class="fw-bold">نص الزر (عربي)</label>
            <input type="text"
                   class="form-control"
                   name="sections[<?php echo e($section->id); ?>][data][cta_text_ar]"
                   value="<?php echo e($data['cta_text_ar'] ?? ''); ?>"
                   placeholder="ابدأ رحلتك معنا">
        </div>

        
        <div class="col-md-6">
            <label class="fw-bold">Button Text (English)</label>
            <input type="text"
                   class="form-control"
                   name="sections[<?php echo e($section->id); ?>][data][cta_text_en]"
                   value="<?php echo e($data['cta_text_en'] ?? ''); ?>"
                   placeholder="Start Your Journey">
        </div>

        
        <div class="col-12">
            <label class="fw-bold">رابط الزر</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-link"></i>
                </span>
                <input type="url"
                       class="form-control"
                       name="sections[<?php echo e($section->id); ?>][data][cta_url]"
                       value="<?php echo e($data['cta_url'] ?? ''); ?>"
                       placeholder="https://example.com">
            </div>
            <small class="text-muted">
                يمكنك إدخال رابط داخلي أو خارجي
            </small>
        </div>

    </div>
</div>

                                                                            <?php echo $__env->make('dashboard.pages.sections.images', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                                                        </div>
                                                                        <?php endif; ?>

                                                                        
                                                                        <?php if($section->type === 'text'): ?>
                                                                            <div class="row g-3">
                                                                                <div class="col-12">
                                                                                    <label class="fw-bold">النص
                                                                                        عربي</label>
                                                                                    <textarea class="form-control js-editor" name="sections[<?php echo e($section->id); ?>][data][text_ar]"><?php echo e($data['text_ar'] ?? ''); ?></textarea>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <label class="fw-bold">Text
                                                                                        English</label>
                                                                                    <textarea class="form-control js-editor" name="sections[<?php echo e($section->id); ?>][data][text_en]"><?php echo e($data['text_en'] ?? ''); ?></textarea>
                                                                                </div>
                                                                                <?php echo $__env->make('dashboard.pages.sections.images', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        
                                                                        <?php if($section->type === 'repeater'): ?>
                                                                            <?php
                                                                                $items = $data['items'] ?? [];
                                                                            ?>

                                                                            
                                                                            <div class="row g-3 mb-4">
                                                                                <div class="col-md-6">
                                                                                    <label class="fw-bold">عنوان القسم
                                                                                        (AR)
                                                                                    </label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="sections[<?php echo e($section->id); ?>][data][title_ar]"
                                                                                        value="<?php echo e($data['title_ar'] ?? ''); ?>">
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label class="fw-bold">Section Title
                                                                                        (EN)</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="sections[<?php echo e($section->id); ?>][data][title_en]"
                                                                                        value="<?php echo e($data['title_en'] ?? ''); ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="mb-4">
                                                                                <label class="fw-bold d-block mb-2">طريقة
                                                                                    العرض</label>
                                                                                <select class="form-select"
                                                                                    name="sections[<?php echo e($section->id); ?>][data][display_mode]">
                                                                                    <option value="multi"
                                                                                        <?php echo e(($data['display_mode'] ?? 'multi') === 'multi' ? 'selected' : ''); ?>>
                                                                                        كل عنصر داخل كارد مستقل
                                                                                    </option>
                                                                                    <option value="single"
                                                                                        <?php echo e(($data['display_mode'] ?? '') === 'single' ? 'selected' : ''); ?>>
                                                                                        جميع العناصر داخل كارد واحد
                                                                                    </option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <button type="button"
                                                                                    class="btn btn-sm btn-outline-primary js-add-repeater-item"
                                                                                    data-section="<?php echo e($section->id); ?>">
                                                                                    <i class="fas fa-plus me-1"></i>
                                                                                    إضافة عنصر
                                                                                </button>
                                                                            </div>

                                                                            <div class="repeater-items"
                                                                                data-section="<?php echo e($section->id); ?>">

                                                                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <div
                                                                                        class="border rounded p-3 mb-3 repeater-item">

                                                                                        <input type="hidden"
                                                                                            name="sections[<?php echo e($section->id); ?>][data][items][<?php echo e($index); ?>][order]"
                                                                                            value="<?php echo e($item['order'] ?? $index); ?>">

                                                                                        <div class="row g-3">

                                                                                            
                                                                                            <div class="col-md-6">
                                                                                                <label
                                                                                                    class="fw-bold">العنوان
                                                                                                    (AR)
                                                                                                </label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    name="sections[<?php echo e($section->id); ?>][data][items][<?php echo e($index); ?>][title_ar]"
                                                                                                    value="<?php echo e($item['title_ar'] ?? ''); ?>">
                                                                                            </div>

                                                                                            <div class="col-md-6">
                                                                                                <label
                                                                                                    class="fw-bold">Title
                                                                                                    (EN)</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    name="sections[<?php echo e($section->id); ?>][data][items][<?php echo e($index); ?>][title_en]"
                                                                                                    value="<?php echo e($item['title_en'] ?? ''); ?>">
                                                                                            </div>

                                                                                            
                                                                                            <div class="col-md-6">
                                                                                                <label
                                                                                                    class="fw-bold">الوصف
                                                                                                    (AR)</label>
                                                                                                <textarea class="form-control" rows="4"
                                                                                                    name="sections[<?php echo e($section->id); ?>][data][items][<?php echo e($index); ?>][desc_ar]"><?php echo e($item['desc_ar'] ?? ''); ?></textarea>
                                                                                            </div>

                                                                                            <div class="col-md-6">
                                                                                                <label
                                                                                                    class="fw-bold">Description
                                                                                                    (EN)</label>
                                                                                                <textarea class="form-control" rows="4"
                                                                                                    name="sections[<?php echo e($section->id); ?>][data][items][<?php echo e($index); ?>][desc_en]"><?php echo e($item['desc_en'] ?? ''); ?></textarea>
                                                                                            </div>

                                                                                            
                                                                                            <div class="col-md-6">
                                                                                                <label
                                                                                                    class="fw-bold">الأيقونة</label>

                                                                                                <div
                                                                                                    class="input-group mb-2">
                                                                                                    <input type="text"
                                                                                                        class="form-control icon-input"
                                                                                                        placeholder="fa-solid fa-star"
                                                                                                        name="sections[<?php echo e($section->id); ?>][data][items][<?php echo e($index); ?>][icon]"
                                                                                                        value="<?php echo e($item['icon'] ?? ''); ?>">

                                                                                                    <button type="button"
                                                                                                        class="btn btn-outline-secondary js-open-icon-picker">
                                                                                                        اختيار
                                                                                                    </button>
                                                                                                </div>

                                                                                                
                                                                                                <div
                                                                                                    class="d-flex align-items-center gap-2 mb-2">
                                                                                                    <label
                                                                                                        class="small text-muted mb-0">لون
                                                                                                        الأيقونة</label>

                                                                                                    <input type="color"
                                                                                                        class="form-control form-control-color"
                                                                                                        style="width: 48px; height: 38px;"
                                                                                                        name="sections[<?php echo e($section->id); ?>][data][items][<?php echo e($index); ?>][icon_color]"
                                                                                                        value="<?php echo e($item['icon_color'] ?? '#00b4d8'); ?>">
                                                                                                </div>

                                                                                                
                                                                                                <div
                                                                                                    class="icon-preview mt-2">
                                                                                                    <?php if(!empty($item['icon'])): ?>
                                                                                                        <i class="<?php echo e($item['icon']); ?> fa-2x"
                                                                                                            style="color: <?php echo e($item['icon_color'] ?? '#00b4d8'); ?>"></i>
                                                                                                    <?php endif; ?>
                                                                                                </div>
                                                                                            </div>

                                                                                            
                                                                                            <div
                                                                                                class="col-md-3 d-flex align-items-end">
                                                                                                <button type="button"
                                                                                                    class="btn btn-outline-danger w-100 js-remove-repeater-item">
                                                                                                    <i
                                                                                                        class="fas fa-trash"></i>
                                                                                                </button>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                                            </div>
                                                                        <?php endif; ?>

                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                                <div class="empty-column">
                                                                    <p class="text-muted">لا يوجد أقسام بعد</p>
                                                                </div>
                                                            <?php endif; ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="text-center py-5">
                                    <div class="mb-3" style="font-size: 4rem; opacity: 0.3;">📦</div>
                                    <h4 class="text-muted">لا يوجد Layouts</h4>
                                    <p class="text-muted">ابدأ بإضافة Layout جديد</p>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </form>

                
                <?php $__currentLoopData = $layouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $layout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <form id="delete-layout-<?php echo e($layout['id']); ?>" method="POST"
                        action="<?php echo e(route('dashboard.layouts.destroy', [$page, $layout['id']])); ?>" class="d-none">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                    </form>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                
                <form id="pageForm" method="POST" action="<?php echo e(route('dashboard.pages.store')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="card shadow-sm page-builder">
                        <div class="card-header fw-bold bg-white">
                            <i class="fas fa-file-plus me-2"></i>
                            إنشاء صفحة جديدة
                        </div>

                        <div class="card-body">
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">العنوان (عربي)</label>
                                    <input type="text" name="title_ar" class="form-control"
                                        value="<?php echo e(old('title_ar')); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Title (English)</label>
                                    <input type="text" name="title_en" class="form-control"
                                        value="<?php echo e(old('title_en')); ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Slug</label>
                                <input type="text" name="slug" class="form-control" value="<?php echo e(old('slug')); ?>">
                                <small class="text-muted">اتركه فارغاً للتوليد التلقائي</small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">حالة النشر</label>
                                <select name="status" class="form-select">
                                    <option value="draft" selected>📝 مسودة</option>
                                    <option value="published">✅ منشورة</option>
                                </select>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i>إنشاء الصفحة
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="alert alert-info mt-4">
                    <i class="fas fa-info-circle me-2"></i>
                    بعد حفظ بيانات الصفحة يمكنك البدء ببناء الـ Layout والأقسام.
                </div>
            <?php endif; ?>

        </div>

    </div>

    
    <?php if($page->exists): ?>
        <div class="page-settings-panel" id="settingsPanel">
            <div class="settings-card">
                
                <div class="settings-header">
                    <div class="drag-handle">
                        <i class="fas fa-cog"></i>
                        <span class="settings-header-text">الإعدادات</span>
                    </div>
                    <button type="button" class="collapse-toggle" id="toggleSettings">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                
                <div class="settings-body">

                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-flag me-2"></i>
                            حالة النشر
                        </label>
                        <select name="status" form="masterForm"
                            class="form-select <?php echo e($page->status === 'published' ? 'border-success' : 'border-warning'); ?>"
                            style="font-weight: 500;">
                            <option value="draft" <?php if(old('status', $page->status ?? 'draft') == 'draft'): echo 'selected'; endif; ?>>
                                📝 مسودة
                            </option>
                            <option value="published" <?php if(old('status', $page->status ?? 'draft') == 'published'): echo 'selected'; endif; ?>>
                                ✅ منشورة
                            </option>
                        </select>

                        
                        <div class="text-center mt-2">
                            <?php if($page->status === 'published'): ?>
                                <span
                                    class="badge bg-success bg-opacity-10 border border-success border-opacity-25 px-3 py-2">
                                    <i class="fas fa-check-circle me-1"></i>
                                    منشورة حالياً
                                </span>
                            <?php else: ?>
                                <span
                                    class="badge bg-warning bg-opacity-10 border border-warning border-opacity-25 px-3 py-2">
                                    <i class="fas fa-edit me-1"></i>
                                    مسودة حالياً
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>


                    
                    <button type="submit" form="masterForm" class="btn btn-save-all w-100 " id="saveAllBtn">
                        <i class="fas fa-save me-2"></i>
                        <span>حفظ جميع التغييرات</span>
                    </button>


                    
                    <a href="<?php echo e(route('dashboard.pages.preview', $page)); ?>" target="_blank"
                        class="btn btn-outline-dark w-100 mb-2">
                        <i class="fas fa-eye me-2"></i>
                        معاينة الصفحة
                    </a>

                    
                    <button type="button" class="btn btn-outline-primary w-100" data-toggle="modal"
                        data-target="#addLayoutModal">
                        <i class="fas fa-plus me-1"></i>
                        إضافة Layout
                    </button>

                </div>
            </div>
        </div>
    <?php endif; ?>

    
    <?php if($page->exists): ?>
        <div class="modal fade" id="addLayoutModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">
                            <i class="fas fa-plus-circle me-2"></i>إضافة Layout جديد
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3">
                            <!-- Full Width 12 -->
                            <div class="col-md-4">
                                <div class="layout-option js-layout-preset active" data-cols="12">
                                    <div class="preview-box bg-primary mb-2" style="height: 80px; border-radius: 6px;">
                                    </div>
                                    <div class="text-center">
                                        <div class="fw-bold">عمود كامل</div>
                                        <small class="text-muted">12</small>
                                    </div>
                                </div>
                            </div>

                            <!-- 6,6 -->
                            <div class="col-md-4">
                                <div class="layout-option js-layout-preset" data-cols="6,6">
                                    <div class="preview-box mb-2"
                                        style="height: 80px; border-radius: 6px; overflow: hidden;">
                                        <div class="d-flex h-100">
                                            <div class="col-6 bg-primary"></div>
                                            <div class="col-6 bg-success"></div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="fw-bold">نصفين</div>
                                        <small class="text-muted">6 / 6</small>
                                    </div>
                                </div>
                            </div>

                            <!-- 8,4 -->
                            <div class="col-md-4">
                                <div class="layout-option js-layout-preset" data-cols="8,4">
                                    <div class="preview-box mb-2"
                                        style="height: 80px; border-radius: 6px; overflow: hidden;">
                                        <div class="d-flex h-100">
                                            <div class="col-8 bg-primary"></div>
                                            <div class="col-4 bg-info"></div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="fw-bold">أوسع + أضيق</div>
                                        <small class="text-muted">8 / 4</small>
                                    </div>
                                </div>
                            </div>

                            <!-- 4,8 -->
                            <div class="col-md-4">
                                <div class="layout-option js-layout-preset" data-cols="4,8">
                                    <div class="preview-box mb-2"
                                        style="height: 80px; border-radius: 6px; overflow: hidden;">
                                        <div class="d-flex h-100">
                                            <div class="col-4 bg-info"></div>
                                            <div class="col-8 bg-primary"></div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="fw-bold">أضيق + أوسع</div>
                                        <small class="text-muted">4 / 8</small>
                                    </div>
                                </div>
                            </div>

                            <!-- 4,4,4 -->
                            <div class="col-md-4">
                                <div class="layout-option js-layout-preset" data-cols="4,4,4">
                                    <div class="preview-box mb-2"
                                        style="height: 80px; border-radius: 6px; overflow: hidden;">
                                        <div class="d-flex h-100">
                                            <div class="col-4 bg-primary"></div>
                                            <div class="col-4 bg-success"></div>
                                            <div class="col-4 bg-warning"></div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="fw-bold">ثلاثة أعمدة</div>
                                        <small class="text-muted">4 / 4 / 4</small>
                                    </div>
                                </div>
                            </div>

                            <!-- 3,3,3,3 -->
                            <div class="col-md-4">
                                <div class="layout-option js-layout-preset" data-cols="3,3,3,3">
                                    <div class="preview-box mb-2"
                                        style="height: 80px; border-radius: 6px; overflow: hidden;">
                                        <div class="d-flex h-100">
                                            <div class="col-3 bg-primary"></div>
                                            <div class="col-3 bg-success"></div>
                                            <div class="col-3 bg-warning"></div>
                                            <div class="col-3 bg-danger"></div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="fw-bold">أربعة أعمدة</div>
                                        <small class="text-muted">3 / 3 / 3 / 3</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <form method="POST" action="<?php echo e(route('dashboard.layouts.store', $page)); ?>"
                                id="addLayoutForm">
                                <?php echo csrf_field(); ?>
                                <div id="layoutColsHolder">
                                    <input type="hidden" name="cols" value="12">
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-check-circle me-2"></i>
                                        إنشاء Layout
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    
    <?php if($page->exists): ?>
        <div class="modal fade" id="addSectionModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">
                            <i class="fas fa-plus-square me-2"></i>إضافة قسم جديد
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted mb-4">اختر نوع القسم</p>

                        <div class="row g-3">
                            <?php $__currentLoopData = $sectionsRegistry; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($type !== 'empty'): ?>
                                    <div class="col-md-6 col-12">
                                        <div class="border rounded p-3 h-100 d-flex flex-column">
                                            <div class="mb-2">
                                                <span class="fs-4"><?php echo e($info['icon'] ?? '🧱'); ?></span>
                                                <strong class="ms-2"><?php echo e($info['label'] ?? $type); ?></strong>
                                            </div>

                                            <?php if(isset($info['description'])): ?>
                                                <p class="text-muted small flex-grow-1">
                                                    <?php echo e($info['description']); ?>

                                                </p>
                                            <?php endif; ?>


                                            <button type="button" class="btn btn-primary w-100 mt-2 js-add-section"
                                                data-type="<?php echo e($type); ?>">
                                                <i class="fas fa-plus me-2"></i>إضافة
                                            </button>

                                            <form method="POST"
                                                action="<?php echo e(route('dashboard.pages.sections.add', $page)); ?>"
                                                id="addSectionForm" style="display:none;">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="type" id="addSectionType">
                                                <input type="hidden" name="layout_id" id="addSectionLayoutId">
                                                <input type="hidden" name="column_index" id="addSectionColIndex">
                                            </form>

                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>

    <script>
        /* ================= GLOBAL STATE ================= */
        window.activeTinyEditor = null;
        window.activeSectionId = null;
    </script>

    <script>
        /* ================= LAYOUT PRESETS ================= */
        document.addEventListener('DOMContentLoaded', function() {
            const presets = document.querySelectorAll('.js-layout-preset');
            const holder = document.getElementById('layoutColsHolder');

            if (!presets.length || !holder) return;

            presets.forEach(preset => {
                preset.addEventListener('click', function() {
                    presets.forEach(p => p.classList.remove('active'));
                    this.classList.add('active');

                    holder.innerHTML = '';
                    this.dataset.cols.split(',').forEach((col, i) => {
                        holder.insertAdjacentHTML(
                            'beforeend',
                            '<input type="hidden" name="columns[' + i +
                            '][col]" value="' + col + '">' +
                            '<input type="hidden" name="columns[' + i +
                            '][order]" value="' + i + '">'
                        );
                    });
                });
            });

            presets[0].click();
        });
    </script>

    <script>
        /* ================= SECTION MANAGEMENT ================= */
        document.addEventListener('click', function(e) {

            const openAdd = e.target.closest('.js-open-add-section');
            if (openAdd) {
                document.getElementById('addSectionLayoutId').value = openAdd.dataset.layout;
                document.getElementById('addSectionColIndex').value = openAdd.dataset.col;
                new bootstrap.Modal(document.getElementById('addSectionModal')).show();
            }

            const addSection = e.target.closest('.js-add-section');
            if (addSection) {
                document.getElementById('addSectionType').value = addSection.dataset.type;
                document.getElementById('addSectionForm').submit();
            }

            const del = e.target.closest('.js-mark-delete');
            if (del) {
                if (!confirm('هل تريد حذف هذا القسم؟')) return;
                const chip = del.closest('.js-section-chip');
                chip.querySelector('.js-delete-flag').value = 1;
                chip.classList.add('deleted');
                del.disabled = true;
                del.innerHTML = '<i class="fas fa-check"></i>';
            }

            const addRepeater = e.target.closest('.js-add-repeater-item');
            if (addRepeater) {
                const sectionId = addRepeater.dataset.section;
                const container = document.querySelector('.repeater-items[data-section="' + sectionId + '"]');
                const index = container.children.length;

                container.insertAdjacentHTML(
                    'beforeend',
                    '<div class="repeater-item border rounded p-3 mb-3">' +
                    '<input type="hidden" name="sections[' + sectionId + '][data][items][' + index +
                    '][order]" value="' + index + '">' +
                    '<div class="row g-3">' +

                    '<div class="col-md-6"><label>العنوان (AR)</label>' +
                    '<input class="form-control" name="sections[' + sectionId + '][data][items][' + index +
                    '][title_ar]"></div>' +

                    '<div class="col-md-6"><label>Title (EN)</label>' +
                    '<input class="form-control" name="sections[' + sectionId + '][data][items][' + index +
                    '][title_en]"></div>' +

                    '<div class="col-md-6"><label>الوصف (AR)</label>' +
                    '<textarea class="form-control" name="sections[' + sectionId + '][data][items][' + index +
                    '][desc_ar]"></textarea></div>' +

                    '<div class="col-md-6"><label>Description (EN)</label>' +
                    '<textarea class="form-control" name="sections[' + sectionId + '][data][items][' + index +
                    '][desc_en]"></textarea></div>' +

                    '<div class="col-md-3 d-flex align-items-end">' +
                    '<button type="button" class="btn btn-outline-danger w-100 js-remove-repeater-item">' +
                    '<i class="fas fa-trash"></i> حذف</button></div>' +

                    '</div>' +
                    '</div>'
                );
            }

            if (e.target.closest('.js-remove-repeater-item')) {
                e.target.closest('.repeater-item').remove();
            }
        });
    </script>

    <script>
        /* ================= ICON PICKER ================= */
        let activeIconInput = null;

        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.js-open-icon-picker');
            if (!btn) return;

            activeIconInput = btn.closest('.repeater-item').querySelector('.icon-input');
            window.open('<?php echo e(route('icons.index')); ?>', 'IconPicker', 'width=1000,height=650');
        });

        window.addEventListener('message', function(event) {
            if (event.data?.type !== 'icon-selected' || !activeIconInput) return;

            activeIconInput.value = event.data.icon;
        });
    </script>

    <script>
        /* ================= SETTINGS PANEL ================= */
        document.addEventListener('DOMContentLoaded', function() {

            const panel = document.getElementById('settingsPanel');
            if (!panel) return;

            const toggle = document.getElementById('toggleSettings');

            toggle.addEventListener('click', () => {
                panel.classList.toggle('collapsed');
                localStorage.setItem('settingsPanelCollapsed', panel.classList.contains('collapsed'));
            });

            if (localStorage.getItem('settingsPanelCollapsed') === 'true') {
                panel.classList.add('collapsed');
            }
        });
    </script>
    <script>
        document.querySelectorAll('.js-layout-preset').forEach(item => {
            item.addEventListener('click', function() {
                // Remove active class from all
                document.querySelectorAll('.js-layout-preset').forEach(el => {
                    el.classList.remove('active');
                });

                // Add active class to clicked
                this.classList.add('active');

                // Update hidden input
                const cols = this.getAttribute('data-cols');
                document.querySelector('input[name="cols"]').value = cols;
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/pages/form.blade.php ENDPATH**/ ?>