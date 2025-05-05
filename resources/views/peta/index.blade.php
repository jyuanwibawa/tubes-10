<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bandung Waste Management Sites</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />

    <style>
        #map {
            height: 500px;
            width: 100%;
            border-radius: 8px;
            position: relative;
            z-index: 1;
            background-color: #f8f9fa;
        }

        .card {
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .site-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .list-group-item {
            cursor: pointer;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
        }

        .legend {
            padding: 10px;
            background: white;
            border-radius: 5px;
            margin-top: 10px;
            border: 1px solid #dee2e6;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            border-radius: 50%;
        }

        .tpa-color {
            background-color: #dc3545;
        }

        .tps-color {
            background-color: #0d6efd;
        }
    </style>
</head>

<body>
    <div class="container my-4">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">Bandung Waste Management Sites</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">TPA & TPS Locations</h5>
                        <div id="map"></div>
                        <div class="legend">
                            <div class="legend-item">
                                <div class="legend-color tpa-color"></div>
                                <div>TPA (Tempat Pembuangan Akhir)</div>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color tps-color"></div>
                                <div>TPS (Tempat Penampungan Sementara)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Lokasi</h5>
                        <div class="site-list">
                            <ul class="list-group" id="sitesList">
                                <!-- Akan diisi oleh JavaScript -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Leaflet JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>

    <script>
        const sitesData = @json($collectionPoints);

        document.addEventListener('DOMContentLoaded', function() {
            const map = L.map('map').setView([-6.917464, 107.619123], 11);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                maxZoom: 19
            }).addTo(map);

            const markers = [];

            sitesData.forEach((site, i) => {
                const markerColor = site.type === "TPA" ? "#dc3545" : "#0d6efd";

                const siteIcon = L.divIcon({
                    html: `<div style="background-color: ${markerColor}; color: white; border-radius: 50%; width: 24px; height: 24px; display: flex; justify-content: center; align-items: center; font-weight: bold; border: 2px solid white;">${i+1}</div>`,
                    className: 'custom-div-icon',
                    iconSize: [30, 30],
                    iconAnchor: [15, 15]
                });

                const marker = L.marker([site.lat, site.lng], {
                    icon: siteIcon,
                    title: site.name
                }).addTo(map);

                marker.bindPopup(`
                    <div>
                        <h6 class="mb-1"><strong>${site.name}</strong></h6>
                        <p class="mb-1">
                            <strong>Tipe:</strong> ${site.type}<br>
                            <strong>Latitude:</strong> ${site.lat}<br>
                            <strong>Longitude:</strong> ${site.lng}<br>
                            <strong>Deskripsi:</strong> ${site.description}
                        </p>
                    </div>
                `);

                markers.push(marker);
            });

            const sitesList = document.getElementById("sitesList");
            sitesData.forEach((site, i) => {
                const li = document.createElement("li");
                li.className = "list-group-item";

                const badgeClass = site.type === "TPA" ? "bg-danger" : "bg-primary";

                li.innerHTML = `
                    <div>
                        <h6 class="mb-1">${i + 1}. ${site.name}</h6>
                        <p class="mb-1">
                            <span class="badge ${badgeClass}">${site.type}</span><br>
                            <strong>Latitude:</strong> ${site.lat}<br>
                            <strong>Longitude:</strong> ${site.lng}<br>
                            <strong>Deskripsi:</strong> ${site.description}
                        </p>
                    </div>
                `;

                li.addEventListener("click", () => {
                    map.setView([site.lat, site.lng], 16);
                    markers[i].openPopup();
                });

                sitesList.appendChild(li);
            });
        });
    </script>
</body>

</html>