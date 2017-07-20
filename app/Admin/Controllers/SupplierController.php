<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Supplier;

class SupplierController extends Controller
{
    use ModelForm;

	public function index()
	{
		return Admin::content(function(Content $content){
			$content->header('供应商');
			$content->description('列表');

			$content->body($this->grid());
		});
	}

	protected function grid()
	{
		return Admin::grid(Supplier::class,function(Grid $grid){
			$grid->id('ID')->sortable();
			$grid->name('商号')->editable();
			$grid->brand('品牌')->editable();
			$grid->brandholder('品牌持有人')->display(function($brandholder){
				return $brandholder ? '是':'否' ;
			});
			$grid->products('产品数')->display(function($products) use ($grid){
				$count=count($products);
				return "<a href='/admin/supplier/{$this->id}/products'>共{$count}款产品</a>";
			});
			$grid->contact('联系人')->editable();
			$grid->mobile('电话')->editable();
			$grid->created_at('创建于')->sortable();

			$grid->filter(function($filter){
				$filter->useModal();
				$filter->disableIdFilter();
				$filter->like('brand','品牌');
				$filter->like('name','商号');
			});
		});
	}

	protected function form()
	{
		return Admin::form(Supplier::class,function(Form $form){
			$form->text('name','商号');
			$form->text('address','地址');
			$form->text('brand','品牌');
			$form->radio('brandholder','品牌持有人')->options([
				0 => '否',
				1 => '是'
			])->default(0);
			$form->text('contact','联系人');
			$form->text('mobile','电话');
			$form->display('created_at','创建于');
		});
	}

	public function edit($id)
	{
		return Admin::content(function(Content $content) use ($id){
			$content->header('供应商');
			$content->description('编辑');

			$content->body($this->form()->edit($id));
		});
	}

	public function create()
	{
		return Admin::content(function(Content $content){
			$content->header('供应商');
			$content->description('新建');

			$content->body($this->form());
		});
	}
}
