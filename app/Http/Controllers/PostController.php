<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $post = Post::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $exploded = explode(',',$request->post_image);
        
        $decoded = base64_decode($exploded[1]);
        
        if(str_contains($exploded[0],'jpeg')){
            $extension = 'jpeg';
        }else{
            $extension = 'png';
        }
        $name = str_replace(' ', '_', $request->input('post_title'));
        $imageName = $name.'.'.time().'.'. $extension;
        $path = public_path().'/'.$imageName;
        file_put_contents($path,$decoded);
        $post = Post::create($request->except('post_image')+[
            'post_image' => $imageName
        ]);
        return $post;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if(file_exists(public_path().'/'.$request->post_image)){
            $post->update($request->all());
            return $post;
        }else{
            $exploded = explode(',',$request->post_image);
            $decoded = base64_decode($exploded[1]);
            if(str_contains($exploded[0],'jpeg')){
                $extension = 'jpeg';
            }else{
                $extension = 'png';
            }
            $name = str_replace(' ', '_', $request->input('post_title'));
            $imageName = $name.'.'.time().'.'. $extension;
            $path = public_path().'/'.$imageName;
            file_put_contents($path,$decoded);
            $post->update($request->except('post_image')+[
                'post_image' => $imageName
            ]);
            
            return $post;
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if($post->post_image != null ){
            unlink(public_path().'/'.$post->post_image);
        }
        $post->delete();
        return $post;
    }
}
