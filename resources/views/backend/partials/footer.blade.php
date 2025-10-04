<footer class="app-footer">
    <!--begin::To the end-->
    <div class="float-end d-none d-sm-inline">{{ showDateFormat(date('Y-m-d')) }} </div>
    <!--end::To the end-->
    <!--begin::Copyright-->
    <strong>
        Copyright &copy; {{ date('Y') }}&nbsp;
        <a href="{{ url('/') }}" class="text-decoration-none">{{ $siteData['site_name'] }}</a>.
    </strong>
    All rights reserved.
    <!--end::Copyright-->
</footer>
