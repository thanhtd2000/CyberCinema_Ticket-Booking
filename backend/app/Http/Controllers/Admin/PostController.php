<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FirebaseHelper;
use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\GlobalHelper;

class PostController extends Controller
{
    public  $firebaseHelper;
    public $globalHelper;
    public $posts;
    public function __construct(Post $posts)
    {
        $this->firebaseHelper = new FirebaseHelper();
        $this->globalHelper = new GlobalHelper();
        $this->posts = $posts;
    }

    public function show()
    {
        $posts =  $this->posts->latest()->paginate(5);
        return view('admin.post.index', compact('posts'));
    }
    public function search(Request $request)
    {
        $query = $request->input('keywords');
        $posts =  $this->posts->where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->paginate(5);
        return view('admin.post.index', compact('posts'));
    }
    public function create()
    {
        return view('admin.post.create');
    }
    public function store(Request $request)
    {
        $rule = [
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required',
            'image' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ];
        $message = [
            'required' => 'Trường bắt buộc phải nhập'
        ];
        $post = $request->validate($rule, $message);
        if ($request->hasFile('image')) {
            $path = 'Posts/';
            $image = $request->image;
            $pt = new Post();
            $pt->image = $this->firebaseHelper->uploadimageToFireBase($image, $path);
            $pt->title = $post['title'];
            $pt->content = $post['content'];
            $pt->slug = $this->globalHelper->generateUniqueSlug($this->posts, $request->title);
            $pt->user_id = $post['user_id'];
        }
        $pt->save();
        return redirect()->route('posts.show')->with('message', 'Thêm thành công');
    }
    public function delete(Request $request)
    {

        $Post =  $this->posts->find($request->id);
        if ($Post && $Post->delete()) {
            return redirect('admin/posts/index')->with('message', 'Xoá thành công');
        }
    }
    public function edit(Request $request)
    {
        $post =  $this->posts->find($request->id);

        return view('admin.post.edit', compact('post'));
    }
    public function update(Request $request)
    {
        $rule = [
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required',
            'id' => 'required',
        ];
        $message = [
            'required' => 'Trường bắt buộc phải nhập'
        ];

        $post = $request->validate($rule, $message);
        $pt =  $this->posts->find($post['id']);
        if ($request->hasFile('image')) {
            $path = 'Posts/';
            $this->firebaseHelper->deleteImage($pt->image, $path);
            $image = $request->image;
            $pt->image = $this->firebaseHelper->uploadimageToFireBase($image, $path);
        }
        $pt->title = $post['title'];
        $pt->content = $post['content'];
        $pt->slug = $this->globalHelper->generateUniqueSlug($this->posts, $request->title);
        $pt->user_id = $post['user_id'];
        $pt->save();
        return redirect()->route('posts.show')->with('message', 'Sửa thành công');
    }



    public function deleteMultiple(Request $request)
    {
        $ids = $request->input('ids');

        $this->posts->whereIn('id', $ids)->delete();

        return redirect()->back()->with('message', 'Đã xoá ' . count($ids) . ' bài viết.');
    }
}
