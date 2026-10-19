@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<section class="mx-auto grid min-h-[calc(100vh-150px)] max-w-7xl items-center gap-12 px-6 py-12 lg:grid-cols-2">
    <div class="hidden rounded-3xl bg-indigo-950 p-12 text-white lg:block">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-300">Selamat datang kembali</p>
        <h1 class="mt-6 max-w-lg text-4xl font-semibold leading-tight">Satu portal untuk layanan yang lebih mudah.</h1>
        <p class="mt-5 max-w-md leading-7 text-indigo-100/75">Masuk dengan akun Anda untuk melanjutkan. Setiap akun akan diarahkan ke area sesuai perannya.</p>
        <div class="mt-10 flex flex-wrap gap-2">
            @foreach (['Admin', 'Petugas', 'Customer'] as $role)
                <span class="rounded-full border border-white/15 px-4 py-2 text-sm text-indigo-100">{{ $role }}</span>
            @endforeach
        </div>
    </div>

    <div class="mx-auto w-full max-w-md">
        <p class="text-sm font-semibold text-indigo-700">Akun Portal Layanan</p>
        <h1 class="mt-2 text-3xl font-semibold tracking-tight">Masuk ke akun Anda</h1>
        <p class="mt-2 text-sm text-slate-600">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-indigo-700 hover:text-indigo-800">Daftar sebagai customer</a></p>

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

        <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus
                    class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"
                    placeholder="nama@email.com">
                @error('email')
                    <p class="mt-1 text-sm text-rose-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700">Kata sandi</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required
                    class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"
                    placeholder="Masukkan kata sandi">
            </div>

            <label class="flex items-center gap-2 text-sm text-slate-600">
                <input type="checkbox" name="remember" value="1" class="size-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                Ingat saya
            </label>

            <button type="submit" class="w-full rounded-xl bg-indigo-600 px-4 py-3 font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-200">
                Masuk
            </button>
        </form>
    </div>
</section>
@endsection
