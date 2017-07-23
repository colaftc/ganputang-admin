@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">上传订单数据</div>

                <div class="panel-body">
					<form name="form1" action="/order-analyze" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}
						<label for="orderfile">订单文件</label><input type="file" name="orderfile">
						<br>
						<label for="goodsfile">商品文件</label><input type="file" name="goodsfile">
						<br>
						<input type="submit" value="确认上传">
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
