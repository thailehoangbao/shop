<!DOCTYPE html>
<html lang="en">
<head>
    @include('client.head')
</head>
<body >
	<!-- Header -->
    @include('client.header')
    @yield('body')

	<!-- Footer -->
    @include('client.footer')


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

    @include('client.modalproduct')

    @include('client.foot')

</body>
</html>
