<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contacts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $keywords = $request->input('keywords');
        if ($keywords) {
            $contacts = Contacts::search($keywords)->paginate(10);
            return view('Admin.contact.list', compact('contacts', 'keywords'));
        } else {
            $contacts = Contacts::latest()->paginate(10);
            return view('Admin.contact.list', compact('contacts'));
        }
    }
    public function update(Request $request)
    {
        if (Gate::allows('edit-contact')) {
            Contacts::find($request->id)->update(['status' => 1]);
            return back()->with('message', 'Cập nhật thành công');
        } else {
            return back()->with('errors', 'Bạn không có quyền');
        }
    }
}
