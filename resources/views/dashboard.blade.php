@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="mx-auto max-w-7xl px-6 py-12">
    <div class="overflow-hidden rounded-3xl bg-indigo-950 px-8 py-10 text-white shadow-sm sm:px-12">
        <span class="inline-flex rounded-full bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-indigo-200">{{ $roleLabel }}</span>
        <h1 class="mt-5 text-3xl font-semibold tracking-tight sm:text-4xl">Halo, {{ auth()->user()->name }}</h1>
        <p class="mt-3 max-w-xl leading-7 text-indigo-100/80">{{ $description }}</p>
    </div>

    <div class="mt-8 grid gap-5 md:grid-cols-3">
        <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Nama</p>
            <p class="mt-2 font-semibold text-slate-900">{{ auth()->user()->name }}</p>
        </article>
        <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Email</p>
            <p class="mt-2 break-all font-semibold text-slate-900">{{ auth()->user()->email }}</p>
        </article>
        <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Hak akses</p>
            <p class="mt-2 font-semibold capitalize text-slate-900">{{ $roleLabel }}</p>
        </article>
    </div>
</section>
@endsection
