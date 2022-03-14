<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Post_Controller extends Controller
{
    //Menambahkan Fungsi Index dengan memakai method model dari laravel - > latest -> Get Data berdasarkan terakhir di store
    public function index()
    {
        $posts = Post::latest()->get();
        // Jika posts ditemukan maka kembalikan response berbentuk data json dengan parameter data, message dan http status 200 = OK
        return response()->json([
            'success' => true,
            'message' => 'List Data Post',
            'data' => $posts
        ], 200);
    }
    // Menambahkan fungsi Detail Post dengan memakai method model dari laravel -> findorfail
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data' => $post
        ], 200);
    }

    public function store(Request $request)
    {
        // Validasi Parameter Body Request Title dan Content Harus Required
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'content' => 'required',
        ]);

        // Jika Validasi Error Validasi maka kembalikan respons json message validator errornya dan HTTP status=400 / not found
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Jika Validasi Berhasil, tinggal memakai fungsi ORM/Eloquent dari model yang bernama create
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content
        ]);

        // Simpan Ke database
        // Jika Berhasil menyimpan ke Database selanjutnya kembalikan response json berupa message dan data dengan HTTP status=201 / created
        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Post Created',
                'data' => $post
            ], 201);
        }


        // Jika Insert Data Gagal kembalikan respons berupa message dan HTTP status = 400 / not found
        return response()->json([
            'success' => false,
            'message' => 'Post Failed to Save'
        ], 400);
    }

    public function update(Request $request, Post $post)
    {
        // Validasi Parameter Body Request Title dan Content Harus Required
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'content' => 'required',
        ]);

        // Jika Validasi Error Validasi maka kembalikan respons json message validator errornya dan HTTP status=400 / not found
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Mencari Data dengan find or fail berdasarkan parameter id setelah itu di update berdasarkan id
        $post = Post::findOrFail($post->id);
        if ($post) {
            $post->update([
                'title' => $request->title,
                'content' => $request->content
            ]);
            // Jika Berhasil menyimpan ke Database selanjutnya kembalikan response json berupa message dan data dengan HTTP status=200 / ok
            return response()->json([
                'success' => true,
                'message' => 'Update Data Berhasil',
                'data' => $post
            ], 200);
        }
        // Jika Update Data Gagal kembalikan respons berupa message dan HTTP status = 400 / not found  
        return response()->json([
            'success' => false,
            'message' => 'Update Data Gagal'
        ], 400);
    }

    public function destroy(Post $post)
    {
        // Find Id berdasarkan params $post id
        $post = Post::findOrFail($post->id);
        // Mencari Data dengan find or fail berdasarkan parameter id setelah itu di delete berdasarkan id
        if ($post) {
            $post->delete();
            return response()->json([
                'success' => true,
                'message' => 'Hapus Data Berhasil'
            ], 200);
        }
        //Jika gagal didelete kembalikan json respons berupa message dan HTTP status=400 / Not Found
        return response()->json([
            'sucess' => false,
            'message' => 'Hapus Data Gagal'
        ], 400);
    }
}
