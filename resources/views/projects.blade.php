@extends('layouts.app')

@section('content')

<h1 class="text-lg font-bold mb-4">Project</h1>

<form method="POST" action="/projects" class="mb-4">
    @csrf
    <input type="text" name="name" placeholder="Nama project" class="w-full border p-2 rounded mb-2">
    <button class="bg-black text-white w-full py-2 rounded">
        Tambah
    </button>
</form>

<div class="space-y-3">
    @foreach($projects as $project)
    <div class="p-3 bg-white rounded shadow">
        <p class="font-semibold">{{ $project->name }}</p>
        <p class="text-sm text-gray-500">
            {{ $project->tasks_count }} tugas
        </p>
    </div>
    @endforeach
</div>

@endsection