<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::paginate(10);
        return $this->successResponse('Tags Retrived Successfully.', $tags, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => ['required', 'string']
        ]);

        if($validator->fails()){
            return $this->errorResponse('Validation Failed.', $validator->errors());
        }

        $tag = Tag::create([
            'name' => $request->name,
        ]);
        return $this->successResponse('Tag Created Successfully.', $tag, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $tag = Tag::findOrFail($id);
            if($tag){
                return $this->successResponse('Tag Retrived Successfully.', $tag, 200);
            }
        } catch(ModelNotFoundException $e) {
            return $this->errorResponse('Error Occured During Retriving Tag.', [] , 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $tag = Tag::findOrFail($id);
            if($tag){
                $validator = Validator::make($request->all(),
                [
                    'name'=> ['required', 'string']
                ]);
                
                if($validator->fails()){
                    return $this->errorResponse('Validation Failed.', $validator->errors() , 404);
                }

                $tag->update([
                    'name' => $request->name
                ]);
                $updatedTag = Tag::findOrFail($id);
                return $this->successResponse('Tag Updated Successfully.', $updatedTag, 200);
            }
        } catch(ModelNotFoundException $e) {
            return $this->errorResponse('Error Occured Updating Tag.', [] , 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{

            $tag = Tag::findOrFail($id);
            $tag->delete();
            return $this->successResponse(message:'Tag Deleted Successfully.', data:null, status_code:204);

        } catch(ModelNotFoundException $e) {
            return $this->errorResponse('Error Occured Deleting Tag.', [] , 404);
        }
    }
}
