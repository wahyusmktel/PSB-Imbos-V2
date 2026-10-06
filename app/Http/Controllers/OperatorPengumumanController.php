<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;

class OperatorPengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::latest()->get();
        return view('operator.pengumuman.index', compact('pengumumans'));
    }

    public function store(Request $request)
    {
        // Placeholder for store pengumuman
        return redirect()->back();
    }

    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('operator.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, $id)
    {
        // Placeholder for update pengumuman
        return redirect()->back();
    }

    public function delete($id)
    {
        // Placeholder for delete pengumuman
        return redirect()->back();
    }

    public function uploadImage(Request $request)
    {
        // Placeholder for upload image
        return response()->json(['success' => true]);
    }
}
