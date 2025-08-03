@extends('admin.layouts.app') 
@section('title', 'Ancient Management') 
@section('styles') 

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.5/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.5/sweetalert2.min.css">
<style> 
    .card-header-actions { 
        display: flex; 
        gap: 0.5rem; 
    } 
    .stats-card .icon { 
        opacity: 0.3; 
        transition: all 0.3s; 
    } 
    .stats-card:hover .icon { 
        transform: scale(1.1); 
        opacity: 0.6; 
    } 
    .form-filter { 
        background-color: #f8f9fa; 
        padding: 1rem; 
        border-radius: 0.5rem; 
    } 
    
    /* Layout fix untuk sidebar */ 
    .content-wrapper { 
        margin-left: 224px; /* Sesuaikan dengan lebar sidebar Anda */ 
        padding: 20px; 
    } 
    
    /* Fix untuk tombol actions */ 
    .action-buttons { 
        display: flex; 
        gap: 5px; 
        justify-content: center; 
        align-items: center; 
        flex-wrap: nowrap; 
    } 
    
    .action-buttons .btn { 
        min-width: 35px; 
        height: 35px; 
        padding: 6px 8px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
    } 
    
    .action-buttons form { 
        margin: 0; 
    } 
    
    @media (max-width: 768px) { 
        .content-wrapper { 
            margin-left: 0; 
        } 
    } 
</style> 
@endsection 

@section('content') 
<div class="content-wrapper"> 
    <div class="container-fluid"> 
        <div class="d-flex justify-content-between align-items-center mb-3"> 
            <h1 class="h3 text-gray-800">Ancient Program Management</h1> 
            <div class="card-header-actions"> 
                <div class="btn-group"> 
                    <a href="{{ route('admin.ancient.export') }}" class="btn btn-outline-success d-flex align-items-center"> 
                        <i class="fas fa-download me-2"></i> Export 
                    </a> 
                    <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"> 
                        <span class="visually-hidden">Toggle Dropdown</span> 
                    </button> 
                    <ul class="dropdown-menu dropdown-menu-end"> 
                        <li><a class="dropdown-item" href="{{ route('admin.ancient.export', ['status' => 'all']) }}">Export All</a></li> 
                        <li><hr class="dropdown-divider"></li> 
                        <li><a class="dropdown-item" href="{{ route('admin.ancient.export', ['status' => 'pending']) }}">Export Pending</a></li> 
                        <li><a class="dropdown-item" href="{{ route('admin.ancient.export', ['status' => 'lolos']) }}">Export Lolos</a></li> 
                        <li><a class="dropdown-item" href="{{ route('admin.ancient.export', ['status' => 'gagal']) }}">Export Gagal</a></li> 
                    </ul> 
                </div> 
                
                <button type="button" class="btn btn-primary d-flex align-items-center" style="margin-top: 1.0rem;" data-bs-toggle="modal" data-bs-target="#sendBulkEmailModal">
                        <i class="fas fa-paper-plane me-2"></i> Kirim Email Massal
                    </button>
            </div>
    </div>


        {{-- TAMBAHAN: MODAL KIRIM EMAIL MASSAL (diletakkan di akhir file) --}}
