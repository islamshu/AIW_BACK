Route::prefix('pages')->name('dashboard.pages.')->group(function () {
    Route::get('/', [PageController::class, 'index'])->name('index');
    Route::get('/create', [PageController::class, 'create'])->name('create');
    Route::post('/', [PageController::class, 'store'])->name('store');
    Route::get('/{page}/edit', [PageController::class, 'edit'])->name('edit');
    Route::put('/{page}', [PageController::class, 'update'])->name('update');
    Route::delete('/{page}', [PageController::class, 'destroy'])->name('destroy');
    
    // Bulk actions
    Route::post('/bulk', [PageController::class, 'bulk'])->name('bulk');
    Route::post('/{id}/restore', [PageController::class, 'restore'])->name('restore');
    Route::delete('/{id}/force', [PageController::class, 'forceDelete'])->name('forceDelete');
    
    // Layout management
    Route::post('/{page}/layouts', [PageController::class, 'store_layout'])->name('layouts.store');
    Route::delete('/{page}/layouts/{layoutId}', [PageController::class, 'destroyLayout'])->name('layouts.destroy');
    
    // Section management
    Route::post('/{page}/sections', [PageController::class, 'addSection'])->name('sections.add');
    Route::put('/sections/{section}', [PageController::class, 'updateSection'])->name('sections.update');
    Route::delete('/sections/{section}', [PageController::class, 'deleteSection'])->name('sections.delete');
    
    // Section movement
    Route::post('/sections/{section}/move-up', [PageController::class, 'moveSectionUp'])->name('sections.moveUp');
    Route::post('/sections/{section}/move-down', [PageController::class, 'moveSectionDown'])->name('sections.moveDown');
    Route::put('/{page}/sections/batch', [PageController::class, 'batchUpdateSections'])->name('sections.batchUpdate');
    
    // Preview
    Route::get('/{page}/preview', [PageController::class, 'preview'])->name('preview');
    
    // Status toggle
    Route::post('/{page}/toggle-status', [PageController::class, 'toggleStatus'])->name('toggle');
    
    // Reorder
    Route::post('/reorder', [PageController::class, 'reorder'])->name('reorder');
});