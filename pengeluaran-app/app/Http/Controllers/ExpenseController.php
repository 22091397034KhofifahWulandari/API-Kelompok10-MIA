<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        // Get the id of the currently logged-in user from session
        $userId = $request->session()->get('user')->id;
        
        // Retrieve expense records from the database for the logged-in user
        $expenses = Expense::where('user_id', $userId);
        
        // Filter data based on provided start and end dates
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $expenses->whereBetween('date', [$start_date, $end_date]);
        }
        
        // Retrieve the filtered expense records
        $expenses = $expenses->get();
        
        // Calculate the total expenses
        $totalExpenses = $expenses->sum('amount');
        
        // Send data to the view
        return view('Expenses.index', compact('expenses', 'totalExpenses'));
    }    
    
    public function createForm()
    {
        return view('Expenses.create');
    }

    public function create(Request $request)
    {
        // Validate input data
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ]);
    
        // Get the user's ID from the session
        $user_id = $request->session()->get('user')->id;
    
        // Save the new expense into the database with the 'user_id' filled in
        Expense::create(array_merge($request->all(), ['user_id' => $user_id]));
    
        return redirect()->route('Expenses.index')->with('success', 'New expense added successfully.');
    }

    public function updateForm(Expense $expense)
    {
        return view('Expenses.update', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        // Validate input data
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'date' => 'required'
        ]);

        // Update the existing expense in the database
        $expense->update($request->all());

        return redirect()->route('Expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function get(Expense $expense)
    {
        return view('Expenses.get', ['expense' => $expense]);
    }

    public function search(Request $request)
    {
        // Retrieve the search keyword and dates from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Initialize the search query
        $query = Expense::query();
    
        // Filter based on date range if both dates are not null
        if (!empty($startDate) && !empty($endDate)) {
            $query->whereBetween('date', [$startDate, $endDate]);
        } elseif (!empty($startDate)) {
            // If only the start date is provided, use the '>=' operator
            $query->where('date', '>=', $startDate);
        }
    
        // Retrieve the search results
        $expenses = $query->get();
    
        // Send the search results data to the view
        return view('Expenses.search', compact('expenses'));
    }
    
    public function delete(Request $request, Expense $expense)
    {
        // Pastikan bahwa pengguna yang menghapus pengeluaran adalah pemiliknya
        if ($request->session()->get('user')->id == $expense->user_id) {
            // Hapus pengeluaran dari database
            $expense->delete();
            
            return redirect()->route('Expenses.index')->with('success', 'Expense deleted successfully.');
        } else {
            // Jika pengguna yang menghapus bukan pemiliknya, beri pesan error
            return redirect()->route('Expenses.index')->with('error', 'You are not authorized to delete this expense.');
        }
    }
}
