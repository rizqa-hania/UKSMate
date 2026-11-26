<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    // Menampilkan semua siswa
    public function index()
    {
        $students = Student::orderBy('name')->get();

        return response()->json([
            'message' => 'Data siswa berhasil diambil.',
            'data' => $students,
        ]);
    }

    // Menambahkan siswa
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => ['required', 'string', 'max:255', 'unique:students,nis'],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', Rule::in(['L', 'P'])],
            'class' => ['required', 'string', 'max:255'],
            'major' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $student = Student::create($validated);

        return response()->json([
            'message' => 'Siswa berhasil ditambahkan.',
            'data' => $student,
        ], 201);
    }

    // Menampilkan detail siswa
    public function show(string $id)
    {
        $student = Student::findOrFail($id);

        return response()->json([
            'message' => 'Detail siswa berhasil diambil.',
            'data' => $student,
        ]);
    }

    // Mengedit data siswa
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'nis' => [
                'required',
                'string',
                'max:255',
                Rule::unique('students', 'nis')->ignore($student->student_id, 'student_id'),
            ],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', Rule::in(['L', 'P'])],
            'class' => ['required', 'string', 'max:255'],
            'major' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
        ]);

        $student->update($validated);

        return response()->json([
            'message' => 'Data siswa berhasil diperbarui.',
            'data' => $student,
        ]);
    }

    // Menghapus siswa
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return response()->json([
            'message' => 'Siswa berhasil dihapus.',
        ]);
    }
}
