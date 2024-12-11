<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return $this->successResponse('Categories Retrived Successfully.', $categories, 200);
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

        $category = Category::create([
            'name' => $request->name,
        ]);
        return $this->successResponse('Category Created Successfully.', $category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $category = Category::findOrFail($id);
            if($category){
                return $this->successResponse('Category Retrived Successfully.', $category, 200);
            }
        } catch(ModelNotFoundException $e) {
            return $this->errorResponse('Error Occured During Retriving Category.', [] , 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $category = Category::findOrFail($id);
            if($category){
                $validator = Validator::make($request->all(),
                [
                    'name'=> ['required', 'string']
                ]);
                
                if($validator->fails()){
                    return $this->errorResponse('Validation Failed.', $validator->errors() , 404);
                }

                $category->update([
                    'name' => $request->name
                ]);
                $updatedCategory = Category::findOrFail($id);
                return $this->successResponse('Category Updated Successfully.', $updatedCategory, 200);
            }
        } catch(ModelNotFoundException $e) {
            return $this->errorResponse('Error Occured Updating Category.', [] , 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{

            $category = Category::findOrFail($id);
            $category->delete();
            return $this->successResponse(message:'Category Deleted Successfully.', data:null, status_code:204);

        } catch(ModelNotFoundException $e) {
            return $this->errorResponse('Error Occured Deleting Category.', [] , 404);
        }
    }
}
