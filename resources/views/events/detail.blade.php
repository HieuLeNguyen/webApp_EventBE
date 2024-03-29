<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Event Backend</title>

    <base href="../">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets')}}/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles -->
    <link href="{{asset('assets')}}/css/custom.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/events">Nền tảng sự kiện</a>
    <span class="navbar-organizer w-100">{{session('name_user')}}</span>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" id="logout" href="/logout">Đăng xuất</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="/events">Quản lý sự kiện</a></li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>{{session('name_event')}}</span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link active" href="/events/{{session('slug_event')}}/detail">Tổng quan</a></li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Báo cáo</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item"><a class="nav-link" href="/reports/{{session('slug_event')}}">Công suất phòng</a></li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <div class="border-bottom mb-3 pt-3 pb-2 event-title">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h1 class="h2">{{session('name_event')}}</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="events/edit.html" class="btn btn-sm btn-outline-secondary">Sửa sự kiện</a>
                        </div>
                    </div>
                </div>
                <span class="h6">{{session('date_event')}}</span>
            </div>

            <!-- Tickets -->
            <div id="tickets" class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Vé</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="tickets/create.html" class="btn btn-sm btn-outline-secondary">
                                Tạo vé mới
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row tickets">
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Thường</h5>
                            <p class="card-text">200.-</p>
                            <p class="card-text">&nbsp;</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Đặt sớm</h5>
                            <p class="card-text">120.-</p>
                            <p class="card-text">Sẵn có cho đến June 1, 2019</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">VIP</h5>
                            <p class="card-text">400.-</p>
                            <p class="card-text">100 vé sẵn có</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sessions -->
            <div id="sessions" class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Phiên</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="sessions/create.html" class="btn btn-sm btn-outline-secondary">
                                Tạo phiên mới
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive sessions">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Thời gian</th>
                        <th>Loại</th>
                        <th class="w-100">Tiêu đề</th>
                        <th>Người trình bày</th>
                        <th>Kênh</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-nowrap">08:30 - 10:00</td>
                        <td>Talk</td>
                        <td><a href="sessions/edit.html">Chủ đạo</a></td>
                        <td class="text-nowrap">Một người quan trọng</td>
                        <td class="text-nowrap">Chính / Phòng A</td>
                    </tr>
                    <tr>
                        <td class="text-nowrap">10:15 - 11:00</td>
                        <td>Talk</td>
                        <td><a href="sessions/edit.html">X có gì mới?</a></td>
                        <td class="text-nowrap">Người khác</td>
                        <td class="text-nowrap">Chính / Phòng A</td>
                    </tr>
                    <tr>
                        <td class="text-nowrap">10:15 - 11:00</td>
                        <td>Workshop</td>
                        <td><a href="sessions/edit.html">Thực hành với Y</a></td>
                        <td class="text-nowrap">Người khác</td>
                        <td class="text-nowrap">Phụ / Phòng C</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!-- Channels -->
            <div id="channels" class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Kênh</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="channels/create.html" class="btn btn-sm btn-outline-secondary">
                                Tạo kênh mới
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row channels">
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Chính</h5>
                            <p class="card-text">3 Phiên, 1 phòng</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Phụ</h5>
                            <p class="card-text">15 phiên, 2 phòng</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rooms -->
            <div id="rooms" class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Phòng</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="rooms/create.html" class="btn btn-sm btn-outline-secondary">
                                Tạo phòng mới
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive rooms">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Công suất</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Phòng A</td>
                        <td>1,000</td>
                    </tr>
                    <tr>
                        <td>Phòng B</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>Phòng C</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>Phòng D</td>
                        <td>250</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </main>
    </div>
</div>

</body>
</html>