<div class="modal fade" id="sendBulkEmailModal" tabindex="-1" aria-labelledby="sendEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.ancient.send-bulk-status-email') }}" method="POST" onsubmit="return confirm('Anda akan mengirim email notifikasi massal. Lanjutkan?');">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="sendEmailModalLabel"><i class="fas fa-paper-plane me-2"></i>Kirim Email Notifikasi Massal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small">Sistem akan mengirim email notifikasi status (Lolos/Gagal) ke semua pendaftar yang statusnya sudah final tetapi emailnya belum pernah dikirim.</p>
                    <div class="mb-3">
                        <label for="status_type" class="form-label"><strong>Kirim ke pendaftar dengan status:</strong></label>
                        <select class="form-select" name="status_type" id="status_type" required>
                            <option value="all">Keduanya (Lolos & Gagal)</option>
                            <option value="lolos">Hanya yang Lolos</option>
                            <option value="gagal">Hanya yang Gagal</option>
                        </select>
                    </div>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Pendaftar yang status emailnya sudah "Terkirim" akan dilewati secara otomatis.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.innerHTML='<span class=\'spinner-border spinner-border-sm\'></span> Mengirim...';this.form.submit();">Kirim Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>

        <div class="row mb-4"> 
            <div class="col-xl-3 col-md-6 mb-3"> 
                <div class="card border-left-primary shadow-sm h-100 py-2 stats-card"> 
                    <div class="card-body"> 
                        <div class="row no-gutters align-items-center"> 
                            <div class="col me-2"> 
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:rgb(0, 255, 255);">Total Pendaftar</div> 
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] ?? 0 }}</div> 
                            </div> 
                            <div class="col-auto icon"> 
                                <i class="fas fa-users fa-2x text-gray-300"></i> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div> 
            <div class="col-xl-3 col-md-6 mb-3"> 
                <div class="card border-left-warning shadow-sm h-100 py-2 stats-card"> 
                    <div class="card-body"> 
                        <div class="row no-gutters align-items-center"> 
                            <div class="col me-2"> 
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending</div> 
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending'] ?? 0 }}</div> 
                            </div> 
                            <div class="col-auto icon"> 
                                <i class="fas fa-clock fa-2x text-gray-300"></i> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div> 
            <div class="col-xl-3 col-md-6 mb-3"> 
                <div class="card border-left-success shadow-sm h-100 py-2 stats-card"> 
                    <div class="card-body"> 
                        <div class="row no-gutters align-items-center"> 
                            <div class="col me-2"> 
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:chartreuse">Lolos (Accepted)</div> 
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['accepted'] ?? 0 }}</div> 
                            </div> 
                            <div class="col-auto icon"> 
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div> 
            <div class="col-xl-3 col-md-6 mb-3"> 
                <div class="card border-left-danger shadow-sm h-100 py-2 stats-card"> 
                    <div class="card-body"> 
                        <div class="row no-gutters align-items-center"> 
                            <div class="col me-2"> 
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:rgb(238, 128, 128)">Gagal (Rejected)</div> 
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['rejected'] ?? 0 }}</div> 
                            </div> 
                            <div class="col-auto icon"> 
                                <i class="fas fa-times-circle fa-2x text-gray-300"></i> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div> 

        <div class="card shadow-sm mb-4"> 
            <div class="card-header py-3"> 
                <h6 class="m-0 font-weight-bold text-primary">Data Pendaftar</h6> 
            </div> 
            <div class="card-body"> 
                <form method="GET" class="mb-4 form-filter"> 
                    <div class="row g-3 align-items-end"> 
                        <div class="col-md-3"> 
                            <label for="status" class="form-label">Status</label> 
                            <select name="status" id="status" class="form-select"> 
                                <option value="">Semua Status</option> 
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option> 
                                <option value="lolos" {{ request('status') == 'lolos' ? 'selected' : '' }}>Lolos</option> 
                                <option value="gagal" {{ request('status') == 'gagal' ? 'selected' : '' }}>Gagal</option> 
                            </select> 
                        </div> 
                        <div class="col-md-3"> 
                            <label for="lokasi" class="form-label">Lokasi</label> 
                            <select name="lokasi" id="lokasi" class="form-select"> 
                                <option value="">Semua Lokasi</option> 
                                <option value="Tangerang" {{ request('lokasi') == 'Tangerang' ? 'selected' : '' }}>Tangerang</option> 
                                <option value="Sukabumi" {{ request('lokasi') == 'Sukabumi' ? 'selected' : '' }}>Sukabumi</option> 
                            </select> 
                        </div> 
                        <div class="col-md-4"> 
                            <label for="search" class="form-label">Cari Nama/NIM/Email</label> 
                            <input type="text" name="search" id="search" class="form-control" placeholder="Ketik untuk mencari..." value="{{ request('search') }}"> 
                        </div> 
                        <div class="col-md-2 d-flex"> 
                            <button type="submit" class="btn btn-info w-100 me-2">Filter</button> 
                            <a href="{{ route('admin.ancient.index') }}" class="btn btn-secondary" title="Reset Filter"><i class="fas fa-sync-alt"></i></a> 
                        </div> 
                    </div> 
                </form> 

                <div class="table-responsive"> 
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0"> 
                        <thead class="table-light"> 
                            <tr> 
                                <th>No</th> 
                                <th>Nama Lengkap</th> 
                                <th>NIM</th> 
                                <th>Email</th> 
                                <th>Lokasi</th> 
                                <th class="text-center">Status Seleksi</th> 
                                <th class="text-center">Status Kirim</th> 
                                <th class="text-center">Actions</th> 
                            </tr> 
                        </thead> 
                        <tbody> 
                            @forelse($data as $index => $item) 
                            <tr id="row-{{ $item->id }}"> 
                                <td class="align-middle">{{ $data->firstItem() + $index }}</td> 
                                <td class="align-middle"> 
                                    <strong>{{ $item->nama_lengkap }}</strong><br> 
                                    <small class="text-muted">Angkatan: {{ $item->angkatan }}</small> 
                                </td> 
                                <td class="align-middle">{{ $item->nim }}</td> 
                                <td class="align-middle">{{ $item->email }}</td> 
                                <td class="align-middle">{{ $item->lokasi_pilihan }}</td> 
                                <td class="text-center align-middle"> 
                                    @php 
                                        $statusClass = [ 
                                            'lolos' => 'success', 
                                            'gagal' => 'danger', 
                                            'pending' => 'warning', 
                                        ][$item->status_seleksi] ?? 'secondary'; 
                                    @endphp 
                                    <span class="badge rounded-pill bg-{{ $statusClass }}">{{ ucfirst($item->status_seleksi) }}</span> 
                                </td> 
                                <td class="text-center align-middle status-kirim-cell"> 
                                    @if($item->isSudahKirim()) 
                                        <span class="badge bg-success">Terkirim</span> 
                                    @else 
                                        <span class="badge bg-secondary">Belum Dikirim</span> 
                                    @endif 
                                </td> 
                                <td class="text-center align-middle"> 
                                    <div class="action-buttons"> 
                                        <button type="button" class="btn btn-outline-info btn-sm" title="View Details" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}"> 
                                            <i class="fas fa-eye"></i> 
                                        </button> 
                                        
                                        <button type="button" class="btn btn-outline-warning btn-sm" title="Edit Status" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}"> 
                                            <i class="fas fa-edit"></i> 
                                        </button> 
                                        
                                        @if($item->canSendEmail()) 
                                        <form class="d-inline" action="{{ route('admin.ancient.send-single-email', $item->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin mengirim email notifikasi ke {{ $item->nama_lengkap }}?')">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary" title="Kirim Email Notifikasi"
                                                {{-- Tombol disabled jika status bukan lolos/gagal ATAU email sudah terkirim --}}
                                                {{ !$item->canSendEmail() || $item->isSudahKirim() ? 'disabled' : '' }}>
                                                <i class="fas fa-paper-plane"></i>
                                            </button>
                                        </form>
                                        @endif 
                                        
                                         <form class="d-inline" action="{{ route('admin.ancient.destroy', $item->id) }}" method="POST" onsubmit="return confirm('ANDA YAKIN ingin menghapus data {{ $item->nama_lengkap }} secara permanen?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Delete Data">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div> 
                                </td> 
                            </tr> 
                            @empty 
                            <tr> 
                                <td colspan="8" class="text-center py-4"> 
                                    <i class="fas fa-exclamation-triangle fa-2x mb-2"></i> 
                                    <p>Tidak ada data yang ditemukan.</p> 
                                </td> 
                            </tr> 
                            @endforelse 
                        </tbody> 
                    </table> 
                </div> 

                <div class="d-flex justify-content-center mt-4"> 
                    {{ $data->appends(request()->query())->links() }} 
                </div> 
            </div> 
        </div> 
    </div> 
