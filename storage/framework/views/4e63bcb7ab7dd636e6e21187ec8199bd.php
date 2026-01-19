

<?php $__env->startSection('title', 'مكتبة الوسائط'); ?>

<?php $__env->startSection('style'); ?>
<style>
    .media-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .media-item {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        transition: all 0.3s ease;
        position: relative;
    }

    .media-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .media-thumb {
        position: relative;
        background: #f8fafc;
        height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .media-thumb img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .media-thumb-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .media-item:hover .media-thumb-overlay {
        opacity: 1;
    }

    .media-actions {
        padding: 12px;
        display: flex;
        gap: 8px;
        justify-content: center;
        border-top: 1px solid #f1f1f1;
        background: #fafafa;
    }

    .media-actions button {
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.85rem;
        padding: 5px 12px;
    }

    .media-info {
        padding: 10px 12px;
    }

    .media-filename {
        font-size: 13px;
        color: #374151;
        font-weight: 500;
        margin-bottom: 4px;
        word-break: break-word;
        line-height: 1.3;
    }

    .media-meta {
        font-size: 11px;
        color: #9ca3af;
        display: flex;
        justify-content: space-between;
    }

    .upload-area {
        border: 3px dashed #cbd5e1;
        border-radius: 16px;
        padding: 60px 20px;
        text-align: center;
        background: #f8fafc;
        transition: all 0.3s ease;
        cursor: pointer;
        margin-bottom: 30px;
    }

    .upload-area:hover {
        border-color: #3b82f6;
        background: #eff6ff;
        transform: translateY(-2px);
    }

    .upload-area.dragover {
        border-color: #3b82f6;
        background: #dbeafe;
        transform: scale(1.02);
    }

    .upload-icon {
        font-size: 60px;
        color: #94a3b8;
        margin-bottom: 20px;
    }

    .upload-text h5 {
        color: #4b5563;
        margin-bottom: 8px;
        font-size: 1.2rem;
    }

    .upload-text p {
        color: #6b7280;
        font-size: 0.95rem;
        margin-bottom: 5px;
    }

    .file-item {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 12px 15px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .file-item .file-name {
        flex: 1;
        margin-right: 15px;
        font-size: 14px;
        color: #374151;
    }

    .file-item .file-size {
        color: #6b7280;
        font-size: 13px;
        margin-right: 15px;
    }

    .progress-wrapper {
        display: none;
    }

    .progress {
        height: 8px;
        border-radius: 4px;
    }

    .btn-action {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        background: white;
        color: #6b7280;
        transition: all 0.2s;
    }

    .btn-action:hover {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-action.delete:hover {
        background: #fee2e2;
        color: #dc2626;
        border-color: #fecaca;
    }

    .media-checkbox {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 10;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state-icon {
        font-size: 70px;
        color: #d1d5db;
        margin-bottom: 20px;
    }

    .empty-state h5 {
        color: #6b7280;
        margin-bottom: 10px;
    }

    .modal-lg {
        max-width: 900px;
    }

    .preview-container {
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
        border-radius: 12px;
        overflow: hidden;
    }

    .preview-container img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .form-label {
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
    }

    .form-control,
    .form-control:focus {
        border-color: #d1d5db;
        border-radius: 8px;
        padding: 10px 12px;
    }

    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .tab-content {
        padding-top: 20px;
    }

    #uploadedFilesList .file-item {
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .media-selected {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }

    .alert-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
    }

    .alert {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border: none;
        border-radius: 10px;
        padding: 15px 20px;
        margin-bottom: 10px;
        animation: slideInRight 0.3s ease;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <!-- Alert Container -->
    <div class="alert-container" id="alertContainer"></div>

    <div class="card shadow-sm">
        <div class="card-header fw-bold bg-white d-flex justify-content-between align-items-center py-3">
            <div>
                <h5 class="mb-0">📁 مكتبة الوسائط</h5>
                <small class="text-muted">
                    <?php echo e(request('select_mode') ? ('وضع ' . (request('select_mode') === 'editor' ? 'المحرر' : 'الأقسام')) : 'إدارة الوسائط'); ?>

                </small>
            </div>
            <div class="d-flex gap-2">
                <?php if(request('select_mode')): ?>
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="window.close()">
                    <i class="fas fa-times me-1"></i> إغلاق
                </button>
                <?php endif; ?>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal">
                    <i class="fas fa-upload me-2"></i> رفع وسائط جديدة
                </button>
            </div>
        </div>

        <div class="card-body">
            <!-- Upload Area -->
            <div class="upload-area mb-4" id="dropArea">
                <div class="upload-icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <div class="upload-text">
                    <h5>اسحب وأفلت الملفات هنا</h5>
                    <p>أو انقر لاختيار الملفات</p>
                    <p class="text-muted small">الدعم: JPG, PNG, GIF, WebP | الحد الأقصى: 5MB لكل صورة</p>
                </div>
                <input type="file" id="fileInput" multiple accept="image/*" class="d-none">
            </div>

            <!-- Files to Upload List -->
            <div class="progress-wrapper mb-4" id="uploadProgress">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0">الملفات المحددة للرفع</h6>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="clearFileList()">
                        <i class="fas fa-times me-1"></i> إلغاء الكل
                    </button>
                </div>
                <div class="mb-3">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                            role="progressbar" style="width: 0%"></div>
                    </div>
                    <small class="text-muted d-block mt-1 text-center" id="progressText">0%</small>
                </div>
                <div id="filesList"></div>
                <div class="text-end mt-3">
                    <button type="button" class="btn btn-success" onclick="startUpload()" id="uploadBtn">
                        <i class="fas fa-upload me-2"></i> رفع الملفات
                    </button>
                </div>
            </div>

            <!-- Media Grid -->
            <div id="mediaContainer">
                <?php echo $__env->make('dashboard.media._media_grid', ['media' => $media], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">رفع وسائط جديدة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="upload-area" onclick="document.getElementById('modalFileInput').click()">
                    <div class="upload-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <div class="upload-text">
                        <h5>انقر لاختيار الملفات</h5>
                        <p>أو اسحب وأفلت الملفات هنا</p>
                    </div>
                    <input type="file" id="modalFileInput" multiple accept="image/*" class="d-none">
                </div>
                <div class="mt-3" id="modalFilesList"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-primary" onclick="uploadFromModal()">رفع الملفات</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تعديل وسائط</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editMediaForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="preview-container mb-3">
                                <img id="editPreview" src="" alt="" class="img-fluid">
                            </div>
                            <div class="media-info-card card">
                                <div class="card-body">
                                    <h6 class="card-title">معلومات الملف</h6>
                                    <table class="table table-sm table-borderless mb-0">
                                        <tr>
                                            <td class="text-muted" width="40%">اسم الملف:</td>
                                            <td id="editFileName"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">الحجم:</td>
                                            <td id="editFileSize"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">النوع:</td>
                                            <td id="editFileType"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">تاريخ الرفع:</td>
                                            <td id="editFileDate"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" id="editMediaId">

                            <div class="mb-3">
                                <label for="editTitle" class="form-label">العنوان</label>
                                <input type="text" class="form-control" id="editTitle" name="title" placeholder="عنوان الصورة">
                                <div class="form-text">سيظهر عند التمرير على الصورة</div>
                            </div>

                            <div class="mb-3">
                                <label for="editAlt" class="form-label">النص البديل (Alt)</label>
                                <input type="text" class="form-control" id="editAlt" name="alt" placeholder="وصف النص البديل">
                                <div class="form-text">هام لمحركات البحث وإمكانية الوصول</div>
                            </div>

                            <div class="mb-3">
                                <label for="editCaption" class="form-label">التعليق</label>
                                <input type="text" class="form-control" id="editCaption" name="caption" placeholder="تعليق أسفل الصورة">
                                <div class="form-text">سيظهر أسفل الصورة</div>
                            </div>

                            <div class="mb-3">
                                <label for="editDescription" class="form-label">الوصف</label>
                                <textarea class="form-control" id="editDescription" name="description" rows="4" placeholder="وصف تفصيلي للصورة"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm d-none" id="saveSpinner"></span>
                        حفظ التغييرات
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    // Global variables
    let mediaFiles = [];
    let currentUploadProgress = 0;

    // CSRF Token for AJAX
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        initUpload();
        initEditModal();
    });

    // Show alert function
    function showAlert(message, type = 'success') {
        const alertContainer = document.getElementById('alertContainer');
        const alertId = 'alert-' + Date.now();

        const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" id="${alertId}" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                <div>${message}</div>
            </div>
            <button type="button" class="btn-close" onclick="closeAlert('${alertId}')"></button>
        </div>
    `;

        alertContainer.insertAdjacentHTML('afterbegin', alertHtml);

        // Auto remove after 5 seconds
        setTimeout(() => closeAlert(alertId), 5000);
    }

    function closeAlert(alertId) {
        const alert = document.getElementById(alertId);
        if (alert) {
            alert.style.opacity = '0';
            alert.style.transform = 'translateX(100%)';
            setTimeout(() => alert.remove(), 300);
        }
    }

    // Upload functionality
    function initUpload() {
        const dropArea = document.getElementById('dropArea');
        const fileInput = document.getElementById('fileInput');
        const modalFileInput = document.getElementById('modalFileInput');

        // Click to select files
        dropArea.addEventListener('click', () => fileInput.click());

        // File selection
        fileInput.addEventListener('change', (e) => handleFiles(e.target.files));
        modalFileInput.addEventListener('change', (e) => handleModalFiles(e.target.files));

        // Drag and drop events
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            dropArea.classList.add('dragover');
        }

        function unhighlight() {
            dropArea.classList.remove('dragover');
        }

        dropArea.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles(files);
        });
    }

    function handleFiles(files) {
        const validFiles = Array.from(files).filter(file => {
            if (!file.type.startsWith('image/')) {
                showAlert(`الملف "${file.name}" ليس صورة`, 'danger');
                return false;
            }
            if (file.size > 5 * 1024 * 1024) {
                showAlert(`الملف "${file.name}" يتجاوز الحد الأقصى (5MB)`, 'danger');
                return false;
            }
            return true;
        });

        mediaFiles = [...mediaFiles, ...validFiles];
        updateFilesList();
        document.getElementById('uploadProgress').style.display = 'block';
    }

    function handleModalFiles(files) {
        const validFiles = Array.from(files).filter(file => {
            if (!file.type.startsWith('image/')) {
                showAlert(`الملف "${file.name}" ليس صورة`, 'danger');
                return false;
            }
            if (file.size > 5 * 1024 * 1024) {
                showAlert(`الملف "${file.name}" يتجاوز الحد الأقصى (5MB)`, 'danger');
                return false;
            }
            return true;
        });

        const modalFilesList = document.getElementById('modalFilesList');
        validFiles.forEach(file => {
            const fileItem = createFileItem(file);
            modalFilesList.appendChild(fileItem);
        });
    }

    function createFileItem(file) {
        const div = document.createElement('div');
        div.className = 'file-item';
        div.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="fas fa-image text-primary me-3"></i>
            <div>
                <div class="file-name">${file.name}</div>
                <div class="file-size">${formatBytes(file.size)}</div>
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeModalFile(this)">
            <i class="fas fa-times"></i>
        </button>
    `;
        return div;
    }

    function removeModalFile(button) {
        button.closest('.file-item').remove();
    }

    function updateFilesList() {
        const filesList = document.getElementById('filesList');
        filesList.innerHTML = '';

        mediaFiles.forEach((file, index) => {
            const div = document.createElement('div');
            div.className = 'file-item';
            div.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-image text-primary me-3"></i>
                <div>
                    <div class="file-name">${file.name}</div>
                    <div class="file-size">${formatBytes(file.size)}</div>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile(${index})">
                <i class="fas fa-times"></i>
            </button>
        `;
            filesList.appendChild(div);
        });

        document.getElementById('uploadBtn').disabled = mediaFiles.length === 0;
    }

    function removeFile(index) {
        mediaFiles.splice(index, 1);
        updateFilesList();
        if (mediaFiles.length === 0) {
            document.getElementById('uploadProgress').style.display = 'none';
        }
    }

    function clearFileList() {
        mediaFiles = [];
        updateFilesList();
        document.getElementById('uploadProgress').style.display = 'none';
    }

    function startUpload() {
        if (mediaFiles.length === 0) return;

        const uploadBtn = document.getElementById('uploadBtn');
        const progressBar = document.querySelector('.progress-bar');
        const progressText = document.getElementById('progressText');

        uploadBtn.disabled = true;
        uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> جاري الرفع...';

        const formData = new FormData();
        mediaFiles.forEach(file => {
            formData.append('files[]', file);
        });

        // Create XMLHttpRequest for progress tracking
        const xhr = new XMLHttpRequest();

        xhr.upload.addEventListener('progress', (e) => {
            if (e.lengthComputable) {
                const percentComplete = Math.round((e.loaded / e.total) * 100);
                progressBar.style.width = percentComplete + '%';
                progressText.textContent = percentComplete + '%';
                currentUploadProgress = percentComplete;
            }
        });

        xhr.addEventListener('load', function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    showAlert('تم رفع الملفات بنجاح');
                    clearFileList();
                    loadMediaGrid(); // Refresh media grid

                    // Close modal if open
                    const uploadModal = bootstrap.Modal.getInstance(document.getElementById('uploadModal'));
                    if (uploadModal) uploadModal.hide();
                } else {
                    showAlert('حدث خطأ أثناء رفع الملفات', 'danger');
                }
            } else {
                showAlert('حدث خطأ في الاتصال', 'danger');
            }

            uploadBtn.disabled = false;
            uploadBtn.innerHTML = '<i class="fas fa-upload me-2"></i> رفع الملفات';
            progressBar.style.width = '0%';
            progressText.textContent = '0%';
        });

        xhr.addEventListener('error', function() {
            showAlert('حدث خطأ في الاتصال', 'danger');
            uploadBtn.disabled = false;
            uploadBtn.innerHTML = '<i class="fas fa-upload me-2"></i> رفع الملفات';
            progressBar.style.width = '0%';
            progressText.textContent = '0%';
        });

        xhr.open('POST', '<?php echo e(route("dashboard.media.upload")); ?>');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.send(formData);
    }

    function uploadFromModal() {
        const modalFilesList = document.getElementById('modalFilesList');
        const fileItems = modalFilesList.querySelectorAll('.file-item');

        if (fileItems.length === 0) {
            showAlert('لم تقم باختيار أي ملفات', 'warning');
            return;
        }

        // You can implement modal upload logic here
        // For now, we'll use the main upload function
        const modalFileInput = document.getElementById('modalFileInput');
        if (modalFileInput.files.length > 0) {
            handleFiles(modalFileInput.files);
            const uploadModal = bootstrap.Modal.getInstance(document.getElementById('uploadModal'));
            if (uploadModal) uploadModal.hide();
            startUpload();
        }
    }

    // Edit modal functionality
 
 // Edit modal functionality
function initEditModal() {
    const editModal = document.getElementById('editModal');
    
    // Event delegation for edit buttons
    document.addEventListener('click', function(e) {
        // Edit button
        if (e.target.closest('.js-media-edit')) {
            const btn = e.target.closest('.js-media-edit');
            showEditModal(btn);
        }
    });

    editModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        if (button) {
            populateEditForm(button);
        }
    });

    // Handle form submission
    document.getElementById('editMediaForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        await saveMediaChanges();
    });
}

function showEditModal(button) {
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
    
    // Set data attributes manually
    const mediaItem = button.closest('.media-item');
    if (!mediaItem) return;
    
    const img = mediaItem.querySelector('img');
    const info = mediaItem.querySelector('.media-info');
    
    // Populate form data
    document.getElementById('editMediaId').value = button.dataset.id;
    document.getElementById('editPreview').src = button.dataset.url || img.src;
    document.getElementById('editFileName').textContent = button.dataset.filename || 'غير معروف';
    document.getElementById('editFileSize').textContent = button.dataset.size || '0 KB';
    document.getElementById('editFileType').textContent = button.dataset.type || 'صورة';
    document.getElementById('editFileDate').textContent = button.dataset.date || 'غير معروف';
    document.getElementById('editTitle').value = button.dataset.title || '';
    document.getElementById('editAlt').value = button.dataset.alt || '';
    document.getElementById('editCaption').value = button.dataset.caption || '';
    document.getElementById('editDescription').value = button.dataset.description || '';
    
    editModal.show();
}

function populateEditForm(button) {
    document.getElementById('editMediaId').value = button.dataset.id;
    document.getElementById('editPreview').src = button.dataset.url;
    document.getElementById('editFileName').textContent = button.dataset.filename;
    document.getElementById('editFileSize').textContent = button.dataset.size;
    document.getElementById('editFileType').textContent = button.dataset.type || 'صورة';
    document.getElementById('editFileDate').textContent = button.dataset.date;
    document.getElementById('editTitle').value = button.dataset.title || '';
    document.getElementById('editAlt').value = button.dataset.alt || '';
    document.getElementById('editCaption').value = button.dataset.caption || '';
    document.getElementById('editDescription').value = button.dataset.description || '';
}

async function saveMediaChanges() {
    const mediaId = document.getElementById('editMediaId').value;
    const saveBtn = document.querySelector('#editMediaForm button[type="submit"]');
    const spinner = document.getElementById('saveSpinner');

    if (!mediaId) {
        showAlert('خطأ: معرف الوسائط غير موجود', 'danger');
        return;
    }

    saveBtn.disabled = true;
    spinner.classList.remove('d-none');

    const formData = {
        title: document.getElementById('editTitle').value,
        alt: document.getElementById('editAlt').value,
        caption: document.getElementById('editCaption').value,
        description: document.getElementById('editDescription').value
    };

    try {
        const response = await fetch(`/dashboard/media/${mediaId}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(formData)
        });

        const result = await response.json();

        if (result.success) {
            showAlert('تم حفظ التغييرات بنجاح');
            
            // Close modal
   
            // Refresh media grid with a slight delay
            setTimeout(() => {
                loadMediaGrid();
            }, 500);
            
        } else {
            showAlert(result.message || 'حدث خطأ أثناء حفظ التغييرات', 'danger');
        }
    } catch (error) {
        console.error('Update error:', error);
        showAlert('حدث خطأ في الاتصال', 'danger');
    } finally {
        saveBtn.disabled = false;
        spinner.classList.add('d-none');
    }
}

// Load media grid via AJAX
// Load media grid via AJAX
function loadMediaGrid() {
    const mediaContainer = document.getElementById('mediaContainer');
    
    // الحصول على جميع معلمات الرابط الحالي
    const currentUrl = new URL(window.location.href);
    const searchParams = new URLSearchParams(currentUrl.search);
    
    // إضافة timestamp لمنع التخزين المؤقت
    searchParams.set('_', Date.now());
    
    fetch(`/dashboard/media/grid?${searchParams.toString()}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.text();
    })
    .then(html => {
        mediaContainer.innerHTML = html;
        // إعادة تهيئة الأدوات بعد تحميل المحتوى الجديد
        initMediaEventListeners();
        showAlert('تم تحديث مكتبة الوسائط', 'success');
    })
    .catch(error => {
        console.error('Error loading media grid:', error);
        showAlert('حدث خطأ أثناء تحديث البيانات: ' + error.message, 'danger');
    });
}

// إعادة تهيئة الأدوات بعد تحديث الشبكة
function initMediaEventListeners() {
    // Delete buttons
    document.querySelectorAll('.js-media-delete').forEach(btn => {
        btn.onclick = function() {
            const mediaId = this.dataset.id;
            deleteMedia(mediaId);
        };
    });
    
    // Preview click
    document.querySelectorAll('.js-media-preview').forEach(preview => {
        preview.onclick = function(e) {
            e.preventDefault();
            const editBtn = this.closest('.media-item').querySelector('.js-media-edit');
            if (editBtn) {
                showEditModal(editBtn);
            }
        };
    });
}

// تحديث دالة deleteMedia لتعمل بشكل صحيح
async function deleteMedia(mediaId) {
    if (!confirm('هل أنت متأكد من حذف هذه الوسائط؟ لا يمكن التراجع عن هذا الإجراء.')) {
        return;
    }

    try {
        const response = await fetch(`/dashboard/media/${mediaId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const result = await response.json();

        if (result.success) {
            showAlert('تم حذف الوسائط بنجاح');
            // حذف العنصر مباشرة دون إعادة تحميل كامل
            document.querySelector(`[data-media-id="${mediaId}"]`)?.remove();
            
            // إذا لم يتبقى أي عناصر، إظهار الحالة الفارغة
            if (!document.querySelector('.media-item')) {
                document.getElementById('mediaContainer').innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="far fa-images"></i>
                        </div>
                        <h5>لا توجد وسائط بعد</h5>
                        <p class="text-muted">ابدأ برفع الوسائط الأولى بالنقر على زر "رفع وسائط جديدة"</p>
                    </div>
                `;
            }
        } else {
            showAlert(result.message || 'حدث خطأ أثناء الحذف', 'danger');
        }
    } catch (error) {
        console.error('Delete error:', error);
        showAlert('حدث خطأ في الاتصال', 'danger');
    }
}

    // Load media grid via AJAX
 

    // Format bytes to readable size
    function formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    /*
    |--------------------------------------------------------------------------
    | MEDIA PICKER – SINGLE SOURCE OF TRUTH
    |--------------------------------------------------------------------------
    | يدعم:
    | - Editor  → insert-image-editor
    | - Section → media-selected
    */

    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.js-select-media');
        if (!btn) return;

        const media = {
            id: btn.dataset.id,
            url: btn.dataset.url,
            alt: btn.dataset.alt || ''
        };

        const params = new URLSearchParams(window.location.search);
        const mode = params.get('select_mode');

        // EDITOR MODE
        if (mode === 'editor') {
            window.opener.postMessage({
                type: 'insert-image-editor',
                media: media
            }, '*');
            window.close();
            return;
        }

        // SECTION MODE
        if (mode === 'section') {
            window.opener.postMessage({
                type: 'media-selected',
                media: media
            }, '*');
            window.close();
            return;
        }
    });

    // Add click handlers for media items
    document.addEventListener('click', function(e) {
        // Edit button
        if (e.target.closest('.js-media-edit')) {
            const btn = e.target.closest('.js-media-edit');
            const editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.show();
        }

        // Delete button
        if (e.target.closest('.js-media-delete')) {
            const btn = e.target.closest('.js-media-delete');
            const mediaId = btn.dataset.id;
            deleteMedia(mediaId);
        }

        // Preview image
        if (e.target.closest('.js-media-preview')) {
            const mediaItem = e.target.closest('.js-media-preview');
            const editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.show();
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/media/index.blade.php ENDPATH**/ ?>