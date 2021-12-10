<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    {{-- <meta name="keyword" content="sky, skylevel, skylevel-concepts, conepts, concpets,Fiyin,samuel, ogunsola samuel, ogunsola samuel fiyin, ogunsola fiyinfoluwa samuel, Damilola, level, concept, concepts, skylevelconcepts, fiyinfoluwa, ogunsola, phyyeen001, phyyeen, blog, websitedesgin, marketing, cheap website design, free website design, unilag, lasu, ui, bbn, bet9ja, bb9ja, bbnigeria, happynewyear, ikeja lagos, company in ikeja, website company, 2020" />
    <meta name="description" content="Skylevel-Concepts is a Nigeria based IT company, where creative minds provide solutions and help to move businesses to the next level. We are built on a great level of integrity, principle and excellence out put." />
    <meta name="author" content="skylevelconcepts.com.ng"> --}}
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="{{ asset('css/app2.css') }}">
    <title>{{env('APP_NAME')}}</title>
    
</head>
@include('vendor.sweetalert.alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

<body>

    {{-- <div class="loader">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="spinner">
                    <div class="rect1"></div>
                    <div class="rect2"></div>
                    <div class="rect3"></div>
                    <div class="rect4"></div>
                    <div class="rect5"></div>
                </div>
            </div>
        </div>
    </div> --}}





    <span>Hello There 😊. Thank you for choosing Midone Admin. Click <a href="{{url('dashboard')}}">here</a> to go to admin </span>



    
</body>

</html>
