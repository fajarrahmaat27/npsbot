<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-orange-50 p-8">
    <div class="max-w-7xl mx-auto space-y-10">
        
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h1 class="text-5xl font-black bg-gradient-to-r from-purple-600 via-pink-600 to-orange-600 bg-clip-text text-transparent">
                    Dashboard Survey
                </h1>
            </div>
            <p class="text-gray-600 text-lg">Analisis Kepuasan Responden</p>
        </div>

        <!-- Top Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            
            <!-- Total Responden Card -->
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 via-pink-600 to-orange-600 rounded-3xl blur-lg opacity-75 group-hover:opacity-100 transition duration-500 animate-pulse"></div>
                <div class="relative bg-gradient-to-br from-purple-600 via-pink-600 to-orange-600 rounded-3xl shadow-2xl overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
                    <div class="absolute bottom-0 left-0 w-64 h-64 bg-black/10 rounded-full -ml-32 -mb-32"></div>
                    
                    <div class="relative p-10">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 bg-white/20 backdrop-blur-xl rounded-2xl flex items-center justify-center shadow-xl">
                                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white/80 text-sm font-bold uppercase tracking-widest">Total Responden</p>
                                <p class="text-6xl font-black text-white">{{ $totalVisits }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 text-white/90">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm font-semibold">Data terkumpul</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Overall Summary Card -->
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-cyan-500 via-blue-500 to-indigo-600 rounded-3xl blur-lg opacity-75 group-hover:opacity-100 transition duration-500"></div>
                <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden h-full">
                    <div class="p-10">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-xl">
                                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm font-bold uppercase tracking-widest">Skor Keseluruhan</p>
                                <p class="text-6xl font-black bg-gradient-to-r from-cyan-600 to-blue-600 bg-clip-text text-transparent">
                                    {{ number_format(collect($questionCharts)->avg('avg'), 1) }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-1">
                            @php $overallAvg = collect($questionCharts)->avg('avg'); @endphp
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-7 h-7 {{ $i <= round($overallAvg) ? 'text-yellow-400' : 'text-gray-300' }} drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Overall Summary Chart -->
        <div class="mb-12">
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 rounded-3xl blur-lg opacity-50 group-hover:opacity-75 transition duration-500"></div>
                <div class="relative bg-white rounded-3xl shadow-2xl p-10">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center gap-3 mb-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h2 class="text-3xl font-black bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                                Distribusi Rating Keseluruhan
                            </h2>
                        </div>
                        <p class="text-gray-500">Akumulasi semua pertanyaan</p>
                    </div>

                    <div class="max-w-2xl mx-auto">
                        <div class="relative h-80">
                            <canvas id="chart-overall"></canvas>
                        </div>
                        
                        <!-- Legend Custom -->
                        <div class="flex justify-center gap-6 mt-8 flex-wrap">
                            @php
                                $colors = [
                                    ['from' => 'from-red-500', 'to' => 'to-red-600', 'text' => 'text-red-600', 'label' => '⭐ 1 Star'],
                                    ['from' => 'from-orange-500', 'to' => 'to-orange-600', 'text' => 'text-orange-600', 'label' => '⭐⭐ 2 Stars'],
                                    ['from' => 'from-yellow-400', 'to' => 'to-yellow-500', 'text' => 'text-yellow-600', 'label' => '⭐⭐⭐ 3 Stars'],
                                    ['from' => 'from-lime-500', 'to' => 'to-lime-600', 'text' => 'text-lime-600', 'label' => '⭐⭐⭐⭐ 4 Stars'],
                                    ['from' => 'from-emerald-500', 'to' => 'to-emerald-600', 'text' => 'text-emerald-600', 'label' => '⭐⭐⭐⭐⭐ 5 Stars']
                                ];
                            @endphp
                            @foreach($colors as $color)
                                <div class="flex items-center gap-2">
                                    <div class="w-4 h-4 bg-gradient-to-br {{ $color['from'] }} {{ $color['to'] }} rounded-full shadow-lg"></div>
                                    <span class="text-sm font-bold {{ $color['text'] }}">{{ $color['label'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Individual Charts Grid -->
        <div>
            <div class="text-center mb-8">
                <h2 class="text-3xl font-black bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-2">
                    Detail Per Pertanyaan
                </h2>
                <p class="text-gray-500">Breakdown rating untuk setiap aspek</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($questionCharts as $index => $chart)
                    @php
                        $gradients = [
                            ['from' => 'from-violet-500', 'to' => 'to-purple-600', 'hover' => 'from-violet-600 to-purple-600'],
                            ['from' => 'from-fuchsia-500', 'to' => 'to-pink-600', 'hover' => 'from-fuchsia-600 to-pink-600'],
                            ['from' => 'from-rose-500', 'to' => 'to-orange-600', 'hover' => 'from-rose-600 to-orange-600'],
                            ['from' => 'from-cyan-500', 'to' => 'to-blue-600', 'hover' => 'from-cyan-600 to-blue-600'],
                            ['from' => 'from-emerald-500', 'to' => 'to-teal-600', 'hover' => 'from-emerald-600 to-teal-600'],
                            ['from' => 'from-amber-500', 'to' => 'to-orange-600', 'hover' => 'from-amber-600 to-orange-600'],
                        ];
                        $gradient = $gradients[$index % count($gradients)];
                    @endphp
                    
                    <div class="group relative">
                        <div class="absolute -inset-1 bg-gradient-to-r {{ $gradient['hover'] }} rounded-3xl blur opacity-0 group-hover:opacity-30 transition duration-500"></div>
                        
                        <div class="relative bg-white rounded-3xl shadow-xl p-8 h-full transform group-hover:-translate-y-2 transition-all duration-500">
                            <!-- Question Header -->
                            <div class="flex items-start gap-4 mb-6">
                                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br {{ $gradient['from'] }} {{ $gradient['to'] }} rounded-2xl flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-300">
                                    <span class="text-white font-black text-xl">{{ $index + 1 }}</span>
                                </div>
                                <h3 class="text-sm font-bold text-gray-700 leading-relaxed pt-2">{{ $chart['text'] }}</h3>
                            </div>

                            <!-- Chart Area -->
                            <div class="relative mb-6 flex justify-center">
                                <div class="relative w-52 h-52 group-hover:scale-105 transition-transform duration-500">
                                    <canvas id="chart-{{ $chart['id'] }}"></canvas>
                                </div>
                            </div>

                            <!-- Average Score -->
                            <div class="text-center pt-6 border-t-2 border-gray-100">
                                <div class="inline-flex items-center gap-4 bg-gradient-to-r from-gray-50 to-gray-100 px-8 py-4 rounded-2xl shadow-inner">
                                    <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Rata-rata</p>
                                        <p class="text-4xl font-black bg-gradient-to-r {{ $gradient['from'] }} {{ $gradient['to'] }} bg-clip-text text-transparent">
                                            {{ number_format($chart['avg'], 1) }}
                                        </p>
                                    </div>
                                </div>
                                
                                <!-- Star Rating -->
                                <div class="flex justify-center gap-1 mt-4">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-6 h-6 {{ $i <= round($chart['avg']) ? 'text-yellow-400' : 'text-gray-300' }} drop-shadow-md transition-all duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const charts = @json($questionCharts);
    
    // Calculate overall data
    const overallData = [0, 0, 0, 0, 0];
    charts.forEach(q => {
        q.data.forEach((value, index) => {
            overallData[index] += value;
        });
    });
    
    // Overall Chart
    setTimeout(() => {
        new Chart(document.getElementById('chart-overall'), {
            type: 'bar',
            data: {
                labels: ['⭐ 1 Star', '⭐⭐ 2 Stars', '⭐⭐⭐ 3 Stars', '⭐⭐⭐⭐ 4 Stars', '⭐⭐⭐⭐⭐ 5 Stars'],
                datasets: [{
                    label: 'Jumlah Rating',
                    data: overallData,
                    backgroundColor: [
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(249, 115, 22, 0.8)',
                        'rgba(250, 204, 21, 0.8)',
                        'rgba(132, 204, 22, 0.8)',
                        'rgba(16, 185, 129, 0.8)'
                    ],
                    borderColor: [
                        'rgb(239, 68, 68)',
                        'rgb(249, 115, 22)',
                        'rgb(250, 204, 21)',
                        'rgb(132, 204, 22)',
                        'rgb(16, 185, 129)'
                    ],
                    borderWidth: 3,
                    borderRadius: 12,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.9)',
                        padding: 16,
                        titleFont: { size: 16, weight: 'bold' },
                        bodyFont: { size: 14 },
                        borderColor: 'rgba(255, 255, 255, 0.2)',
                        borderWidth: 2,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const value = context.parsed.y;
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `${value} responden (${percentage}%)`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            font: { size: 12, weight: 'bold' },
                            color: '#6B7280'
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { size: 12, weight: 'bold' },
                            color: '#6B7280'
                        }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeInOutQuart'
                }
            }
        });
    }, 200);
    
    // Individual Charts
    charts.forEach((q, index) => {
        setTimeout(() => {
            const ctx = document.getElementById(`chart-${q.id}`);
            
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['1★', '2★', '3★', '4★', '5★'],
                    datasets: [{
                        data: q.data,
                        backgroundColor: [
                            'rgba(239, 68, 68, 0.9)',
                            'rgba(249, 115, 22, 0.9)',
                            'rgba(250, 204, 21, 0.9)',
                            'rgba(132, 204, 22, 0.9)',
                            'rgba(16, 185, 129, 0.9)'
                        ],
                        borderWidth: 5,
                        borderColor: '#ffffff',
                        hoverOffset: 25,
                        hoverBorderWidth: 6
                    }]
                },
                options: { 
                    maintainAspectRatio: true,
                    responsive: true,
                    plugins: { 
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.95)',
                            padding: 16,
                            titleFont: { size: 15, weight: 'bold' },
                            bodyFont: { size: 14 },
                            borderColor: 'rgba(255, 255, 255, 0.3)',
                            borderWidth: 2,
                            displayColors: true,
                            boxPadding: 8,
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const value = context.parsed;
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return ` ${context.label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '65%',
                    animation: {
                        animateRotate: true,
                        animateScale: true,
                        duration: 1800,
                        easing: 'easeInOutQuart'
                    }
                }
            });
        }, 300 + (index * 150));
    });
</script>   