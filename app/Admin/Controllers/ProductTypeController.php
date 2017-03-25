<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\ProductType;

class ProductTypeController extends Controller
{
    use ModelForm;

	public function index()
	{
		return Admin::content(function(Content $content){
			$content->header('产品类别');
			$content->description('产品类别曾删改查');

			$content->body($this->grid());
		});
	}

	protected function grid()
	{
		return Admin::grid(ProductType::class,function(Grid $grid){
			$grid->id('ID')->sortable();
			$grid->name('名称')->editable();
			$grid->products('产品数')->display(function($products) use ($grid){
				$count=count($products);
				//return "<a href='/admin/type/{$this->id}/products'>共{$count}款产品</a>";
				return "<a href=''>共{$count}款产品</a>";
			});

			$grid->filter(function($filter){
				$filter->disableIdFilter();

				$filter->like('name','名称');
			});
		});
	}

	protected function form()
	{
		return Admin::form(ProductType::class,function(Form $form){
			$form->text('name','名称');
			$form->text('remarks','备注');
			$form->display('created_at','创建于');
			$form->display('updated_at','更新于');
		});
	}

	public function create()
	{
		return Admin::content(function(Content $content){
			$content->header('创建类别');
			$content->body($this->form());
		});
	}

	public function edit($id)
	{
		return Admin::content(function(Content $content) use ($id){
			$content->header('产品类别编辑');
			$content->description('产品类别编辑');

			$content->body($this->form()->edit($id));
		});
	}
}
