<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\ExpensesType;
use App\Expenditure;
use App\Shop;

class ExpenditureController extends Controller
{
    use ModelForm;

	protected function form()
	{
		return Admin::form(Expenditure::class,function(Form $form){
			$form->text('title','名目');
			$form->text('amount','金额')->rules('numeric');
			$form->radio('was_paid','已付清')->options([0=>'是',1=>'否'])->default(0);
			$form->radio('has_receipt','有票据')->options([0=>'是',1=>'否'])->default(0);
			$form->text('remarks','备注')->value('无');
			$form->date('paydate','付款日期');
			$form->select('type_id','类别')->options(function(){
				$result=[];
				$types=ExpensesType::all()->toArray();
				foreach($types as $t)
				{
					$result[$t['id']]=$t['name'];
				}
				return $result;
			});

			$form->select('shop_id','店铺')->options(function(){
				$result=[];
				$shops=Shop::all()->toArray();
				foreach($shops as $s)
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
		return Admin::grid(Expenditure::class,function(Grid $grid){
			$grid->id('ID')->sortable();
			$grid->title('名目')->editable();
			$grid->amount('金额')->editable()->sortable();
			$grid->column('has_receipt','有票据')->display(function($val){
				return $val ? '否':'是';
			});
			$grid->column('was_paid','已付清')->display(function($val){
				return $val ? '否':'是';
			});
			$grid->remarks('备注')->editable();
			$grid->shop('店铺')->display(function($s){
				return "<i>{$s['name']}</i>";
			});;
			$grid->type('类别')->display(function($type){
				return "<i>{$type['name']}</i>";
			});;
			$grid->created_at('创建于')->sortable();

			$grid->filter(function($filter){
				$filter->disableIdFilter();
				$filter->useModal();
				$filter->like('title','名目');
				$filter->like('remarks','备注');
				$filter->between('paydate','支付日期');
			});
		});
	}

	public function create()
	{
		return Admin::content(function(Content $content){
			$content->header('支出');
			$content->description('创建');

			$content->body($this->form());
		});
	}
		
	public function index()
	{
		return Admin::content(function(Content $content){
			$content->header('支出');
			$content->description('列表');

			$content->body($this->grid());
		});
	}

	public function edit($id)
	{
		return Admin::content(function(Content $content) use ($id){
			$content->header('支出');
			$content->description('编辑');

			$content->body($this->form()->edit($id));
		});
	}
}
