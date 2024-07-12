<!DOCTYPE html>
<html lang="en">
	<head>
		@include('layout.partials.head')
	</head>
	<body>
		@include('layout.partials.navbar')
<!--
		@include('layout.partials.header')
-->
		@yield('content')
		{{-- @include('layout.partials.footer') --}}
		@include('layout.partials.footer-scripts')
		@yield('custom-scripts')
	</body>
</html>
