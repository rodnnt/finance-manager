<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\UserBudget;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::where(function($query) {
            $query->where('type', 'Padrão');
            if (Auth::check()) {
                $query->orWhere('created_by', Auth::id());
            }
        })
        ->get();

        $categoriesWithBudget = $categories->map(function($category) {
            $category->budget = UserBudget::where('user_id', Auth::id())
                                          ->where('category_id', $category->id)
                                          ->first()->budget ?? null;
            return $category;
        });

        return view('categories.index', compact('categories', 'categoriesWithBudget'));
    }

    public function create() {
        return view('categories.create');
    }

    public function store(Request $request) {
        $budget = $request->has('budget') && !empty($request->budget) ? $request->budget : 0.01;
        $category = Category::firstOrCreate([
            'name' => $request->name
        ], [
            'description' => $request->description,
            'created_by' => $request->created_by,
            'type' => $request->type ?? 'Individual',
            'budget' => $budget
        ]);

        if ($request->has('budget')) {
            UserBudget::createOrUpdateBudget(Auth::id(), $category->id, $request->budget);
        }

        return redirect( '/categories' )->with( 'msg', 'Categoria criada com sucesso!' );
    }

    public function destroy( $id ) {
        $category = Category::findOrFail( $id );
        if (Auth::user()->type !== 'Admin' && Auth::id() !== $category->created_by) {
            return redirect('/categories')->withErrors('Você não tem permissão para excluir esta categoria.');
        } else {       
            $category->delete();
        
            return redirect( '/categories' )->with( 'msg', 'Categoria excluida com sucesso');
        }
    }

    public function edit( $id ) {
        $category = Category::findOrFail( $id );
        
        if (Auth::user()->type !== 'Admin' && Auth::id() !== $category->created_by) {
            $isUserAllowedToEdit = true;
        } else {
            $isUserAllowedToEdit = false;
        }

        $budget = UserBudget::where('user_id', Auth::id())
                            ->where('category_id', $category->id)
                            ->first();

        return view( '/categories.edit', [ 'category' => $category, 'budget' => $budget ? $budget->budget : null, 'isUserAllowedToEdit' => $isUserAllowedToEdit] );
    }

    public function update( Request $request ) {
        $category = Category::findOrFail($request->id);
        $category->update($request->except('budget'));

        if ($request->has('budget')) {
            UserBudget::createOrUpdateBudget(Auth::id(), $category->id, $request->budget);
        }

        return redirect( '/categories' )->with( 'msg', 'Categoria editada com sucesso');
    }
}