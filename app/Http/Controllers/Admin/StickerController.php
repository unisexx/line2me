<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Sticker;
use DB;

class StickerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $keyword = $request->get('search');
        $category = $request->get('category');
        $perPage = 10;

        if (!empty($keyword) || !empty($category)) {

            $rs = Sticker::select('*');

            if (!empty($category)) {
                $rs = $rs->where('category', $category);
            }

            if (!empty($keyword)) {
                $rs = $rs->where(function ($q) use ($keyword) {
                    $q->where('title_th', 'LIKE', "%$keyword%")
                        ->orWhere('title_en', 'LIKE', "%$keyword%")
                        ->orWhere('sticker_code', 'LIKE', "%$keyword%")
                        ->orWhere('sticker_code', 'LIKE', "%$keyword%");
                });
            }

            $rs = $rs->orderBy('id','desc')->simplePaginate($perPage);

        } else {
            $rs = Sticker::orderBy('id','desc')->simplePaginate($perPage);
        }

        return view('admin.sticker.index', compact('rs'));
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
        //
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
    public function edit($sticker_code)
    {
        $rs = Sticker::where('sticker_code', $sticker_code)->firstOrFail();

        return view('admin.sticker.edit', compact('rs'));
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
        $requestData = $request->all();

        $sticker = Sticker::findOrFail($id);
        $sticker->update($requestData);

        set_notify('success', 'แก้ไขข้อมูลสำเร็จ');
        return redirect('admin/sticker');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
