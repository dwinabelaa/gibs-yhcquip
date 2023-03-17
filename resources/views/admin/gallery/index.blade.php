<x-app-layout>
    @push('styles')
        
    @endpush
    
    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Gallery</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.gallery.create') }}">
                        <i class="bi-plus me-1"></i> Create
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Gallery</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-align-middle" >
                            @forelse ($galleries as $gallery)
                                <tr>
                                    <td scope="row">{{ $gallery->name }}</td>
                                    <td>{{ Str::limit($gallery->description, 50, '...') }}</td>
                                    <td style="display: flex;
                                    flex-direction: row;">
                                        <a name="" id="" class="btn btn-soft-primary btn-sm"
                                            href="{{ route('admin.gallery.edit', $gallery) }}">
                                            <i class="bi bi-pencil"></i> Edit</a>
                                        <a name="" id="" class="btn btn-soft-info btn-sm"
                                            href="{{ route('admin.gallery.show', $gallery) }}" style="margin-left:10px">
                                            <i class="bi bi-eye"></i> Show</a>
                                        <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-soft-danger btn-sm delete-btn" style="margin-left:10px;">
                                                <i class="bi bi-trash3"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
    
    @include('scripts.delete')
</x-app-layout>
