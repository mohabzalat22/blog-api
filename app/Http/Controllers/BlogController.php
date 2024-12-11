<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->search ?? '';

        $data = Post::where('title', 'like', '%' . $searchTerm . '%')
        ->orWhere('content', 'like', '%' . $searchTerm . '%')
        ->orWhereHas('category', function($query) use ($searchTerm) {
            $query->where('name', 'like', '%'. $searchTerm . '%');
        }
        )->paginate(10);
        return $this->successResponse('Posts Retrived Successfully.', $data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(
            [
                'user_id' => Auth::id(),
            ]);

        $validator = Validator::make($request->all(), 
            [
            'user_id' => ['required', 'exists:users,id'],
            'category_id' => ['required','exists:categories,id'],
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            ]);

        if($validator->fails()){
            return $this->errorResponse('Validation Failed.', $validator->errors());
        }
        
        $post = Post::create([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'content' => $request->content,
        ]);
        return $this->successResponse('Post Created Successfully.', $post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {      
            $post = Post::findOrFail($id);
            if($post){
                return $this->successResponse('Post Retrived Successfully.', $post, 200);
            }

        } catch(ModelNotFoundException $e) {
            return $this->errorResponse('Error Occured During Retriving Post.', [] , 404);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $post = Post::findOrFail($id);
    
            if($post){
                $request->merge(
                    [
                        'user_id' => Auth::id(),
                    ]);
        
                $validator = Validator::make($request->all(), 
                    [
                    'user_id' => ['required'],
                    'title' => ['required', 'string'],
                    'content' => ['required', 'string'],
                    ]);
        
                if($validator->fails()){
                    return $this->errorResponse('Validation Failed.', $validator->errors());
                }
                // update
                $post->update([
                    'title' => $request->title,
                    'content' => $request->content,
                ]);
                $updatedPost = Post::findOrFail($id);
                return $this->successResponse('Post Updated Successfully.', $updatedPost, 200);
            }
        } catch(ModelNotFoundException $e) {
            return $this->errorResponse('Error Occured Updating Post.', [] , 404);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{

            $post = Post::findOrFail($id);
            $post->delete();
            return $this->successResponse(message:'Post Deleted Successfully.', data:null, status_code:204);

        } catch(ModelNotFoundException $e) {
            return $this->errorResponse('Error Occured Deleting Post.', [] , 404);
        }
         
    }
}