</div> 

<!-- Detail Modals --> 
@foreach($data as $item) 
    <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $item->id }}" aria-hidden="true"> 
        <div class="modal-dialog modal-lg"> 
            <div class="modal-content"> 
                <div class="modal-header"> 
                    <h5 class="modal-title" id="detailModalLabel{{ $item->id }}">Detail Pendaftar - {{ $item->nama_lengkap }}</h5> 
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
                </div> 
                <div class="modal-body"> 
                    <div class="row"> 
                        <div class="col-md-6 mb-3"> 
                            <ul class="list-group"> 
                                <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Nama:</strong> {{ $item->nama_lengkap }}</li> 
                                <li class="list-group-item d-flex justify-content-between align-items-center"><strong>NIM:</strong> {{ $item->nim }}</li> 
                                <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Angkatan:</strong> {{ $item->angkatan }}</li> 
                                <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Email:</strong> {{ $item->email }}</li> 
                            </ul> 
                        </div> 
                        <div class="col-md-6 mb-3"> 
                             <ul class="list-group"> 
                                <li class="list-group-item d-flex justify-content-between align-items-center"><strong>ID Line:</strong> {{ $item->id_line }}</li> 
                                <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Instagram:</strong> {{ $item->instagram }}</li> 
                                <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Lokasi:</strong> {{ $item->lokasi_pilihan }}</li> 
                                <li class="list-group-item d-flex justify-content-between align-items-center"> 
                                    <strong>Status:</strong> 
                                    @php 
                                        $statusClass = [ 
                                            'lolos' => 'success', 
                                            'gagal' => 'danger', 
                                            'pending' => 'warning', 
                                        ][$item->status_seleksi] ?? 'secondary'; 
                                    @endphp 
                                    <span class="badge rounded-pill bg-{{ $statusClass }}">{{ ucfirst($item->status_seleksi) }}</span> 
                                </li> 
                            </ul> 
                        </div> 
                        <div class="col-12"> 
                            <strong>Catatan Admin:</strong> 
                            <p class="text-muted border p-2 rounded bg-light">{{ $item->catatan_admin ?? 'Tidak ada catatan.' }}</p> 
                            <strong>Dokumen Esai:</strong> 
                            @if ($item->dokumen_esai) 
                                <a href="{{ asset('storage/' . $item->dokumen_esai) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1"> 
                                    <i class="fas fa-file-pdf me-1"></i> Lihat Esai 
                                </a> 
                            @else 
                                <span class="text-muted">Tidak ada file</span> 
                            @endif 
                        </div> 
                    </div> 
                </div> 
                <div class="modal-footer"> 
                    <small class="text-muted me-auto">Terakhir update: {{ $item->updated_at->diffForHumans() }}</small> 
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
                </div> 
            </div> 
        </div> 
    </div> 

    <!-- Edit Modal --> 
    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                {{-- MODIFIKASI: Form dengan konfirmasi onsubmit --}}
                <form action="{{ route('admin.ancient.update', $item->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin mengubah status pendaftar ini?');">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Update Status: {{ $item->nama_lengkap }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Logika untuk menampilkan form atau pesan peringatan --}}
                        @if($item->canEditStatus())
                            <div class="mb-3">
                                <label for="status_seleksi_{{ $item->id }}" class="form-label">Status Seleksi</label>
                                <select name="status_seleksi" id="status_seleksi_{{ $item->id }}" class="form-select">
                                    <option value="lolos" {{ $item->status_seleksi == 'lolos' ? 'selected' : '' }}>Lolos</option>
                                    <option value="gagal" {{ $item->status_seleksi == 'gagal' ? 'selected' : '' }}>Gagal</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="catatan_admin_{{ $item->id }}" class="form-label">Catatan Admin</label>
                                <textarea name="catatan_admin" id="catatan_admin_{{ $item->id }}" class="form-control" rows="3">{{ $item->catatan_admin }}</textarea>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Status pendaftar ini sudah <strong>{{ ucfirst($item->status_seleksi) }}</strong> dan tidak dapat diubah lagi.
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        @if($item->canEditStatus())
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
@endsection 

