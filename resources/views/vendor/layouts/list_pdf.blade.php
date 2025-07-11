<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    @yield('pdf-title')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/pdf/list_pdf.min.css') }}">
</head>

<body>
    <div class="content-wraper">
        <div>
            <div>
                <table class="table">
                    <tbody>
                        <tr class="tbody-tr">
                            @yield('header-info')
                            <td class="td-off"></td>
                            <td colspan="2" class="tbody-td">
                                @php
                                    $company_logo = preference('company_logo');
                                @endphp
                                @if(!empty($company_logo))
                                    @if(file_exists("uploads/companyPic/". $company_logo) == true)
                                        <img src="{{ url('/') . '/uploads/companyPic/' . $company_logo }}" alt="{{ url('/') . 'uploads/companyPic/' . $company_logo }}" class="mt-1p5">
                                    @endif
                                @endif
                                <div><span class="company-name">{{ preference('company_name') }}</span></div>
                                <div class="d-block">
                                    <span class="company-info">{{ preference('company_street') }},  {{ preference('company_city') }}</span>
                                    <span class="company-info">{{ preference('company_country_name') }}, {{ preference('company_zipCode') }}</span>
                                </div>

                                <div>
                                    <span class="company-info">
                                        {{ __('Web') }}: <a class="company-info-url" href="{{ url('/') }}">{{ url('/') }}</a>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-30">
                @yield('list-table')
            </div>
        </div>
    </div>
</body>
</html>
