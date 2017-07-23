<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Customers;
use App\TbOrder;
use App\TbOrderProduct;

class CostController extends Controller
{
	/*private $analyzer;
	public function __construct(OrderAnalyzer,$analyzer)
	{
		$this->analyzer=$analyzer;
	}*/

	public function upload()
	{
		return view('order-upload');
	}

	public function download()
	{
		$data=TbOrder::completed()->orderBy('buytime')->get();
		$result=array(array('订单编号','实付总价','备注','商品总数量','拍下时间','状态','商品'));
		foreach($data as $d)
		{
			$temp='';
			foreach($d->products as $p)
			{
				$temp.=$p->title . ' 数量 ：' .$p->quantity.chr(10);
			}
			$result[]=array($d->id,$d->price,$d->remarks,$d->total_count,$d->buytime,$d->status,$temp);
		}
		Excel::create('order_list',function($excel) use($result){
			$excel->sheet('sheet1',function($sheet) use($result){
				$sheet->fromArray($result);
			});
		})->download('xls');;
	}

	public function analyze(Request $request)
	{
		if($request->hasFile('orderfile') && $request->hasFile('goodsfile'))
		{
			$order_path=$request->file('orderfile')->storeAs('csv','a.csv');
			$goods_path=$request->file('goodsfile')->storeAs('csv','b.csv');

			$goods=Excel::load('storage/app/'.$goods_path)->get()->toArray();

			Excel::load('storage/app/'.$order_path,function($reader) use($goods){
				$items=$reader->limitColumns(33)->toArray();
				foreach($items as $v)
				{
					$customer=Customers::firstOrNew([
						'tid'=>$v[1]
					]);
					$customer->name=$v[12];
					$customer->addr=$v[13];
					$customer->mobile=$v[16];
					$customer->reffer='TB';
					$customer->save();
					
					$tborder=new TbOrder();
					$tborder->id=$v[0];
					$tborder->price=$v[8];
					$tborder->status=$v[10];
					$tborder->message=$v[11];
					$tborder->remarks=$v[23];
					$tborder->exp_no=$v[21];
					$tborder->exp_com=$v[22];
					$tborder->buytime=$v[17];
					$tborder->paytime=$v[18];
					$tborder->total_count=$v[24];
					$tborder->save();
					
					foreach($goods as $p)
					{
						if($p[0]===(string)$v[0])
						{
							$temp=new TbOrderProduct();
							$temp->title=$p[1];
							$temp->code=$p[9];
							$temp->quantity=$p[3];
							$temp->oid=$v[0];
							$temp->save();
						}
					}
				}
			});
			return redirect('display-order');
		}
		return redirect('order-upload');
	}
}