@section('scripts') 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script> 
document.addEventListener('DOMContentLoaded', function () { 
    // Handle send email buttons 
    document.querySelectorAll('.btn-send-email').forEach(link => { 
        link.addEventListener('click', function (e) { 
            e.preventDefault(); // Mencegah navigasi default 
            
            const registrationId = this.dataset.id; 
            const url = this.href; 
            
            // Tampilkan loading 
            Swal.fire({ 
                title: 'Mengirim email...', 
                text: 'Mohon tunggu sebentar.', 
                allowOutsideClick: false, 
                showConfirmButton: false, 
                didOpen: () => { 
                    Swal.showLoading(); 
                } 
            }); 

            // Gunakan fetch dengan header yang benar 
            fetch(url, { 
                method: 'GET', 
                headers: { 
                    'X-Requested-With': 'XMLHttpRequest', 
                    'Accept': 'application/json', 
                    'Content-Type': 'application/json', 
                }, 
                credentials: 'same-origin' 
            }) 
            .then(response => { 
                if (!response.ok) { 
                    throw new Error(`HTTP error! status: ${response.status}`); 
                } 
                return response.json(); 
            }) 
            .then(data => { 
                Swal.close(); 
                
                if (data.success) { 
                    // Tampilkan success alert 
                    Swal.fire({ 
                        icon: 'success', 
                        title: 'Berhasil!', 
                        text: data.message, 
                        timer: 3000, 
                        showConfirmButton: false 
                    }); 

                     const bulkEmailForm = document.getElementById('bulk-status-email-form'); 
    if (bulkEmailForm) { 
        bulkEmailForm.addEventListener('submit', function(e) { 
            e.preventDefault(); // Mencegah form submit secara langsung 

            const selectedStatus = document.getElementById('status_seleksi_bulk').selectedOptions[0].text; 

            Swal.fire({ 
                title: 'Konfirmasi Pengiriman', 
                html: `Anda yakin ingin mengirim email massal ke pendaftar dengan status <b>${selectedStatus}</b>?<br><small>Email hanya akan dikirim ke mereka yang belum pernah menerima email status.</small>`, 
                icon: 'warning', 
                showCancelButton: true, 
                confirmButtonColor: '#3085d6', 
                cancelButtonColor: '#d33', 
                confirmButtonText: 'Ya, Kirim Sekarang!', 
                cancelButtonText: 'Batal' 
            }).then((result) => { 
                if (result.isConfirmed) { 
                    // Tampilkan loading sebelum submit 
                    Swal.fire({ 
                        title: 'Mengirim...', 
                        text: 'Proses pengiriman email massal sedang berjalan.', 
                        allowOutsideClick: false, 
                        didOpen: () => { 
                            Swal.showLoading(); 
                        } 
                    }); 
                    // Lanjutkan submit form 
                    e.target.submit(); 
                } 
            }); 
        }); 
    } 
                    
                    // Update status kirim di tabel 
                    const statusCell = document.querySelector(`#row-${registrationId} .status-kirim-cell`); 
                    if (statusCell) { 
                        statusCell.innerHTML = '<span class="badge bg-success">Terkirim</span>'; 
                        console.log('Status cell updated for registration ID:', registrationId); 
                    } else { 
                        console.error('Status cell not found for registration ID:', registrationId); 
                    } 
                    
                    // Update button text jika perlu 
                    const buttonText = document.querySelector(`#row-${registrationId} .btn-send-email`); 
                    if (buttonText) { 
                        buttonText.title = 'Kirim Email Lagi'; 
                    } 
                } else { 
                    // Tampilkan error alert 
                    Swal.fire({ 
                        icon: 'error', 
                        title: 'Gagal!', 
                        text: data.message || 'Terjadi kesalahan saat mengirim email.', 
                        showConfirmButton: true 
                    }); 
                } 
            }) 
            .catch(error => { 
                Swal.close(); 
                console.error('Error:', error); 
                
                Swal.fire({ 
                    icon: 'error', 
                    title: 'Error!', 
                    text: 'Terjadi kesalahan pada sistem. Silakan coba lagi.', 
                    showConfirmButton: true 
                }); 
            }); 
        }); 
    }); 

    // Optional: Handle flash messages from server 
    @if(session('success')) 
        Swal.fire({ 
            icon: 'success', 
            title: 'Berhasil!', 
            text: '{{ session('success') }}', 
            timer: 3000, 
            showConfirmButton: false 
        }); 
    @endif 

    @if(session('error')) 
        Swal.fire({ 
            icon: 'error', 
            title: 'Error!', 
            text: '{{ session('error') }}', 
            showConfirmButton: true 
        }); 
    @endif 
}); 
</script> 
@endsection