<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peringatan Sampah Penuh - SmartBin UIN Bandung</title>
    <style>
        body {
            font-family: 'Segoe UI', Helvetica, Arial, sans-serif;
            background-color: #f1f5f9;
            margin: 0;
            padding: 20px 10px;
            color: #1e293b;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
        }
        .header {
            background: linear-gradient(135deg, #1E5C3A 0%, #287A4D 100%);
            padding: 24px 28px;
            color: #ffffff;
            text-align: left;
        }
        .header-title {
            font-size: 20px;
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.5px;
        }
        .header-subtitle {
            font-size: 11px;
            color: #a7f3d0;
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
        }
        .alert-banner {
            background-color: #fff1f2;
            border-left: 5px solid #e11d48;
            padding: 16px 20px;
            margin: 20px 24px;
            border-radius: 8px;
        }
        .alert-title {
            color: #9f1239;
            font-size: 14px;
            font-weight: bold;
            margin: 0 0 4px 0;
        }
        .alert-desc {
            color: #be123c;
            font-size: 12px;
            margin: 0;
            line-height: 1.5;
        }
        .content {
            padding: 0 24px 24px 24px;
        }
        .station-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 20px;
        }
        .station-code {
            display: inline-block;
            background-color: #e0f2fe;
            color: #0369a1;
            font-family: monospace;
            font-weight: bold;
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 6px;
            margin-bottom: 6px;
        }
        .station-name {
            font-size: 16px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 4px 0;
        }
        .station-loc {
            font-size: 12px;
            color: #64748b;
            margin: 0;
        }
        .table-capacity {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }
        .table-capacity th {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 700;
            text-align: left;
            padding: 10px 12px;
            border-bottom: 2px solid #e2e8f0;
        }
        .table-capacity td {
            padding: 10px 12px;
            border-bottom: 1px solid #e2e8f0;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 9999px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .badge-warning {
            background-color: #fef3c7;
            color: #92400e;
        }
        .badge-success {
            background-color: #dcfce7;
            color: #166534;
        }
        .btn-container {
            text-align: center;
            margin: 24px 0 16px 0;
        }
        .btn {
            display: inline-block;
            background-color: #287A4D;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 13px;
            box-shadow: 0 2px 8px rgba(40, 122, 77, 0.3);
        }
        .meta-info {
            font-size: 11px;
            color: #64748b;
            line-height: 1.6;
            border-top: 1px solid #e2e8f0;
            padding-top: 16px;
            margin-top: 20px;
        }
        .footer {
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 16px 24px;
            text-align: center;
            font-size: 11px;
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 class="header-title">SmartBin UIN Bandung</h1>
            <div class="header-subtitle">Pusat Peringatan & Monitoring Sampah Cerdas Kampus</div>
        </div>

        <!-- Alert Banner -->
        <div class="alert-banner">
            <div class="alert-title">PERINGATAN: Kapasitas Wadah Mencapai Batas Kritis</div>
            <p class="alert-desc">
                Satu atau lebih kompartemen tempat sampah telah terisi &ge; 85%. Mohon tim kebersihan kampus UIN segera melakukan pengosongan wadah.
            </p>
        </div>

        <div class="content">
            <!-- Station Details -->
            <div class="station-box">
                <span class="station-code">{{ $binData['station_code'] ?? 'STATION' }}</span>
                <h2 class="station-name">{{ $binData['name'] ?? 'SmartBin Stasiun' }}</h2>
                <p class="station-loc">{{ $binData['location_name'] ?? 'Kampus 1 UIN Sunan Gunung Djati Bandung' }}</p>
            </div>

            <!-- Capacity Table -->
            <table class="table-capacity">
                <thead>
                    <tr>
                        <th>Kompartemen Wadah</th>
                        <th>Keterisian</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $chambers = [
                            ['name' => 'Organik (Sisa Makanan)', 'pct' => (int)($binData['organik'] ?? 0)],
                            ['name' => 'Plastik (Botol / Kemasan)', 'pct' => (int)($binData['plastik'] ?? 0)],
                            ['name' => 'Kertas & Karton', 'pct' => (int)($binData['kertas'] ?? 0)],
                            ['name' => 'Logam & Kaca', 'pct' => (int)($binData['logam'] ?? 0)],
                        ];
                    @endphp

                    @foreach($chambers as $ch)
                        @php
                            $pct = $ch['pct'];
                            $badgeClass = $pct >= 85 ? 'badge-danger' : ($pct >= 70 ? 'badge-warning' : 'badge-success');
                            $statusText = $pct >= 85 ? 'Kritis (Penuh)' : ($pct >= 70 ? 'Hampir Penuh' : 'Normal');
                        @endphp
                        <tr>
                            <td><strong>{{ $ch['name'] }}</strong></td>
                            <td><strong>{{ $pct }}%</strong></td>
                            <td><span class="badge {{ $badgeClass }}">{{ $statusText }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Call to Action -->
            <div class="btn-container">
                <a href="https://www.google.com/maps/search/?api=1&query={{ $binData['latitude'] ?? -6.929824 }},{{ $binData['longitude'] ?? 107.718162 }}" class="btn" target="_blank">
                    Buka Rute Lokasi Stasiun di Google Maps &rarr;
                </a>
            </div>

            <!-- Metadata Info -->
            <div class="meta-info">
                <div><strong>Waktu Deteksi:</strong> {{ now()->setTimezone('Asia/Jakarta')->format('d M Y, H:i:s') }} WIB</div>
                <div><strong>Tipe Pemicu:</strong> {{ $triggerType === 'manual' ? 'Trigger Manual via Dashboard Admin' : 'Deteksi Otomatis Sensor IoT ESP32' }}</div>
                <div><strong>Dipicu Oleh:</strong> {{ $triggeredBy }}</div>
                <div><strong>Stasiun Koordinat:</strong> {{ $binData['latitude'] ?? '-6.929824' }}, {{ $binData['longitude'] ?? '107.718162' }}</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            Inovasi SmartBin • Universitas Islam Negeri Sunan Gunung Djati Bandung<br>
            Pesan ini dikirimkan secara otomatis oleh sistem notifikasi IoT SmartBin UIN Bandung.
        </div>
    </div>
</body>
</html>
