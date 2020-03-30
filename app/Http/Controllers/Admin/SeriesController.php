<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Series;
use App\Models\SeriesItem;
use DB;

class SeriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $keyword = $request->get('search');

        $rs = Series::select('*');

		if (!empty($keyword)) {
			$rs = $rs->where('title', 'LIKE', "%$keyword%");
		}

		$rs = $rs->orderBy('id','desc')->simplePaginate(30);


        return view('admin.series.index', compact('rs'));
    }

	public function create()
    {
        return view('admin.series.create');
    }

	public function store(Request $request)
    {
        $requestData = $request->all();
        $series = Series::create($requestData);

		if (isset($request->product_code)) {
			foreach ($request->product_code as $i => $item) {
				SeriesItem::updateOrCreate(
					[
						'id' => $request->product_item_id[$i],
					],
					[
						'product_code' => getProductCodeFromStoreUrl($request->product_code[$i]),
						'product_type' => $request->product_type[$i],
						'series_id' => $series->id,
						'order' => ($i+1),
					]
				);
			}
		}

		// ลบรายการที่อาจจะใส่ข้อมูลซ้ำ
		deleteDuplicateSeriesItem($series->id);

        set_notify('success', 'บันทึกข้อมูลสำเร็จ');
		// return redirect()->back();
        return redirect('admin/series');
    }

	public function edit($id)
    {
        $rs = Series::findOrFail($id);
        return view('admin.series.edit', compact('rs'));
    }

	public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $rs = Series::findOrFail($id);
        $rs->update($requestData);

		// ลบรายการ
		SeriesItem::where('series_id', $id)->whereNotIn('id', $request->product_item_id)->delete();

		if (isset($request->product_code)) {
			foreach ($request->product_code as $i => $item) {
				SeriesItem::updateOrCreate(
					[
						'id' => $request->product_item_id[$i],
					],
					[
						'product_code' => getProductCodeFromStoreUrl($request->product_code[$i]),
						'product_type' => $request->product_type[$i],
						'series_id' => $id,
						'order' => ($i+1),
					]
				);
			}
		}

		// ลบรายการที่อาจจะใส่ข้อมูลซ้ำ
		deleteDuplicateSeriesItem($id);

        set_notify('success', 'แก้ไขข้อมูลสำเร็จ');
        return redirect()->back();
    }

	public function destroy($id)
    {
        Series::destroy($id);
        set_notify('success', 'ลบข้อมูลสำเร็จ');
        return redirect('admin/series');
    }

}
