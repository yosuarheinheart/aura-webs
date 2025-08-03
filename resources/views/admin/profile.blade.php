@extends('admin.layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user mr-1"></i>
                        Profile Information
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ old('name', 'Administrator') }}" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="{{ old('email', 'admin@example.com') }}" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="password">New Password (Optional)</label>
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Leave blank to keep current password">
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation" 
                                   name="password_confirmation" placeholder="Confirm new password">
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle mr-1"></i>
                        System Information
                    </h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">PHP Version:</dt>
                        <dd class="col-sm-8">{{ PHP_VERSION }}</dd>
                        
                        <dt class="col-sm-4">Laravel Version:</dt>
                        <dd class="col-sm-8">{{ app()->version() }}</dd>
                        
                        <dt class="col-sm-4">Server Time:</dt>
                        <dd class="col-sm-8">{{ now()->format('Y-m-d H:i:s') }}</dd>
                        
                        <dt class="col-sm-4">Timezone:</dt>
                        <dd class="col-sm-8">{{ config('app.timezone') }}</dd>
                        
                        <dt class="col-sm-4">Environment:</dt>
                        <dd class="col-sm-8">
                            <span class="badge badge-{{ app()->environment() === 'production' ? 'success' : 'warning' }}">
                                {{ ucfirst(app()->environment()) }}
                            </span>
                        </dd>
                    </dl>
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-cog mr-1"></i>
                        Quick Actions
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('admin.artopia.index') }}" class="btn btn-outline-primary btn-block">
                                <i class="fas fa-palette"></i><br>
                                Manage Artopia
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.ancient.index') }}" class="btn btn-outline-success btn-block">
                                <i class="fas fa-landmark"></i><br>
                                Manage Ancient
                            </a>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <a href="{{ route('admin.email-templates.index') }}" class="btn btn-outline-info btn-block">
                                <i class="fas fa-envelope-open-text"></i><br>
                                Email Templates
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-block">
                                <i class="fas fa-tachometer-alt"></i><br>
                                Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection