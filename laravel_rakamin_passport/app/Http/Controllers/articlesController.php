<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class articlesController extends Controller
{
    public function createArticle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // $image = $request->file('image');
        // $image->storeAs('public/posts', $image->hashName());

        $article = new Articles;
        // 'image' => $image->hashName(),
        $article->title = $request->title;
        $article->content = $request->content;
        $article->image = $request->image;
        $article->user_id = Auth::user()->id;
        $article->category_id = $request->category_id;

        if ($article->save()) {
            return response([
                'status' => true,
                'message' => 'Data artikel berhasil disimpan'
            ]);
        } else {
            return response([
                'status' => false,
                'message' => 'Terjadi kesalahan saat simpan data'
            ]);
        }
    }

    public function updateArticle(Request $request)
    {
        $article = Articles::find($request->id);

        $article->title = $request->title;
        $article->content = $request->content;
        $article->image = $request->image;
        $article->user_id = Auth::user()->id;
        $article->category_id = $request->category_id;

        if ($article->save()) {
            return response([
                'status' => true,
                'message' => 'Data artikel berhasil diubah'
            ]);
        } else {
            return response([
                'status' => false,
                'message' => 'Terjadi kesalahan saat ubah data'
            ]);
        }
    }

    public function deleteArticle(Request $request)
    {
        $article = Articles::find($request->id);

        if ($article->delete()) {
            return response([
                'status' => true,
                'message' => 'Data artikel berhasil dihapus'
            ]);
        } else {
            return response([
                'status' => false,
                'message' => 'Terjadi kesalahan saat hapus data'
            ]);
        }
    }

    public function listAll()
    {
        $article = Articles::paginate(10);
        $category = Categories::paginate(10);
        $user = User::paginate(10);
        return response([
            'article' => $article,
            'category' => $category,
            'user' => $user
        ]);
    }

    public function showDetail()
    {
        $article = Articles::join('users', 'articles.user_id', '=', 'users.id')->join('categories', 'articles.category_id', '=', 'categories.id')->orderBy('articles.id', 'asc')->paginate(5);
        return response([
            'article' => $article
        ]);
    }
}
