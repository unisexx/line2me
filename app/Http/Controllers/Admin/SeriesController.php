<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Series;
use App\Models\SeriesItem;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $keyword = $request->get('search');

        $rs = Series::with('seriesItem')->select('*');

        if (!empty($keyword)) {
            $rs = $rs->where('title', 'LIKE', "%$keyword%")->orWhere('sub_title', 'LIKE', "%$keyword%");
        }

        $rs = $rs->orderBY('hilight', 'desc')->orderBy('id', 'desc')->simplePaginate(30);

        return view('admin.series.index', compact('rs'));
    }

    public function create()
    {
        return view('admin.series.create');
    }

    public function store(Request $request)
    {
        $requestData = $request->all();
        $series      = Series::create($requestData);

        if (isset($request->product_code)) {
            foreach ($request->product_code as $i => $item) {
                SeriesItem::updateOrCreate(
                    [
                        'id' => $request->product_item_id[$i],
                    ],
                    [
                        'product_code' => getProductCodeFromStoreUrl($request->product_code[$i]),
                        'product_type' => $request->product_type[$i] ? $request->product_type[$i] : getProductTypeFromStoreUrl($request->product_code[$i]),
                        'series_id'    => $series->id,
                        'order'        => $request->order[$i] ? $request->order[$i] : ($i + 1),
                    ]
                );
            }
        }

        // ลบรายการที่อาจจะใส่ข้อมูลซ้ำ
        deleteDuplicateSeriesItem($series->id);

        set_notify('success', 'บันทึกข้อมูลสำเร็จ');
        // return redirect()->back();

        return redirect('admin/series/' . $series->id . '/edit');
    }

    public function edit($id)
    {
        $rs = Series::with('seriesItem.sticker', 'seriesItem.theme', 'seriesItem.emoji')->findOrFail($id);

        return view('admin.series.edit', compact('rs'));
    }

    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $rs          = Series::findOrFail($id);
        $rs->update($requestData);

        // ลบรายการ
        if ($request->product_item_id) {
            SeriesItem::where('series_id', $id)->whereNotIn('id', $request->product_item_id)->delete();
        }

        // fastAdd
        $this->fastAdd($request, $id);

        if (isset($request->product_code)) {
            foreach ($request->product_code as $i => $item) {
                SeriesItem::updateOrCreate(
                    [
                        'id' => $request->product_item_id[$i],
                    ],
                    [
                        'product_code' => getProductCodeFromStoreUrl($request->product_code[$i]),
                        'product_type' => $this->getProductType($request->product_code[$i]),
                        'series_id'    => $id,
                        'order'        => $i + 1,
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

    public function getProductType($product_code)
    {
        if (is_numeric($product_code)) { // sticker
            $product_type = 'sticker';
        } elseif (strpos($product_code, '-') !== false) { // theme
            $product_type = 'theme';
        } else { // emoji
            $product_type = 'emoji';
        }
        return @$product_type;
    }

    public function fastAdd($request, $id)
    {
        if ($request->fast) {
            $line = preg_split('/\r\n|[\r\n]/', $request->fast);

            foreach ($line as $i => $item) {
                SeriesItem::create(
                    [
                        'series_id'    => $id,
                        'product_code' => getProductCodeFromStoreUrl($item),
                        'product_type' => $this->getProductType($item),
                        'order'        => 0,
                    ]
                );
            }
        }
    }

}
