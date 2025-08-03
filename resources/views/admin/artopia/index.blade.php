@extends('admin.layouts.app')

@section('title', 'Artopia Management')

@section('styles')
{{-- Bootstrap 5.3 --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.5/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.5/sweetalert2.min.css">
{{-- Gaya kustom untuk tampilan yang lebih modern --}}
<style>
    .card-header-actions {
        display: flex;
        gap: 0.5rem;
    }
    .stats-card .icon {
        opacity: 0.3;
        transition: all 0.3s ease-in-out;
    }
    .stats-card:hover .icon {
        transform: scale(1.1);
        opacity: 0.5;
    }
    .form-filter {
        background-color: #f8f9fa;
        padding: 1.25rem;
        border-radius: 0.5rem;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
    .btn-group-sm .btn {
        padding: 0.25rem 0.5rem;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    {{-- Header Halaman dan Tombol Aksi --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Artopia Data Management</h1>
        <div class="card-header-actions">
            {{-- Tombol Export --}}
            <div class="btn-group">
                <a href="{{ route('admin.artopia.export') }}" class="btn btn-outline-success d-flex align-items-center">
                    <i class="fas fa-download me-2"></i> Export
                </a>
                <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('admin.artopia.export', ['status' => 'all']) }}">Export All</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('admin.artopia.export', ['status' => 'pending']) }}">Export Pending</a></li>
                    {{-- PERBAIKAN: value diubah ke lolos/gagal --}}
                    <li><a class="dropdown-item" href="{{ route('admin.artopia.export', ['status' => 'lolos']) }}">Export Lolos</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.artopia.export', ['status' => 'gagal']) }}">Export Gagal</a></li>
                </ul>
            </div>
            
            {{-- Tombol Kirim Email Massal --}}
            <button type="button" class="btn btn-primary d-flex align-items-center" style="margin-top: 1.0rem;" data-bs-toggle="modal" data-bs-target="#sendBulkEmailModal">
                <i class="fas fa-paper-plane me-2"></i> Kirim Email Massal
            </button>
        </div>
    </div>

    {{-- Kartu Statistik --}}
    <div class="row mb-4">
        {{-- Total --}}
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-primary shadow-sm h-100 py-2 stats-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:rgb(0, 255, 255);">Total Pendaftar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto icon"><i class="fas fa-users fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Pending --}}
        <div class="col-xl-3 col-md-6 mb-3">
             <div class="card border-left-warning shadow-sm h-100 py-2 stats-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto icon"><i class="fas fa-clock fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- PERBAIKAN: Kunci statistik diubah ke lolos/gagal --}}
        {{-- Lolos --}}
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-success shadow-sm h-100 py-2 stats-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:chartreuse">Lolos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['lolos'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto icon"><i class="fas fa-check-circle fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Gagal --}}
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-danger shadow-sm h-100 py-2 stats-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:rgb(238, 128, 128)">Gagal</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['gagal'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto icon"><i class="fas fa-times-circle fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Data --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pendaftar Artopia</h6>
        </div>
        <div class="card-body">
            {{-- Filter --}}
            <form method="GET" class="mb-4 form-filter">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="status" class="form-label">Filter by Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="lolos" {{ request('status') == 'lolos' ? 'selected' : '' }}>Lolos</option>
                            <option value="gagal" {{ request('status') == 'gagal' ? 'selected' : '' }}>Gagal</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="search" class="form-label">Search (Nama, NIM, Email, Booth, Kelompok)</label>
                        <input type="text" name="search" id="search" class="form-control" placeholder="Ketik untuk mencari..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3 d-flex">
                        <button type="submit" class="btn btn-info w-100 me-2"><i class="fas fa-filter me-1"></i>Filter</button>
                        <a href="{{ route('admin.artopia.index') }}" class="btn btn-secondary" title="Reset Filter"><i class="fas fa-sync-alt"></i></a>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap / Kelompok</th>
                            <th>NIM</th>
                            <th>Email</th>
                            <th>Nama Booth</th>
                            <th class="text-center">Status Seleksi</th>
                            <th class="text-center">Status Kirim Email</th>
                            <th class="text-center" style="width: 200px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $item)
                        <tr>
                            <td class="align-middle text-center">{{ $data->firstItem() + $index }}</td>
                            <td class="align-middle"><strong>{{ $item->nama_lengkap }}</strong><br><small class="text-muted">Kel: {{ $item->nama_kelompok ?? '-' }}</small></td>
                            <td class="align-middle">{{ $item->nim }}</td>
                            <td class="align-middle">{{ $item->email }}</td>
                            <td class="align-middle">{{ $item->nama_booth }}</td>
                            <td class="text-center align-middle">
                                @php
                                    $statusClass = ['lolos' => 'success', 'gagal' => 'danger', 'pending' => 'warning'][$item->status_seleksi] ?? 'secondary';
                                @endphp
                                <span class="badge rounded-pill bg-{{ $statusClass }}">{{ ucfirst($item->status_seleksi) }}</span>
                            </td>
                            <td class="text-center align-middle">
                                @if($item->status_kirim === 'Terkirim')
                                    <span class="badge rounded-pill bg-success">Terkirim</span>
                                @elseif($item->status_kirim === 'Terkirim (Pendaftaran)')
                                    <span class="badge rounded-pill bg-info text-dark">Pendaftaran</span>
                                @else
                                    <span class="badge rounded-pill bg-secondary">Belum Dikirim</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                <div class="btn-group btn-group-sm" role="group">
                                    {{-- Tombol View --}}
                                    <button type="button" class="btn btn-outline-info" title="View Details" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    {{-- Tombol Edit (selalu aktif untuk membuka modal) --}}
                                    <button type="button" class="btn btn-outline-warning" title="Update Status" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    {{-- Tombol Kirim Email Tunggal --}}
                                    <form class="d-inline" action="{{ route('admin.artopia.send-single-status-email', $item->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin mengirim email notifikasi ke {{ $item->nama_lengkap }}?')">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-primary" title="Kirim Email Notifikasi" {{ !in_array($item->status_seleksi, ['lolos', 'gagal']) || $item->status_kirim === 'Terkirim' ? 'disabled' : '' }}>
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </form>
                                    {{-- Tombol Hapus --}}
                                    <form class="d-inline" action="{{ route('admin.artopia.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                            {{-- Colspan disesuaikan menjadi 8 --}}
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-exclamation-triangle fa-2x mb-2 text-warning"></i>
                                <p class="mb-0">Tidak ada data ditemukan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $data->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

{{-- MODAL KIRIM EMAIL MASSAL --}}
<div class="modal fade" id="sendBulkEmailModal" tabindex="-1" aria-labelledby="sendEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.artopia.send-bulk-status-email') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="sendEmailModalLabel"><i class="fas fa-paper-plane me-2"></i>Kirim Email Notifikasi Massal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small">Sistem akan mengirim email notifikasi status (Lolos/Gagal) ke semua pendaftar yang statusnya sudah final tetapi emailnya belum pernah dikirim.</p>
                    <div class="mb-3">
                        <label for="status_seleksi_email" class="form-label"><strong>Kirim ke pendaftar dengan status:</strong></label>
                        <select class="form-select" name="status_type" required>
                            <option value="lolos">Hanya yang Lolos</option>
                            <option value="gagal">Hanya yang Gagal</option>
                            <option value="all">Keduanya (Lolos & Gagal)</option>
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

{{-- MODALS UNTUK SETIAP ITEM --}}
@foreach($data as $item)
    {{-- MODAL DETAIL --}}
    <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pendaftar - {{ $item->nama_lengkap }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Nama Kelompok:</strong> {{ $item->nama_kelompok ?? '-' }}</li>
                                <li class="list-group-item"><strong>Nama Lengkap:</strong> {{ $item->nama_lengkap }}</li>
                                <li class="list-group-item"><strong>NIM:</strong> {{ $item->nim }}</li>
                                <li class="list-group-item"><strong>Angkatan:</strong> {{ $item->angkatan }}</li>
                                <li class="list-group-item"><strong>Email:</strong> {{ $item->email }}</li>
                                <li class="list-group-item"><strong>ID Line:</strong> {{ $item->id_line }}</li>
                                <li class="list-group-item"><strong>Instagram:</strong> {{ $item->instagram }}</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Nama Booth:</strong> {{ $item->nama_booth }}</li>
                                <li class="list-group-item"><strong>Tanggal Booth:</strong> {{ $item->tanggal_booth }}</li>
                                <li class="list-group-item"><strong>Status:</strong> <span class="badge bg-{{ $item->status_seleksi == 'lolos' ? 'success' : ($item->status_seleksi == 'gagal' ? 'danger' : 'warning') }}">{{ ucfirst($item->status_seleksi) }}</span></li>
                                <li class="list-group-item"><strong>Catatan Admin:</strong> {{ $item->catatan_admin ?? '-' }}</li>
                                <li class="list-group-item"><strong>Terakhir Update:</strong> {{ $item->updated_at ? $item->updated_at->format('d M Y, H:i') : '-' }}</li>
                                <li class="list-group-item">
                                    <strong>Dokumen Pendukung:</strong>
                                    @if ($item->dokumen_pendukung)
                                        <a href="{{ asset('storage/' . $item->dokumen_pendukung) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1">
                                            <i class="fas fa-file-alt"></i> Lihat Dokumen
                                        </a>
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-12">
                            <h6>Deskripsi Booth:</h6>
                            <p class="text-muted" style="white-space: pre-wrap;">{{ $item->deskripsi_booth }}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.artopia.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Update Status: {{ $item->nama_lengkap }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        {{-- PERUBAHAN: Logika untuk menampilkan form atau pesan peringatan --}}
                        @if(in_array($item->status_seleksi, ['lolos', 'gagal']))
                            {{-- Tampilkan pesan jika status sudah final --}}
                            <div class="alert alert-warning">
                                <h4 class="alert-heading">Status Final!</h4>
                                <p>Status untuk pendaftar ini sudah <strong>{{ ucfirst($item->status_seleksi) }}</strong> dan tidak dapat diubah lagi.</p>
                                <hr>
                                <p class="mb-0">Anda dapat melihat catatan di halaman detail.</p>
                            </div>
                        @else
                            {{-- Tampilkan form jika status masih pending --}}
                            <div class="form-group mb-3">
                                <label for="status_seleksi_{{ $item->id }}" class="form-label">Status Seleksi</label>
                                <select name="status_seleksi" id="status_seleksi_{{ $item->id }}" class="form-select" required>
                                    {{-- Opsi 'pending' dihilangkan --}}
                                    <option value="lolos">Lolos</option>
                                    <option value="gagal">Gagal</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="catatan_admin_{{ $item->id }}" class="form-label">Catatan Admin (Opsional)</label>
                                <textarea name="catatan_admin" id="catatan_admin_{{ $item->id }}" class="form-control" rows="4">{{ $item->catatan_admin }}</textarea>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        {{-- Sembunyikan tombol 'Update' jika status sudah final --}}
                        @if(!in_array($item->status_seleksi, ['lolos', 'gagal']))
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
{{-- Bootstrap 5.3 JS Bundle --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection