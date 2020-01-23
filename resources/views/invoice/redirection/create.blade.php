@extends('layouts.app')
@section('content')
<div>
    <br>
    <br>
    <br>
    <br>
    <form action="{{ route('redirection.store', $invoice) }}" method="POST">
        @csrf
        <button type="submit"> confirmar </button>
    </form>
</div>
@endsection