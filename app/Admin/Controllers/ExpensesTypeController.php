<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\ExpensesType;

class ExpensesTypeController extends Controller
{
    use ModelForm;

	protected function form()
	{
		return Admin::form(ExpensesType::class,function(Form $form){
			$form->text('name','名称');
			$form->text('remarks','备注')->value('无');
			$form->display('created_at','创建于');
		});
	}

	protected function grid()
	{
		return Admin::grid(ExpensesType::class,function(Grid $grid){
			$grid->id('ID')->sortable();
			$grid->name('名称')->editable();
			$grid->remarks('备注');
			$grid->created_at('创建于');

			$grid->filter(function($filter){
				$filter->disableIdFilter();
				$filter->useModal();
				$filter->like('name','名称');
				$filter->like('remarks','备注');
			});
		});
	}

	public function create()
	{
		return Admin::content(function(Content $content){
			$content->header('支出类型');
			$content->description('创建');

			$content->body($this->form());
		});
	}
		
	public function index()
	{
		return Admin::content(function(Content $content){
			$content->header('支出类型');
			$content->description('列表');

			$content->body($this->grid());
		});
	}

	public function edit($id)
	{
		return Admin::content(function(Content $content) use ($id){
			$content->header('支出类型');
			$content->description('编辑');

			$content->body($this->form()->edit($id));
		});
	}
}
