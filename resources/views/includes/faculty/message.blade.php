<!-- Toastr css-->
<link rel="stylesheet" href="{{asset('facultypanel/toastr/toastr.min.css')}}">
<!-- Toastr js-->
<script src="{{asset('facultypanel/toastr/toastr.min.js')}}"></script>
<script type="text/javascript">

        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif
        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}")
        @endif
        @if(count($errors)>0)
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}")
        @endforeach
        @endif
        @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}")
        @endif
</script>
