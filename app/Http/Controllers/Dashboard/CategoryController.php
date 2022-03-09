<?php


namespace App\Http\Controllers\Dashboard;

use App\Exports\CategoryExport;
use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;

class CategoryController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read-category'])->only('index');
        $this->middleware(['permission:create-category'])->only('create');
        $this->middleware(['permission:update-category'])->only('edit');
        $this->middleware(['permission:delete-category'])->only('destroy');

    }//end of constructor
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::all();
        return response()->view('dashboard.category.index', compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'image' => 'required',
            'order'=>'required'
        ]);
        if (!$validator->fails()) {
            $request_all = $request->except(['image']);
            if (request()->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                $image->move('images/category', $imageName);
                $request_all['image'] = $imageName;
            }
            $category =  Category::create($request_all);
            if (auth()->user()->hasRole('Enterprises')) {
                $ent_id = auth()->user()->ent_id;
                DB::table('categories_enterprise')->insert(
                    ['category_id' => $category->id, 'enterprise_id' => $ent_id]
                );
            }

            return response()->json(['icon' => 'success', 'title' => 'category created successfully'], $category ? 200 : 400);
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $category = category::find($id);
        return response()->view('dashboard.category.edit', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update_category(Request $request, $locale, $id)
    {
        $category = category::find($id);
        $validator = Validator($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'order'=>'required'
        ]);
        $request_all = $request->except(['image']);

        if ($request->image != null && $request->image != 'undefined') {
            $image = $request->file('image');
            $imageName = time() . 'image.' . $image->getClientOriginalExtension();
            $image->move('images/category', $imageName);
            $request_all['image'] = $imageName;
        }
        $category->update($request_all);

        if (!$validator->fails()) {
            return response()->json(['icon' => 'success', 'title' => 'category created successfully'], $category ? 200 : 400);
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }
    public function export()
    {
        return Excel::download(new CategoryExport, 'category.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $enterprise = Category::find($id);
        $enterprise->delete();
        return response()->json(['icon' => 'success', 'title' => 'Category deleted successfully'], 200);
    }
    public function updateStatus(Request $request)
    {
        $user = Category::findOrFail($request->user_id);
        $user->is_show = $request->status;
        $user->save();
    
        return response()->json(['message' => 'User status updated successfully.']);
    }
}
