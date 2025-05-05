<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laporan Sampah - Cleansweep')</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #81C974;
            padding: 15px;
            color: white;
            display: flex;
            align-items: center;
        }
        .header img {
            width: 40px;
            height: 40px;
            margin-right: 15px;
        }
        .profile-section {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .profile-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #81C974;
        }
        .report-button {
            background-color: #81C974;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th {
            background-color: #81C974;
            color: black;
            padding: 10px;
            text-align: left;
        }
        td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 250px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 4px;
            margin-top: 2px;
        }
        
        .dropdown-content a {
            color: #000;
            padding: 8px 16px;
            text-decoration: none;
            display: block;
            border-bottom: 1px solid #eee;
        }

        .dropdown-content a:last-child {
            border-bottom: none;
        }
        
        .dropdown-content a:hover {
            background-color: #f8f9fa;
        }
        
        .status-description {
            font-size: 12px;
            color: #666;
            margin-top: 4px;
        }

        .action-button {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 200px;
        }

        .action-button:after {
            content: '▼';
            margin-left: 8px;
            font-size: 12px;
        }

        .status-pending { color: #856404; background-color: #fff3cd; }
        .status-in-progress { color: #004085; background-color: #cce5ff; }
        .status-resolved { color: #155724; background-color: #d4edda; }
        .submit-button {
            background-color: #81C974;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">CleanSweep</a>
                <div class="d-flex gap-2">
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-link text-white text-decoration-none dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('auth.pengelola.logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light">Sign In</a>
                        <a href="{{ route('register') }}" class="btn btn-light">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    
    @push('styles')
    <style>
        .dropdown-menu {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .dropdown-item {
            padding: 0.5rem 1rem;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #4B7F52;
        }
        
        .btn-link {
            color: white;
            text-decoration: none;
        }
        
        .btn-link:hover {
            color: rgba(255, 255, 255, 0.8);
        }
    </style>
    @endpush    
    <div style="padding: 20px;">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Lokasi</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Tanggal Penugasan</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wasteReports as $report)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $report->location }}</td>
                    <td>{{ $report->description }}</td>
                    <td>{{ $report->created_at->format('d F Y') }}</td>
                    <td>
                        @if($report->status !== 'pending')
                        <input type="date" 
                               class="form-control" 
                               style="width: 150px; padding: 4px 8px; border: 1px solid #ddd; border-radius: 4px;" 
                               value="{{ $report->dispatch_date ? $report->dispatch_date->format('Y-m-d') : '' }}"
                               onchange="updateDates({{ $report->id }}, 'dispatch_date', this.value)"
                               id="dispatchDate{{ $report->id }}"
                               {{ $report->status === 'resolved' ? 'readonly' : '' }}
                               placeholder="Pilih tanggal">
                        @else
                        -
                        @endif
                    </td>
                    <td>
                        @if($report->status === 'resolved')
                        <input type="date" 
                               class="form-control" 
                               style="width: 150px; padding: 4px 8px; border: 1px solid #ddd; border-radius: 4px;" 
                               value="{{ $report->completion_date ? $report->completion_date->format('Y-m-d') : '' }}"
                               onchange="updateDates({{ $report->id }}, 'completion_date', this.value)"
                               id="completionDate{{ $report->id }}"
                               placeholder="Pilih tanggal">
                        @else
                        -
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="action-button status-{{ str_replace('_', '-', $report->status) }}">
                                {{ ucfirst(str_replace('_', ' ', $report->status)) }}
                            </button>
                            <div class="dropdown-content">
                                <form id="statusForm{{ $report->id }}" action="{{ route('waste-reports.update', $report) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="{{ $report->status }}">
                                    <input type="hidden" name="dispatch_date" value="{{ $report->dispatch_date }}">
                                    <input type="hidden" name="completion_date" value="{{ $report->completion_date }}">
                                    <a href="#" class="status-option" onclick="event.preventDefault(); selectStatus(this, 'pending', {{ $report->id }})">
                                        Pending
                                        <div class="status-description">Laporan baru, menunggu penanganan.</div>
                                    </a>
                                    <a href="#" class="status-option" onclick="event.preventDefault(); selectStatus(this, 'in_progress', {{ $report->id }})">
                                        In Progress
                                        <div class="status-description">Laporan sedang ditangani.</div>
                                    </a>
                                    <a href="#" class="status-option" onclick="event.preventDefault(); selectStatus(this, 'resolved', {{ $report->id }})">
                                        Resolved
                                        <div class="status-description">Laporan telah selesai ditangani.</div>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="entry-form">
            <h3>Entry Tindak Lanjut</h3>
            <button onclick="submitAllChanges()" class="submit-button" style="height: 50px; font-size: 18px; font-weight: bold;">
                <img src="{{ asset('images/verif.png') }}" alt="verif" style="width: 50px; height: 50px;">
                Simpan
            </button>
        </div>
    </div>

    <script>
    // Store temporary changes
    let statusChanges = {};
    let dateChanges = {};

    function updateDates(reportId, dateType, value) {
        if (!dateChanges[reportId]) {
            dateChanges[reportId] = {};
        }
        dateChanges[reportId][dateType] = value;
        
        const form = document.getElementById('statusForm' + reportId);
        const hiddenInput = form.querySelector(`input[name="${dateType}"]`);
        if (hiddenInput) {
            hiddenInput.value = value;
        }
    }

    function selectStatus(element, status, reportId) {
        const button = element.closest('.dropdown').querySelector('.action-button');
        const form = document.getElementById('statusForm' + reportId);
        
        // Store the status change temporarily
        statusChanges[reportId] = {
            form: form,
            status: status
        };
        
        // Update button text and class
        const statusText = status.charAt(0).toUpperCase() + status.slice(1).replace('_', ' ');
        button.textContent = statusText;
        button.className = 'action-button status-' + status.replace('_', '-');
        
        // Remove selected class from all options
        const allOptions = element.closest('.dropdown-content').querySelectorAll('.status-option');
        allOptions.forEach(option => option.classList.remove('selected'));
        
        // Add selected class to clicked option
        element.classList.add('selected');
        
        // Show/hide date inputs based on status
        const dispatchDateInput = document.getElementById('dispatchDate' + reportId);
        const completionDateInput = document.getElementById('completionDate' + reportId);
        const dispatchDateCell = dispatchDateInput ? dispatchDateInput.closest('td') : null;
        const completionDateCell = completionDateInput ? completionDateInput.closest('td') : null;
    
        if (dispatchDateCell) {
            if (status === 'pending') {
                dispatchDateCell.innerHTML = '-';
            } else {
                // Show dispatch date input for both in_progress and resolved
                dispatchDateCell.innerHTML = `
                    <input type="date" 
                           class="form-control" 
                           style="width: 150px; padding: 4px 8px; border: 1px solid #ddd; border-radius: 4px;" 
                           value="${dateChanges[reportId]?.dispatch_date || ''}"
                           onchange="updateDates(${reportId}, 'dispatch_date', this.value)"
                           id="dispatchDate${reportId}"
                           ${status === 'resolved' ? 'readonly' : ''}
                           placeholder="Pilih tanggal">
                `;
            }
        }
    
        if (completionDateCell) {
            if (status === 'resolved') {
                // Get the existing completion date from the form or database
                const existingDate = form.querySelector('input[name="completion_date"]').value || 
                               (document.getElementById('completionDate' + reportId)?.value || '');
                
                // Show completion date input immediately when resolved is selected
                completionDateCell.innerHTML = `
                    <input type="date" 
                           class="form-control" 
                           style="width: 150px; padding: 4px 8px; border: 1px solid #ddd; border-radius: 4px;" 
                           value="${existingDate}"
                           onchange="updateDates(${reportId}, 'completion_date', this.value)"
                           id="completionDate${reportId}"
                           placeholder="Pilih tanggal">
                `;
            } else {
                completionDateCell.innerHTML = '-';
            }
        }
        
        // Close the dropdown
        element.closest('.dropdown-content').style.display = 'none';
    }

    function submitAllChanges() {
        // Get all reports that have changes
        const reportIds = new Set([
            ...Object.keys(statusChanges),
            ...Object.keys(dateChanges)
        ]);
        
        const promises = [];
        
        reportIds.forEach(reportId => {
            const form = document.getElementById('statusForm' + reportId);
            const formData = new FormData(form);
            
            // Add status if changed
            if (statusChanges[reportId]) {
                formData.set('status', statusChanges[reportId].status);
            }
            
            // Add dates if changed
            if (dateChanges[reportId]) {
                if (dateChanges[reportId].dispatch_date) {
                    formData.set('dispatch_date', dateChanges[reportId].dispatch_date);
                }
                if (dateChanges[reportId].completion_date) {
                    formData.set('completion_date', dateChanges[reportId].completion_date);
                }
            }
            
            promises.push(
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
            );
        });
    
        // If there are changes, submit them
        if (promises.length > 0) {
            Promise.all(promises)
                .then(() => {
                    // Clear all changes
                    statusChanges = {};
                    dateChanges = {};
                    // Reload the page to show updated data
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error updating reports:', error);
                });
        }
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdowns = document.querySelectorAll('.dropdown-content');
        dropdowns.forEach(dropdown => {
            if (!event.target.closest('.dropdown')) {
                dropdown.style.display = 'none';
            }
        });
    });

    // Toggle dropdown visibility
    document.querySelectorAll('.action-button').forEach(button => {
        button.addEventListener('click', function(event) {
            event.stopPropagation();
            const dropdown = this.nextElementSibling;
            const allDropdowns = document.querySelectorAll('.dropdown-content');
            
            // Close all other dropdowns
            allDropdowns.forEach(d => {
                if (d !== dropdown) {
                    d.style.display = 'none';
                }
            });
            
            // Toggle current dropdown
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });
    });
    </script>
</body>
</html>