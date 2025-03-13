@extends('layouts.master')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-4">
                    {{-- DataTables in Here --}}
                        {!! $data !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection