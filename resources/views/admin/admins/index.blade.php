@extends('layouts.dashboard')

@section('content')
<div class="container py-4">
    <div class="text-center mb-2">
        <span class="d-inline-block mb-2" style="font-size:2.5rem;">
            <!-- SVG أيقونة shield -->
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                <path d="M12 3l7 4v5c0 5.25-3.5 9.25-7 11-3.5-1.75-7-5.75-7-11V7l7-4z" fill="#ffd600" stroke="#2563eb" stroke-width="2.2"/>
                <path d="M12 3v18" stroke="#2563eb" stroke-width="2.2"/>
            </svg>
        </span>
        <h1 class="fw-bold text-primary">{{ __('Admins Management') }}</h1>
    </div>
    <div class="row mb-4 justify-content-center">
        <div class="col-md-4">
            <a href="{{ route('admins.create') }}" class="btn btn-success w-100 fw-bold py-2"><i class="bi bi-plus-circle me-1"></i> {{ __('Add Admin') }}</a>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    <style>
        .modern-table-container {
            border-radius: 1.5rem;
            box-shadow: 0 6px 32px 0 rgba(37,99,235,0.10), 0 1.5px 6px 0 rgba(0,0,0,0.04);
            border: 2.5px solid #e0e7ff;
            background: #fff;
            padding: 2rem 1.2rem;
        }
        .modern-table {
            border-radius: 1.1rem;
            overflow: hidden;
            margin-bottom: 0;
        }
        .modern-table thead th {
            background: linear-gradient(90deg, #2563eb 60%, #60a5fa 100%);
            color: #fff;
            font-weight: bold;
            border: none;
            font-size: 1.13rem;
            letter-spacing: 0.5px;
        }
        .modern-table tbody tr:nth-child(even) {
            background: #f6faff;
        }
        .modern-table tbody tr:nth-child(odd) {
            background: #fff;
        }
        .modern-table tbody tr:hover {
            background: #e0e7ff !important;
            transition: background 0.18s;
        }
        .modern-table td, .modern-table th {
            vertical-align: middle;
            padding-top: 0.85rem;
            padding-bottom: 0.85rem;
        }
        .modern-table .fw-bold {
            color: #2563eb;
        }
    </style>
    <div class="modern-table-container mt-2">
        <div class="table-responsive">
        <table class="table table-hover align-middle text-center modern-table" style="font-size:1.13rem;">
            <thead class="align-middle">
                <tr style="font-size:1.15rem;">
                    <th style="width:70px">#</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Role') }}</th>
                    <th style="width:180px">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr>
                    <td class="fw-bold">{{ $admin->id }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->getRoleNames()->first() }}</td>
                    <td>
                        <a href="{{ route('admins.edit', $admin) }}" class="btn btn-sm btn-warning px-3 fw-bold"><i class="bi bi-pencil-square me-1"></i> تعديل</a>
                        <form action="{{ route('admins.destroy', $admin) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger px-3 fw-bold" onclick="return confirm('Are you sure?')"><i class="bi bi-trash me-1"></i> حذف</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
