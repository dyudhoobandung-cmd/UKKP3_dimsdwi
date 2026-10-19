@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<section class="mx-auto grid min-h-[calc(100vh-150px)] max-w-7xl items-center gap-12 px-6 py-12 lg:grid-cols-2">
    <div class="hidden rounded-3xl bg-slate-900 p-12 text-white lg:block">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-300">Mulai sekarang</p>
        <h1 class="mt-6 max-w-lg text-4xl font-semibold leading-tight">Buat akun customer dalam beberapa langkah.</h1>
        <p class="mt-5 max-w-md leading-7 text-slate-300">Pendaftaran terbuka membuat akun customer. Akses admin dan petugas hanya diberikan oleh pengelola.</p>
        <div class="mt-10 flex items-center gap-3 text-sm text-slate-300">
            <span class="grid size-9 place-items-center rounded-full bg-white/10 text-indigo-200">✓</span>
            Data akun Anda terlindungi.
        </div>
    </div>

    <div class="mx-auto w-full max-w-md">
        <p class="text-sm font-semibold text-indigo-700">Akun Portal Layanan</p>
        <h1 class="mt-2 text-3xl font-semibold tracking-tight">Buat akun baru</h1>
        <p class="mt-2 text-sm text-slate-600">Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-indigo-700 hover:text-indigo-800">Masuk</a></p>

        @if ($errors->any())
            <div role="alert" class="mt-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                <p class="font-medium">Periksa kembali data yang dimasukkan.</p>
                <ul class="mt-1 list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}" class="mt-8 space-y-5">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-slate-700">Nama lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required autofocus
                    class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"
                    placeholder="Nama Anda">
                @error('name')
                    <p class="mt-1 text-sm text-rose-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required
                    class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"
                    placeholder="nama@email.com">
                @error('email')
                    <p class="mt-1 text-sm text-rose-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700">Kata sandi</label>
                <input id="password" name="password" type="password" autocomplete="new-password" required
                    class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"
                    placeholder="Minimal 8 karakter">
                @error('password')
                    <p class="mt-1 text-sm text-rose-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Ulangi kata sandi</label>
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                    class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"
                    placeholder="Ketik ulang kata sandi">
            </div>

            <button type="submit" class="w-full rounded-xl bg-indigo-600 px-4 py-3 font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-200">
                Daftar sebagai customer
            </button>
        </form>
    </div>
</section>
@endsection
