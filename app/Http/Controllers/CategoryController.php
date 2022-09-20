<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCategoryRequest;
use App\Models\Transaction;
use App\Models\TransactionCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('dashboard.category.index');
    }

    public function store(NewCategoryRequest $request): RedirectResponse
    {
        if(TransactionCategory::create($request->validated()))
            return redirect()->back()->with('success', __('message.category_success'));

        return redirect()->back()->withErrors([__('message.database_error')]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data           = $request->except('_token', '_method');
        $category       = TransactionCategory::find($data['category_id']);
        $category->name = $data['name'];
        if($category->save())
            return redirect()->back()->with('success', 'Catégorie mis à jour avec succès');

        return redirect()->back()->withErrors([__('message.database_error')]);
    }

    public function delete($category_id): RedirectResponse
    {
        if(Transaction::where('transaction_category_id', '=', $category_id)->first())
            return redirect()->back()->withErrors(['Impossible de supprimer cette catégorie car elle existe dans une de vos transaction']);

        $category = TransactionCategory::find($category_id);
        if($category->delete())
            return redirect()->back()->with('success', 'Catégorie supprimer avec succès');

        return redirect()->back()->withErrors([__('message.database_error')]);
    }
}
