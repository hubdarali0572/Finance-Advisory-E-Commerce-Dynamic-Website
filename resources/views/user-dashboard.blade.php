@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f5f7fa;
        padding: 30px 20px;
    }

    .dashboard-container {
        max-width: 1700px;
        margin: 0 auto;
    }

    .dashboard-header {
        margin-bottom: 25px;
    }

    .dashboard-header h3 {
        color: #2d3748;
        font-size: 26px;
        font-weight: 500;
    }

    .cards-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .stat-card {
        position: relative;
        border-radius: 12px;
        padding: 24px 20px;
        color: white;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 140px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    /* Background patterns */
    .stat-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        z-index: 0;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 150px;
        height: 150px;
        background: rgba(0, 0, 0, 0.05);
        border-radius: 50%;
        z-index: 0;
    }

    /* Card content */
    .card-header {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .card-label {
        font-size: 13px;
        font-weight: 500;
        opacity: 0.95;
        letter-spacing: 0.3px;
        text-transform: capitalize;
    }

    .card-icon {
        width: 45px;
        height: 45px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
    }

    .card-icon i {
        font-size: 22px;
        color: white;
    }

    .card-footer {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }

    .card-value {
        font-size: 36px;
        font-weight: 700;
        line-height: 1;
    }

    .view-link {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        opacity: 0.9;
        font-weight: 500;
        transition: gap 0.3s ease;
    }

    .stat-card:hover .view-link {
        gap: 8px;
    }

    .view-link i {
        font-size: 10px;
    }

    /* Color themes */
    .card-cyan {
        background: linear-gradient(135deg, #00d4ff 0%, #0099cc 100%);
    }

    .card-orange {
        background: linear-gradient(135deg, #ffb347 0%, #ff8c42 100%);
    }

    .card-red {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
    }

    .card-green {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }

    .card-blue {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .card-pink {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .card-teal {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }

    .card-purple {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    @media (max-width: 1200px) {
        .cards-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .cards-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .stat-card {
            min-height: 130px;
            padding: 20px 16px;
        }

        .card-value {
            font-size: 30px;
        }

        .card-icon {
            width: 40px;
            height: 40px;
        }

        .card-icon i {
            font-size: 20px;
        }
    }

    @media (max-width: 480px) {
        .cards-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-header h3 {
            font-size: 22px;
        }
    }

    .post-inline-stats {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 6px;
        margin-top: 8px;
        color: #fff;
        font-size: 13px;
    }

    .post-inline-stats span {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .post-inline-stats small {
        font-size: 11px;
        opacity: 0.85;
    }

    .post-inline-stats strong {
        font-size: 16px;
        font-weight: 700;
    }

    .post-inline-stats .divider {
        opacity: 0.6;
    }
</style>

@section('content')

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h3>Welcome to the {{ auth()->user()->name }} Dashboard</h3>
        </div>

        <div class="cards-grid">
            <!-- Categories Card -->
            <a href="{{ route('category.index') }}" class="stat-card card-cyan">
                <div class="card-header">
                    <div class="card-label text-white">CATEGORIES</div>
                    <div class="card-icon">
                        <i class="fa-solid fa-folder"></i>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="card-value text-white">{{ $categoryTotal }}</div>
                    <div class="view-link text-white">
                        View Info <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </a>

            <!-- Subcategories Card -->
            <a href="{{ route('user.subscription.table') }}" class="stat-card card-orange">
                <div class="card-header">
                    <div class="card-label text-white">SUBSCRIPTIONS</div>
                    <div class="card-icon">
                        <i class="fa-solid fa-crown"></i>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="card-value text-white">{{ $subscriptionTotal }}</div>

                    {{-- here display --}}
                    <div class="post-inline-stats">
                        <span>
                            <small>Allowed Posts</small>
                            <strong>{{ $totalNoPosts }}</strong>
                        </span>

                        <span class="divider">|</span>

                        <span>
                            <small>Posted</small>
                            <strong>{{ $usedPosts }}</strong>
                        </span>

                        <span class="divider">|</span>

                        <span>
                            <small>Remaining</small>
                            <strong>{{ $remainingPosts }}</strong>
                        </span>
                    </div>


                    <div class="view-link mt-2 text-white">
                        View Info <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </a>


            <!-- Total Posts Card -->
            <a href="{{ route('blogs.index') }}" class="stat-card card-red">
                <div class="card-header">
                    <div class="card-label text-white">POSTS</div>
                    <div class="card-icon">
                        <i class="fa-solid fa-file-alt"></i>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="card-value text-white">{{ $blogsTotal }}</div>
                    <div class="view-link text-white">
                        View Info <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </a>

            <!-- Services/Approved Posts Card -->
            <a href="{{ route('blogs.index') }}" class="stat-card card-green">
                <div class="card-header">
                    <div class="card-label text-white">APPROVED POSTS</div>
                    <div class="card-icon">
                        <i class="fa-solid fa-check-circle"></i>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="card-value text-white">{{ $approvedPosts }}</div>
                    <div class="view-link text-white">
                        View Info <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </a>

            <!-- Pending Posts Card -->
            <a href="{{ route('blogs.index') }}" class="stat-card card-pink">
                <div class="card-header">
                    <div class="card-label text-white">PENDING POSTS</div>
                    <div class="card-icon">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="card-value text-white">{{ $pendingPosts }}</div>
                    <div class="view-link text-white">
                        View Info <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </a>

            <!-- Rejected Posts Card -->
            <a href="{{ route('blogs.index') }}" class="stat-card card-teal">
                <div class="card-header">
                    <div class="card-label text-white">REJECTED POSTS</div>
                    <div class="card-icon">
                        <i class="fa-solid fa-times-circle"></i>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="card-value text-white">{{ $rejectedPosts }}</div>
                    <div class="view-link text-white">
                        View Info <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- charts --}}

    <div class="row mt-5">
        <div class="col-xl-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Post chart</h6>
                    <div id="apexArea"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Post chart</h6>
                    <div id="apexPie"></div>
                </div>
                <!-- Totals below chart -->
                <div class="d-flex justify-content-around mb-2">
                    <div class="text-center">
                        <div><strong>Approved Posts:</strong> <span id="approvedTotal">{{ $approvedPosts }}</span></div>
                    </div>
                    <div class="text-center">
                        <div><strong>Rejected Posts:</strong> <span id="rejectedTotal">{{ $rejectedPosts }}</span></div>
                    </div>
                    <div class="text-center">
                        <div><strong>Pending Posts:</strong> <span id="pendingTotal">{{ $pendingPosts }}</span></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')

    <!-- Pass Laravel data to JS -->
    <script>
        var approvedPosts = @json($approvedPosts);
        var rejectedPosts = @json($rejectedPosts);
        var pendingPosts = @json($pendingPosts);

        var colors = {
            primary: "#6571ff",
            secondary: "#7987a1",
            success: "#05a34a",
            info: "#66d1d1",
            warning: "#fbbc06",
            danger: "#ff3366",
            light: "#e9ecef",
            dark: "#060c17",
            muted: "#7987a1",
            gridBorder: "rgba(77, 138, 240, .15)",
            bodyColor: "#000",
            cardBg: "#fff"
        }

        var fontFamily = "'Roboto', Helvetica, sans-serif";

        // --------------------- Area Chart ---------------------
        if ($('#apexArea').length) {
            // generate last 7 days labels
            function getLast7DaysData(value) {
                var data = [];
                for (var i = 6; i >= 0; i--) {
                    var date = new Date();
                    date.setDate(date.getDate() - i);
                    // using same value for each day (can replace with dynamic daily counts)
                    data.push([date.getTime(), value]);
                }
                return data;
            }

            var areaOptions = {
                chart: {
                    type: "area",
                    height: 300,
                    stacked: true,
                    foreColor: colors.bodyColor,
                    background: colors.cardBg,
                    toolbar: { show: false },
                },
                colors: [colors.primary, colors.danger, colors.warning],
                stroke: { curve: "smooth", width: 3 },
                dataLabels: { enabled: false },
                series: [
                    { name: 'Approved Posts', data: getLast7DaysData(approvedPosts) },
                    { name: 'Rejected Posts', data: getLast7DaysData(rejectedPosts) },
                    { name: 'Pending Posts', data: getLast7DaysData(pendingPosts) }
                ],
                xaxis: {
                    type: "datetime",
                    axisBorder: { color: colors.gridBorder },
                    axisTicks: { color: colors.gridBorder },
                    labels: { format: "dd MMM" }
                },
                yaxis: { min: 0, tickAmount: 4 },
                grid: { borderColor: colors.gridBorder },
                tooltip: { x: { format: "dd MMM yyyy" } },
                fill: { type: 'solid', opacity: [0.4, 0.25] },
                legend: {
                    show: true,
                    position: "top",
                    horizontalAlign: 'center',
                    fontFamily: fontFamily,
                    itemMargin: { horizontal: 8, vertical: 0 }
                }
            };

            var areaChart = new ApexCharts(document.querySelector("#apexArea"), areaOptions);
            areaChart.render();
        }

        // --------------------- Pie Chart ---------------------
        if ($('#apexPie').length) {
            var pieOptions = {
                chart: { height: 300, type: "pie", foreColor: colors.bodyColor, background: colors.cardBg, toolbar: { show: false } },
                colors: [colors.primary, colors.danger, colors.warning],
                stroke: { colors: ['rgba(0,0,0,0)'] },
                dataLabels: { enabled: false },
                legend: {
                    show: true,
                    position: "top",
                    horizontalAlign: 'center',
                    fontFamily: fontFamily,
                    itemMargin: { horizontal: 8, vertical: 0 }
                },
                series: [approvedPosts, rejectedPosts, pendingPosts],
                labels: ['Approved Posts', 'Rejected Posts', 'Pending Posts']
            };

            var pieChart = new ApexCharts(document.querySelector("#apexPie"), pieOptions);
            pieChart.render();
        }
    </script>

@endpush