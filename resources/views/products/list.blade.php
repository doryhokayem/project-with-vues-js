@if (count($products))
	<h1 class="title is-3">My products</h1>

	<ul>
		@foreach ($products as $product)
			<li>
				<a href="#">{{ $product->name }}</a>
			</li>
		@endforeach
	</ul>

	<hr>
@endif
