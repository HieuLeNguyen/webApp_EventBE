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

    <link href="{{asset('assets')}}/css/Chart.min.css" rel="stylesheet">

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
                    <li class="nav-item"><a class="nav-link" href="reports/index.html">Công suất phòng</a></li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="border-bottom mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h1 class="h2">{{session('name_event')}}</h1>
                </div>
                <span class="h6">{{session('date_event')}}</span>
            </div>

            <div class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Công suất phòng</h2>
                </div>
            </div>

            <canvas id="myChart"><canvas>

        </main>
        <script src="{{asset('assets')}}/Chart.min.js"></script>
        <script>
            // 'sessions_title', 'rooms_capacity', 'rgCount'

            
            const sessions_title = @json($sessions_title);
            const titles = sessions_title.map(title => title);
                        
            const rooms_capacity = @json($rooms_capacity);
            const capacitys = rooms_capacity.map(capacity => capacity);
                        
            const rgCount = @json($rgCount);
            const attendees = Object.values(rgCount);
            
            new Chart('myChart', {
                    type: 'bar', 
                    data: {
                        labels: titles,
                        datasets: [
                            {
                                label: 'Người tham dự', 
                                data: attendees,
                                backgroundColor: attendees.map((attendee, index) => (attendee > capacitys[index]) ? 'red' : 'green')
                            },
                            {
                                label: 'Công xuất phòng', 
                                data: capacitys,
                                backgroundColor:  'blue'
                            }
                        ]
                    },
                    options:{
                        legend: {
                            display: true,
                            position: 'right'
                        }
                    }
            });

        </script>
    </div>
</div>

</body>
</html>
