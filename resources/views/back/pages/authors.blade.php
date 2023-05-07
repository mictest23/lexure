@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Authors')
@section('content')

<livewire:authors />

@endsection

@push('scripts')
    <script>
        $(window).on('hidden.bs.modal', function(){
            Livewire.emit('resetForms');
        });
    </script>
@endpush
