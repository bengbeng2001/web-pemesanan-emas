<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gold;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GoldController extends Controller
{
    public function index()
    {
        $golds = Gold::orderBy('name')->paginate(15);

        return view('admin.golds.index', compact('golds'));
    }

    public function create()
    {
        return view('admin.golds.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('golds', 'public');
        } else {
            unset($data['image']);
        }

        Gold::create($data);

        return redirect()->route('admin.golds.index')->with('success', 'Emas berhasil ditambahkan.');
    }

    public function edit(Gold $gold)
    {
        return view('admin.golds.edit', compact('gold'));
    }

    public function update(Request $request, Gold $gold)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            if ($gold->image) {
                Storage::disk('public')->delete($gold->image);
            }
            $data['image'] = $request->file('image')->store('golds', 'public');
        } else {
            unset($data['image']);
        }

        $gold->update($data);

        return redirect()->route('admin.golds.index')->with('success', 'Data emas diperbarui.');
    }

    public function destroy(Gold $gold)
    {
        $gold->delete();

        return redirect()->route('admin.golds.index')->with('success', 'Emas dihapus.');
    }
}
