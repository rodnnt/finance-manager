<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

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
        return view('categories.index', compact('categories'));
    }

    public function create() {
        return view('categories.create');
    }

    public function store(Request $request) {
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->created_by = $request->created_by;
        $category->type = $request->type ?? 'Individual';
        
        $category->save();

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
            return redirect('/categories')->withErrors('Você não tem permissão para editar esta categoria.');
        } else {
            return view( '/categories.edit', [ 'category' => $category] );
        }
    }

    public function update( Request $request ) {
        Category::findOrFail( $request->id )->update( $request->all() );

        return redirect( '/categories' )->with( 'msg', 'Categoria editada com sucesso');
    }
}