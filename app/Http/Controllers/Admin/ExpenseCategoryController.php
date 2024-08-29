<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;

class ExpenseCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter                                 = [];
        $filter['id']                           = $request->id;
        $filter['category']                     = $request->category;
        $filter['enabled']                      = $request->enabled;

        $categories                             = ExpenseCategory::query();
        $categories                             = isset($filter['id']) ? $categories->where('id', $filter['id']) : $categories;
        $categories                             = isset($filter['category']) ? $categories->where('category', 'LIKE', '%' . $filter['category'] . '%') : $categories;
        $categories                             = isset($filter['enabled']) ? $categories->where('enabled', $filter['enabled']) : $categories;
        $categories                             = $categories->orderBy('id', 'desc')->paginate(20);

        return view('admin.expense-categories.list', compact('categories', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.expense-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category'       => 'required',
        ]);

        $category            = ExpenseCategory::create([
            'category'       => $request->category,
            'enabled'       => $request->enabled
        ]);

        return redirect()->route('admin.expense-categories.index')->with('success', 'Expense Category saved successfully!');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category        = ExpenseCategory::find($id);
        $category->category  = $category->category; 
        $category->enabled  = $category->enabled; 
        return view('admin.expense-categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'category'        => 'required',
        ]);

        $category            = ExpenseCategory::find($id)->update([
            'category'       => $request->category,
            'description'   => $request->description,
            'enabled'       => $request->enabled
        ]);

        if($request->hasfile('logo')){

            $logo      = $request->file('logo');

            $name       = $logo->getClientOriginalName();

            $logo->storeAs('uploads/expense-categories/'.$category->id.'/', $name, 'public');               

            ExpenseCategory::find($category->id)->update(['logo' => $name]);

        }

        return redirect()->route('admin.expense-categories.index')->with('success', 'Expense Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ExpenseCategory::find($id)->delete();
        return redirect()->route('admin.expense-categories.index')->with('success', 'Expense Category deleted successfully!');
    }

    public function bulkDelete(Request $request)
    {
        ExpenseCategory::whereIn('id', $request->categories)->delete();
        return response()->json(['success' => 'Expense Category deleted successfully!'], 200);
    }
}
