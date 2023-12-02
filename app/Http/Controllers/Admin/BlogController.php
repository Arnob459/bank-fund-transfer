<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Title;
use App\Models\Blog;

use Illuminate\Support\Facades\Storage;
use Image;

class BlogController extends Controller
{
        //Blog
        public function Blog()
        {
            $data['page_title'] = 'Blog';
            $data['blog'] = Title::where('key_value', 'blog')->first();
            $data['blogs'] = Blog::all();
            return view('admin.pages.blog.index',$data);
        }

        public function blogSectionUpdate(Request $request)
        {
            $this->validate($request, [
                'blog_title' => 'required|string|max:255',
                'blog_subtitle' => 'required|string|max:255',
            ]);

            $data = Title::where('key_value', 'blog')->first();
            $data->title = $request->blog_title;
            $data->sub_title = $request->blog_subtitle;
            $data->save();
            return back()->with('success','Updated Successfully');
        }

        public function blogCreate(){
            $data['page_title'] = ' Blog Create';
            return view('admin.pages.blog.create',$data);
        }

        public function blogStore(Request $request){

            $this->validate($request, [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2024',
            ]);

            if ($request->hasFile('image')) {
                try {
                    $path = config('constants.blog.path');
                    $size = config('constants.blog.size');
                    $thumb = config('constants.blog.thumb');
                    $old_image = null;
                    $filename = upload_image($request->image, $path, $size,$old_image, $thumb);
                } catch (\Exception $exp) {
                    return back()->withWarning('Image could not be uploaded');
                }
            }

            $blog = new Blog();
            $blog->title =  $request->title;
            $blog->description =  $request->description;
            $blog->image =  $filename;
            $blog->save();
            return redirect()->route('admin.blog')->with('success','Blog Create Successfully');

        }

        public function blogEdit($id) {
            $data['page_title'] = 'Blog Edit';

            $data['blog'] = Blog::findOrfail($id);
            return view('admin.pages.blog.edit',$data);
        }
        public function blogUpdate(Request $request, $id){

            $this->validate($request, [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'image|mimes:jpeg,png,jpg|max:2024',
            ]);

            $blog = Blog::findOrfail($id);
            if ($request->hasFile('image')) {
                $filename = $blog->image;
                try {
                    $path = config('constants.blog.path');
                    $size = config('constants.blog.size');
                    remove_file(config('constants.blog.path') . '/' . $blog->image);
                    $filename = upload_image($request->image, $path, $size, $filename);
                } catch (\Exception $exp) {
                    return back()->withWarning('Image could not be uploaded');
                }
                $blog->image = $filename;
            }
            $blog->title =  $request->title;
            $blog->description =  $request->description;
            $blog->save();
            return back()->with('success','Blog Updated Successfully');
        }
        public function destroy($id)
        {
            $data = Blog::find($id);
            if (!$data) {
                return redirect()->back()->with('success', ' Deleted successfully');
            }
            $data->delete();
            return redirect()->back()->with('success', ' Deleted successfully');
        }
}
