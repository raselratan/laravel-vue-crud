<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostController extends Controller
{  
    public function index()
    {
        return Post::latest()->paginate(5);
    }
    
    public function store(Request $request)
    {   
        $this->validate($request,[
            'title'=>'required | max:191',
            'body'=>'required|max:1500',
            ]);
        $name='';
        if($request->photo !=null){
            $ext=explode('/',explode(';',$request->photo)[0])[1];
            $name=time().'.'.$ext;
            \Image::make($request->photo)->save(public_path('img/post/').$name);
        }    
        return Post::create([
            'title'    =>$request['title'],
            'body'     =>$request['body'],
            'user_id'  =>Auth::guard('admin')->user()->id,
            'photo'    =>$name,
            
        ]);
    }

    public function update(Request $request, $id)
    {
        $post=Post::findOrFail($id);
        $this->validate($request,[
            'title'=>'required | max:191',
            'body'=>'required|max:1500',
        ]);
        if($request->photo!=$post->photo){
            $ext=explode('/',explode(';',$request->photo)[0])[1];
            $name=time().'.'.$ext;
            \Image::make($request->photo)->save(public_path('img/post/').$name);
            
            $request->merge(['photo'=> $name]);
            $postPhoto=public_path('img/post/').$post->photo;
            if(file_exists($postPhoto)){
                @unlink($postPhoto);
            }
      
        }
        $post->update($request->all());
        return ['message'=>'Updated Successfully'];
    }

    public function destroy($id)
    {
        $post=Post::findOrFail($id);
        $postPhoto=public_path('img/post/').$post->photo;
        if(file_exists($postPhoto)){
            @unlink($postPhoto);
        }
        $post->delete();
        return['message'=>'Deleted Successfully'];
    }


}
