<?php

namespace App\Http\Controllers\API;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Tambah catatan pengeluaran baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'date' => 'required|date_format:Y-m-d',
        ]);

        // Buat catatan pengeluaran baru
        $expense = Expense::create([
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
            'date' => $request->date,
            'user_id' => auth()->user()->id, // Gunakan user_id dari pengguna yang sedang login
        ]);

        // Kirim respons berhasil dengan status HTTP 201 (Created)
        return response()->json([
            'data' => $expense,
            'message' => 'Catatan pengeluaran berhasil ditambahkan',
        ], 201);
    }

    /**
     * Lihat daftar catatan pengeluaran.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Ambil daftar catatan pengeluaran berdasarkan pengguna yang sedang login
        $expenses = Expense::where('user_id', auth()->user()->id)->get();

        // Kirim respons berhasil dengan daftar catatan pengeluaran
        return response()->json([
            'data' => $expenses,
            'message' => 'Daftar catatan pengeluaran berhasil diambil',
        ]);
    }

    /**
     * Perbarui catatan pengeluaran yang ada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Temukan catatan pengeluaran berdasarkan ID
        $expense = Expense::findOrFail($id);

        // Validasi data yang diterima dari request
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'date' => 'required|date_format:Y-m-d',
        ]);

        // Perbarui atribut catatan pengeluaran
        $expense->update([
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
            'date' => $request->date,
        ]);

        // Kirim respons berhasil dengan catatan pengeluaran yang diperbarui
        return response()->json([
            'data' => $expense,
            'message' => 'Catatan pengeluaran berhasil diperbarui',
        ]);
    }

    /**
     * Hapus catatan pengeluaran yang ada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Temukan dan hapus catatan pengeluaran berdasarkan ID
        Expense::findOrFail($id)->delete();

        // Kirim respons berhasil
        return response()->json([
            'data' => true,
            'message' => 'Catatan pengeluaran berhasil dihapus',
        ]);
    }

    /**
     * Cari catatan pengeluaran berdasarkan tanggal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchByDateRange(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
        ]);

        // Ambil daftar catatan pengeluaran dalam rentang tanggal
        $expenses = Expense::where('date', '>=', $request->start_date)
            ->where('date', '<=', $request->end_date)
            ->where('user_id', auth()->user()->id)
            ->get();

        // Kirim respons berhasil dengan daftar catatan pengeluaran yang sesuai
        return response()->json([
            'data' => $expenses,
            'message' => 'Daftar catatan pengeluaran berhasil diambil dalam rentang tanggal',
        ]);
    }
}
