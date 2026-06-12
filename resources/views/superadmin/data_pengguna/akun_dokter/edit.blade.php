@extends('layouts.dashboard')

@section('title', 'Edit Dokter')

@section('content')

    <style>
        .edit-wrap {
            font-family: 'DM Sans', sans-serif;
            max-width: 960px;
        }

        .back-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #fff;
            border: 1px solid #bfdbfe;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            text-decoration: none;
            transition: background .15s, box-shadow .15s;
            flex-shrink: 0;
        }

        .back-btn:hover {
            background: #eff6ff;
            box-shadow: 0 2px 8px rgba(37, 99, 235, .15);
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -.02em;
        }

        .page-sub {
            font-size: 13px;
            color: #64748b;
            margin-top: 2px;
        }

        .form-card {
            background: #fff;
            border: 1px solid #bfdbfe;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 1.25rem;
        }

        .card-header {
            padding: 1rem 1.5rem;
            border-bottom: 2px solid #dbeafe;
            background: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header-icon {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            background: #dbeafe;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .card-header h3 {
            font-size: 14px;
            font-weight: 700;
            color: #1e40af;
            margin: 0;
        }

        .card-header p {
            font-size: 12px;
            color: #3b82f6;
            margin: 2px 0 0;
        }

        .card-body {
            padding: 1.5rem;
        }

        .field-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem 1.5rem;
        }

        .field-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .field-group.span-2 {
            grid-column: span 2;
        }

        .field-group.span-full {
            grid-column: 1 / -1;
        }

        .field-label {
            font-size: 12px;
            font-weight: 700;
            color: #334155;
            letter-spacing: .02em;
        }

        .field-label span {
            font-weight: 400;
            color: #64748b;
            margin-left: 4px;
        }

        .field-input {
            width: 100%;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            padding: .55rem .9rem;
            font-size: 13.5px;
            color: #0f172a;
            outline: none;
            background: #fff;
            transition: border-color .15s, box-shadow .15s;
            box-sizing: border-box;
            font-family: 'DM Sans', sans-serif;
        }

        .field-input:hover {
            border-color: #93c5fd;
        }

        .field-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .12);
        }

        .field-input.has-error {
            border-color: #fca5a5;
            background: #fff5f5;
        }

        .field-input::placeholder {
            color: #94a3b8;
        }

        .field-error {
            font-size: 11.5px;
            color: #dc2626;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .password-wrap {
            position: relative;
        }

        .password-wrap .field-input {
            padding-right: 2.5rem;
        }

        .pwd-toggle {
            position: absolute;
            right: .75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #64748b;
            padding: 2px;
            transition: color .15s;
            display: flex;
            align-items: center;
        }

        .pwd-toggle:hover {
            color: #2563eb;
        }

        .pwd-hint {
            font-size: 11.5px;
            color: #3b82f6;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 9px;
            padding: .6rem .85rem;
            display: flex;
            align-items: flex-start;
            gap: 6px;
            line-height: 1.5;
        }

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: .75rem;
        }

        .btn-cancel {
            padding: .6rem 1.25rem;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            color: #2563eb;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            text-decoration: none;
            transition: background .15s;
        }

        .btn-cancel:hover {
            background: #dbeafe;
        }

        .btn-save {
            padding: .6rem 1.5rem;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            background: #2563eb;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(37, 99, 235, .25);
            transition: background .15s, box-shadow .15s, transform .1s;
            display: flex;
            align-items: center;
            gap: 6px;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-save:hover {
            background: #1d4ed8;
            box-shadow: 0 6px 20px rgba(37, 99, 235, .35);
        }

        .btn-save:active {
            transform: scale(.97);
        }

        @media (max-width: 768px) {
            .field-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .field-group.span-2 {
                grid-column: span 2;
            }
        }

        @media (max-width: 480px) {
            .field-grid {
                grid-template-columns: 1fr;
            }

            .field-group.span-2 {
                grid-column: span 1;
            }
        }
    </style>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">

    <div class="edit-wrap">

        <div style="display:flex; align-items:center; gap:14px; margin-bottom:1.75rem;">
            <a href="{{ route('superadmin.dokter.index') }}" class="back-btn" title="Kembali">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="page-title">Edit Dokter</h1>
                <p class="page-sub">Perbarui profil dan akses akun dokter.</p>
            </div>
        </div>

        <form action="{{ route('superadmin.dokter.update', $dokter->id_user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <svg width="15" height="15" fill="none" stroke="#1d4ed8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3>Informasi Dokter</h3>
                        <p>Data identitas dan kontak dokter</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="field-grid">

                        <div class="field-group span-2">
                            <label class="field-label">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama', $dokter->nama) }}"
                                placeholder="dr. Nama Lengkap, Sp.X" class="field-input @error('nama') has-error @enderror"
                                required>
                            @error('nama')
                                <span class="field-error">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="field-group">
                            <label class="field-label">Nomor WhatsApp</label>
                            <input type="text" name="no_wa" value="{{ old('no_wa', $dokter->no_wa) }}"
                                placeholder="08xxxxxxxxxx" class="field-input @error('no_wa') has-error @enderror" required>
                            @error('no_wa')
                                <span class="field-error">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="field-group span-full">
                            <label class="field-label">Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email', $dokter->email) }}"
                                placeholder="dokter@klinik.com" class="field-input @error('email') has-error @enderror"
                                required>
                            @error('email')
                                <span class="field-error">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <svg width="15" height="15" fill="none" stroke="#1d4ed8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div>
                        <h3>Keamanan Akun</h3>
                        <p>Kosongkan jika tidak ingin mengubah password</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="field-grid">

                        <div class="field-group">
                            <label class="field-label">Password Baru <span>(Opsional)</span></label>
                            <div class="password-wrap">
                                <input type="password" name="password" id="pwd1" placeholder="••••••••"
                                    class="field-input @error('password') has-error @enderror">
                                <button type="button" class="pwd-toggle" onclick="togglePwd('pwd1', this)" tabindex="-1">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <span class="field-error">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="field-group">
                            <label class="field-label">Konfirmasi Password Baru</label>
                            <div class="password-wrap">
                                <input type="password" name="password_confirmation" id="pwd2" placeholder="••••••••"
                                    class="field-input">
                                <button type="button" class="pwd-toggle" onclick="togglePwd('pwd2', this)" tabindex="-1">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="field-group">
                            <label class="field-label" style="opacity:0; user-select:none;">-</label>
                            <div class="pwd-hint">
                                <svg width="14" height="14" fill="none" stroke="#3b82f6" viewBox="0 0 24 24"
                                    style="flex-shrink:0;margin-top:1px">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Minimal 8 karakter. Biarkan kosong jika tidak ingin mengubah password saat ini.
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="form-footer">
                <a href="{{ route('superadmin.dokter.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>

    <script>
        function togglePwd(id, btn) {
            const input = document.getElementById(id);
            const isText = input.type === 'text';
            input.type = isText ? 'password' : 'text';
            btn.querySelector('svg').innerHTML = isText
                ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>'
                : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24M1 1l22 22"/>';
        }
    </script>

@endsection