@extends('admin.layouts.app')

@section('title', 'Email Management')

@push('styles')
<style>
    /* Variabel Warna untuk konsistensi */
    :root {
        --purple-main: #865794;
        --purple-light: #f4eff6;
        --green-main: #28a745;
        --green-light: #eaf6ec;
        --yellow-main: #ffc107;
        --yellow-light: #fff8e1;
        --red-main: #dc3545;
        --red-light: #fdeaea;
        --gray-text: #6c757d;
        --border-color: #e9ecef;
        --card-bg: #ffffff;
        --blue-main: #007bff;
    }

    /* Styling Kartu Utama Program */
    .card.card-program {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.05);
        overflow: hidden; /* Penting untuk border-left */
        border-left: 5px solid;
    }
    
    .card-program.card-artopia { border-color: var(--purple-main); }
    .card-program.card-ancient { border-color: var(--blue-main); }

    .card-program .card-header {
        background-color: var(--card-bg);
        border-bottom: 1px solid var(--border-color);
        font-size: 1.25rem;
        font-weight: 600;
    }
    
    .card-program.card-artopia .card-header { color: var(--purple-main); }
    .card-program.card-ancient .card-header { color: var(--blue-main); }

    /* Styling Accordion yang Modern */
    .accordion-item {
        border: 1px solid var(--border-color);
        border-radius: 0.5rem !important;
        margin-bottom: 1rem;
        transition: box-shadow 0.2s ease;
    }

    .accordion-item:not(:first-of-type) {
        border-top: 1px solid var(--border-color);
    }
    
    .accordion-item:last-of-type {
        margin-bottom: 0;
    }
    
    .accordion-item:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.07);
    }

    .accordion-header .accordion-button {
        border-radius: 0.5rem !important;
        background-color: #f8f9fa;
        font-weight: 500;
        color: #343a40;
    }

    .accordion-button:not(.collapsed) {
        color: #000;
        background-color: #f1f1f1;
        box-shadow: none;
    }
    
    .accordion-button:focus {
        box-shadow: none;
        border-color: var(--purple-main);
    }

    /* Styling Badge Status */
    .status-badge {
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0.4em 0.8em;
    }
    .badge-pending { background-color: var(--yellow-light); color: var(--yellow-main); border: 1px solid var(--yellow-main); }
    .badge-accepted { background-color: var(--green-light); color: var(--green-main); border: 1px solid var(--green-main); }
    .badge-rejected { background-color: var(--red-light); color: var(--red-main); border: 1px solid var(--red-main); }

    /* Styling Kotak Pratinjau Email */
    .template-preview {
        background-color: #f8f9fa;
        border: 1px solid var(--border-color);
        border-radius: 0.375rem;
        padding: 1rem;
        margin-top: 0.5rem;
        margin-bottom: 1.5rem;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.04);
    }
    .template-preview strong {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--gray-text);
        font-weight: 500;
    }

    /* Styling Form & Tombol */
    .form-label {
        font-weight: 500;
        color: #495057;
    }
    .form-group, .form-floating {
        margin-bottom: 1.25rem;
    }
    .form-control {
        border-radius: 0.375rem;
        padding: 0.75rem 1rem;
    }
    .form-control:focus {
        border-color: var(--purple-main);
        box-shadow: 0 0 0 0.25rem rgba(134, 87, 148, 0.25);
    }
    
    .btn {
        padding: 0.6rem 1.2rem;
        font-weight: 500;
        border-radius: 0.375rem;
        transition: all 0.2s ease;
    }
    .btn i { margin-right: 0.5rem; }

    /* Toggle Switch Modern */
    .form-check.form-switch {
        padding-left: 3em;
    }
    .form-check-input {
        width: 2.5em;
        height: 1.25em;
        margin-left: -3em;
        background-color: #adb5bd;
        border-color: #adb5bd;
    }
    .form-check-input:checked {
        background-color: var(--green-main);
        border-color: var(--green-main);
    }
    .form-switch .form-check-label {
        padding-top: 0.1em;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Template Email</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @php
        $statuses = ['pending', 'accepted', 'rejected'];
        $programDetails = ['artopia' => 'Artopia', 'ancient' => 'Ancient Academy'];
        $statusTitles = [
            'pending' => 'Sedang Diproses',
            'accepted' => 'Lolos Seleksi',
            'rejected' => 'Tidak Lolos Seleksi',
        ];
        $statusBadges = [
            'pending' => 'badge-pending',
            'accepted' => 'badge-accepted',
            'rejected' => 'badge-rejected',
        ];
    @endphp

    @foreach ($programDetails as $programKey => $programName)
        <div class="card card-program card-{{ $programKey }} mb-4">
            <div class="card-header">
                <i class="fas fa-layer-group me-2"></i>{{ $programName }}
            </div>
            <div class="card-body">
                <div class="accordion" id="accordion-{{ $programKey }}">
                    @foreach ($statuses as $status)
                        @php
                            // FIX: Mengembalikan pengecekan 'isset' untuk mencegah error jika sebuah program belum punya template
                            $template = isset($templates[$programKey])
                                ? $templates[$programKey]->firstWhere('status_type', $status)
                                : null;
                            $uniqueId = $programKey . '-' . $status;
                        @endphp
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-{{ $uniqueId }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $uniqueId }}" aria-expanded="false" aria-controls="collapse-{{ $uniqueId }}">
                                    <span class="me-auto">Template Status: <strong>{{ $statusTitles[$status] }}</strong></span>
                                    <span class="badge rounded-pill status-badge {{ $statusBadges[$status] }}">{{ $template ? ($template->is_active ? 'Aktif' : 'Nonaktif') : 'Belum Dibuat' }}</span>
                                </button>
                            </h2>
                            <div id="collapse-{{ $uniqueId }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $uniqueId }}" data-bs-parent="#accordion-{{ $programKey }}">
                                <div class="accordion-body">
                                    @if ($template)
                                        <div class="mb-4">
                                            <h5><i class="fas fa-eye me-2 text-muted"></i>Pratinjau Saat Ini</h5>
                                            <p><strong>Subjek:</strong> {{ $template->subject }}</p>
                                            <div class="template-preview">
                                                <strong>Isi Pesan:</strong>
                                                <div>{!! nl2br(e($template->body)) !!}</div>
                                            </div>
                                        </div>
                                        <hr class="my-4">
                                        <form action="{{ route('admin.email-templates.update', $template->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="program" value="{{ $template->program }}">
                                            <input type="hidden" name="status_type" value="{{ $template->status_type }}">
                                            
                                            <h5><i class="fas fa-edit me-2 text-muted"></i>Ubah Template</h5>
                                            <div class="form-group">
                                                <label for="subject-{{$uniqueId}}" class="form-label">Subjek Email</label>
                                                <input type="text" id="subject-{{$uniqueId}}" name="subject" class="form-control" value="{{ $template->subject }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="message-{{$uniqueId}}" class="form-label">Isi Pesan</label>
                                                <textarea id="message-{{$uniqueId}}" name="message" class="form-control" rows="5" required>{{ $template->body }}</textarea>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="is_active-{{$uniqueId}}" name="is_active" value="1" {{ $template->is_active ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_active-{{$uniqueId}}">Aktifkan Template Ini</label>
                                                </div>
                                                <button type="submit" class="btn btn-success"><i class="fas fa-sync-alt"></i>Perbarui</button>
                                            </div>
                                        </form>
                                    @else
                                        <p class="text-muted text-center mb-3">Template untuk status ini belum ada. Silakan buat di bawah.</p>
                                        <form action="{{ route('admin.email-templates.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="program" value="{{ $programKey }}">
                                            <input type="hidden" name="status_type" value="{{ $status }}">
                                            <h5><i class="fas fa-plus-circle me-2 text-muted"></i>Buat Template Baru</h5>
                                            <div class="form-group">
                                                <label for="subject-new-{{$uniqueId}}" class="form-label">Subjek Email</label>
                                                <input type="text" id="subject-new-{{$uniqueId}}" name="subject" class="form-control" placeholder="Tulis subjek email di sini..." required>
                                            </div>
                                            <div class="form-group">
                                                <label for="body-new-{{$uniqueId}}" class="form-label">Isi Pesan</label>
                                                <textarea id="body-new-{{$uniqueId}}" name="body" class="form-control" rows="5" placeholder="Tulis isi pesan email di sini..." required></textarea>
                                            </div>
                                            <div class="text-end">
                                               <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Simpan Template</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection