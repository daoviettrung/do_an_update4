@extends('dashboard.index')

@section('title', 'Member')

@section('style')
    <!-- Bootstrap Core CSS -->
    <link href="assets_dashboard/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="assets_dashboard/css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="assets_dashboard/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets_dashboard/css/startmin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets_dashboard/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
@endsection

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8 col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Personal information
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <img class="img-responsive"
                                         src="https://ui-avatars.com/api/?size=200&name={{substr(Auth::user()->name, 0, 1)}}"
                                         alt="">
                                </div>
                                <div class="col-lg-8">
                                    <p>
                                        <strong>Name: </strong> {{Auth::user()->name}}
                                    <p>
                                    <p>
                                        <strong>Email: </strong> {{Auth::user()->email}}
                                    <p>
                                    <p>
                                        <strong>Gender: </strong> {{Auth::user()->gender}}
                                    <p>
                                    <p>
                                        <strong>Birthday: </strong> {{Auth::user()->birthday}}
                                    <p>
                                    <p>
                                        <strong>Level: </strong> @if(Auth::user()->level==2) Admin @endif
                                    <p>
                                    <p>
                                        <strong>Description: </strong> {{Auth::user()->description}}
                                    <p>
                                    <p>
                                        <strong>Total number of posts: </strong> {{$count_all_post}}
                                    <p>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                        </div>
                        <div class="panel-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection

@section('js')
    <!-- jQuery -->
    <script src="assets_dashboard/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets_dashboard/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="assets_dashboard/js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="assets_dashboard/js/startmin.js"></script>
@endsection
