<?php
namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // حفظ الرسالة (AJAX)
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email',
            'company'      => 'nullable|string|max:255',
            'inquiry_type' => 'nullable|string|max:100',
            'message'      => 'required|string|min:10',
        ]);
    
        ContactMessage::create($data);
    
        return response()->json([
            'status' => true,
            'message' => __('تم إرسال رسالتك بنجاح'),
        ]);
    }
    

    // لوحة التحكم
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(15);
        return view('dashboard.contact.index', compact('messages'));
    }

    // عرض رسالة
    public function show(ContactMessage $contactMessage)
    {
        $contactMessage->update(['is_read' => true]);
        return view('dashboard.contact.show', compact('contactMessage'));
    }
    public function destroy(ContactMessage $contactMessage)
{
    $contactMessage->delete();

    return redirect()
        ->route('dashboard.contacts.index')
        ->with('success', 'تم حذف الرسالة بنجاح');
}

}
