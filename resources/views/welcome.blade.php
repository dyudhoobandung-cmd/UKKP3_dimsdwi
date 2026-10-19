@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<section class="mx-auto max-w-7xl px-6 py-16 sm:py-24">
    <div class="grid items-center gap-12 lg:grid-cols-[1.1fr_0.9fr]">
        <div>
            <span class="inline-flex rounded-full bg-indigo-50 px-3 py-1 text-sm font-semibold text-indigo-700">Portal Layanan</span>
            <h1 class="mt-6 max-w-2xl text-4xl font-semibold leading-tight tracking-tight text-slate-950 sm:text-6xl">Layanan yang lebih dekat, dalam satu akun.</h1>
            <p class="mt-6 max-w-xl text-lg leading-8 text-slate-600">Masuk ke portal sesuai peran Anda atau daftar sebagai customer untuk memulai.</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('register') }}" class="rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-indigo-700">Buat akun customer</a>
                <a href="{{ route('login') }}" class="rounded-xl border border-slate-300 bg-white px-5 py-3 font-semibold text-slate-700 transition hover:bg-slate-100">Masuk</a>
            </div>
        </div>

        <div class="rounded-3xl bg-indigo-950 p-8 text-white shadow-xl shadow-indigo-950/10 sm:p-10">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-300">Akses berdasarkan peran</p>
            <div class="mt-7 space-y-4">
                @foreach ([
                    ['Admin', 'Kelola akses portal'],
                    ['Petugas', 'Akses area kerja layanan'],
                    ['Customer', 'Gunakan layanan akun'],
                ] as [$role, $description])
                    <div class="flex items-center gap-4 rounded-2xl border border-white/10 bg-white/5 p-4">
                        <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-indigo-400/15 text-indigo-200">✓</span>
                        <div>
                            <p class="font-semibold">{{ $role }}</p>
                            <p class="mt-1 text-sm text-indigo-100/70">{{ $description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
