<!-- resources/views/balls/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Ball</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/balls') }}">
                        @csrf

                        <div class="form-group">
                            <label for="color">Ball Color</label>
                            <input type="text" class="form-control" id="color" name="color" required>
                        </div>

                        <div class="form-group">
                            <label for="size">Size (in cubic inches)</label>
                            <input type="number" class="form-control" id="size" name="size" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Ball</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
