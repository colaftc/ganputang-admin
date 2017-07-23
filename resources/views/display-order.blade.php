@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">订单汇总 ，共{{$count}}个订单，金额：{{$total_price}}</div>
				<div class="panel-body">
					<ol>
						@foreach($data as $d)
							<li @if($d->remarks) style="background-color:pink;"  @endif >
								订单编号:{{$d->id}} , 订单实付金额：{{$d->price}} , 拍下时间：{{$d->buytime}}
									<ul>
										@foreach($d->products as $p)
											<li>{{$p->title}} : 数量{{$p->quantity}}</li>
										@endforeach
									</ul>
								备注：{{$d->remarks}}
								<hr>
							</li>
						@endforeach
					</ol>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

