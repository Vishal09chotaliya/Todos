<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index($id = null)
    {
        $data = Todo::paginate(5);
        return view('dashbord', compact('data'));
    }


    public function store(request $request)
    {
        $data = Todo::create([
            'first_name' => $request->fnm,
            'last_name' => $request->lnm
        ]);

        return response()->json($data);
    }

    public function edit(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json(['error' => 'Todo not found'], 404);
        }

        $todo->update($validated);
        return response()->json(['success' => 'Todo updated successfully']);
    }

    public function getTodo($id)
    {
        $todo = Todo::find($id);
        if ($todo) {
            return response()->json($todo);
        }
        return response()->json(['error' => 'Todo not found'], 404);
    }


    public function destroy(string $id)
    {
        $data = Todo::find($id);
        $data->delete();
        return response()->json(['message' => true, 'tr' => 'tr_' . $id]);

    }

    //search data

    public function search(request $request)
    {
        $data = Todo::where('first_name', 'like', '%' . $request->search . '%')
            ->orWhere('last_name', 'like', '%' . $request->search . '%')
            ->paginate(5);

        if ($data->count() >= 1) {
            return response()->json($data);
        } else {
            return response()->json([
                'status' => 'Nothing Found'
            ]);
        }

    }
}
