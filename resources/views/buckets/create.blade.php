<!-- resources/views/buckets/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create Bucket</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6"> 
                            <h4>Bucket Form</h4> 
                            <form method="POST" action="{{ url('/buckets') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Bucket Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $buckets?$buckets->name:"" }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="capacity">Volume (in inches)</label>
                                    <input type="number" class="form-control" id="capacity" value="{{ $buckets?$buckets->capacity:"" }}" name="capacity" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>

                        </div>
                        <div class="col-md-6">
                            <h4>Ball Form</h4> 
                            <form method="POST" action="{{ url('/balls') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="color">Ball Color</label>
                                    <input type="text" class="form-control" id="color" name="color"  required>
                                </div>

                                <div class="form-group">
                                    <label for="size">Volume (in inches)</label>
                                    <input type="number" class="form-control" id="size" name="size"  required>
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h4>Balls</h4>

                           @if (count($ballVolumes) > 0)
                                <ul>
                                    @foreach ($ballVolumes as $ball)
                                        <li>
                                            {{ $ball['color'] }} => {{ $ball['size'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No Balls found.</p>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <h4>Suggestions</h4>

                            @if (count($formattedCombinations) > 0)
                                <ul>
                                    @foreach ($formattedCombinations as $possibility)
                                        <li>
                                            
                                        {{ $possibility }}
                                           
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No possibilities found.</p>
                            @endif
                        </div>
                    </div>
                   


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
