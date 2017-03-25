@extends('layouts.app')

@section('content')
<h2>Testing</h2>
	@foreach($data as $d)
		<p>{{$d}}</p>
		<ul>
		@foreach($d->products as $p)
			<li>
				{{$p}} : {{$p->type}}
			</li>
		@endforeach
		</ul>
	@endforeach
@endsection
