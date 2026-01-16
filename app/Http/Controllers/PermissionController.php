<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::latest()->paginate(15);
        return view('dashboard.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('dashboard.permissions.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name' => $data['name']]);

        return redirect()
            ->route('dashboard.permissions.index')
            ->with('success', 'تم إضافة الصلاحية');
    }

    public function edit(Permission $permission)
    {
        return view('dashboard.permissions.form', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $data = $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update($data);

        return redirect()
            ->route('dashboard.permissions.index')
            ->with('success', 'تم تحديث الصلاحية');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back()->with('success', 'تم حذف الصلاحية');
    }
}
