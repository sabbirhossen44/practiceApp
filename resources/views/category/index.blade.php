@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Category List</h4>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
                </div>
                <div class="card-body">
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <form action="">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" class="form-control" placeholder="Search"
                                            value="{{ request('search') }}">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </div>
                                </form>
                            </div>
                            {{-- <div class="col-md-4"></div> --}}
                            <div class="col-md-8">
                                <form action="">
                                    <div class="d-flex justify-content-end align-items-center ms-auto">
                                        <select name="filter" class="form-select" id="" style="max-width: 350px">
                                            <option value="">Select Filter</option>
                                            <option value="1" {{ request('filter') == '1' ? 'selected' : '' }}>A to Z</option>
                                            <option value="2" {{ request('filter') == '2' ? 'selected' : '' }}>Z to A</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Store Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $index => $category)
                                <tr>
                                    <td>{{ $categories->firstItem() + $index }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="" class="btn btn-info">Edit</a>
                                        <a href="{{ route('categories.delete', $category->id) }}"
                                            class="btn btn-danger deleteConfirm">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-danger">No Category Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
