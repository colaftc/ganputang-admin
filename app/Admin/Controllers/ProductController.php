<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Product;
use App\ProductType;
use App\Supplier;

class ProductController extends Controller
{
    use ModelForm;

	protected function form()
	{
		return Admin::form(Product::class,function(Form $form){
			$form->text('name','名称');
			$form->text('spec','规格');
			$form->text('brand','品牌');
			$form->text('in_price','进价')->rules('numeric');
			$form->text('out_price','指导零售价')->rules('numeric');
			$form->text('out_wholesaleprice','指导批发价')->rules('numeric');
			$form->text('remarks','备注')->value('无');
			$form->select('type_id','类别')->options(function(){
				$result=[];
				$types=ProductType::all()->toArray();
				foreach($types as $t)
				{
					$result[$t['id']]=$t['name'];
				}
				return $result;
			});

			$form->select('supplier_id','供应商')->options(function(){
				$result=[];
				$suppliers=Supplier::all()->toArray();
				foreach($suppliers as $s)
				{
					$result[$s['id']]=$s['name'];
				}
				return $result;
			});

			$form->display('created_at','创建于');
			$form->display('updated_at','更新于');
		});
	}

	protected function grid()
	{
		return Admin::grid(Product::class,function(Grid $grid){
			$grid->id('ID')->sortable();
			$grid->name('名称')->editable();
			$grid->spec('规格')->editable();
			$grid->brand('品牌')->editable();
			$grid->in_price('进价')->editable()->sortable();
			$grid->out_price('指导零售价')->editable()->sortable();
			$grid->out_wholesaleprice('指导批发价')->editable()->sortable();
			$grid->supplier('供应商')->display(function($s){
				return "<i>{$s['name']}</i>";
			});;
			$grid->type('类别')->display(function($type){
				return "<i>{$type['name']}</i>";
			});;
			$grid->remarks('备注');
			$grid->created_at('创建于')->sortable();

			$grid->filter(function($filter){
				$filter->disableIdFilter();
				$filter->useModal();
				$filter->like('name','名称');
				$filter->like('brand','品牌');
				$filter->between('in_price','进价');
				$filter->between('out_price','指导零售价');
				$filter->between('out_wholesaleprice','指导批发价');
			});
		});
	}

	public function create()
	{
		return Admin::content(function(Content $content){
			$content->header('产品');
			$content->description('创建');

			$content->body($this->form());
		});
	}
		
	public function index()
	{
		return Admin::content(function(Content $content){
			$content->header('产品');
			$content->description('列表');

			$content->body($this->grid());
		});
	}

	public function edit($id)
	{
		return Admin::content(function(Content $content) use ($id){
			$content->header('产品');
			$content->description('编辑');

			$content->body($this->form()->edit($id));
		});
	}
}
