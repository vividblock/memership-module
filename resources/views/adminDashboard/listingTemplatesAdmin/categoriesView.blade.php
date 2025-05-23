@include('includes.admin.header')

<!-- Begin Page Content -->
<div class="container-fluid pb-5">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 admindash-headings">Listing Categories</h1>

    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Categorie Name</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Categorie Name</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> 
                            <tbody>
                                @php
                                    $faIcons = [
                                        'fa-car', 'fa-bicycle', 'fa-bus', 'fa-truck', 'fa-motorcycle',
                                        'fa-home', 'fa-building', 'fa-city', 'fa-school', 'fa-hotel',
                                        'fa-user', 'fa-user-tie', 'fa-users', 'fa-user-nurse', 'fa-user-graduate',
                                        'fa-heart', 'fa-star', 'fa-thumbs-up', 'fa-thumbs-down', 'fa-check',
                                        'fa-times', 'fa-clock', 'fa-calendar', 'fa-envelope', 'fa-phone',
                                        'fa-camera', 'fa-image', 'fa-music', 'fa-video', 'fa-globe',
                                        'fa-map', 'fa-compass', 'fa-search', 'fa-wrench', 'fa-cogs',
                                        'fa-shopping-cart', 'fa-credit-card', 'fa-money-bill', 'fa-gift', 'fa-tag',
                                        'fa-lock', 'fa-unlock', 'fa-key', 'fa-bell', 'fa-lightbulb',
                                        'fa-book', 'fa-book-open', 'fa-briefcase', 'fa-chart-line', 'fa-database'
                                    ];
                                @endphp

                                @php
                                    $count = 1;
                                @endphp
                                @foreach($categories as $ca)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td><i class="{{ $ca->categories_icon }} mr-2"></i>{{ $ca->categories_name }}</td>
                                    <td>{{ $ca->categories_slug }}</td>
                                    <td>
                                        <a href="{{ route('listingCategoriesDelete', $ca->id ) }}" class="btn btn-danger btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                @php
                                    $count++;
                                @endphp
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add Categories</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('listingCategoriesAdd') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Category Name</label>
                            <input type="text" name="categori_name" class="form-control from-control-user" >
                        </div>
                        <div class="form-group">
                            <label for="">Category Icon</label>
                                <select name="categori_icon" class="form-control" id="icon-select">
                                    <option value="">Select Icon</option>
                                    @foreach ($faIcons as $icon)
                                        <option value="fas {{ $icon }}">
                                            {!! '<i class="fas ' . $icon . '"></i>' !!} {{ ucfirst(str_replace('-', ' ', $icon)) }}
                                        </option>
                                    @endforeach
                                </select>

                                <div id="icon-preview" class="mt-2" style="font-size: 24px;"></div>


                            <div id="icon-preview" class="mt-2" style="font-size: 24px;"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Category Slug</label>
                            <input type="text" name="categori_slug" class="form-control from-control-user">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Add Categorie</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('icon-select').addEventListener('change', function () {
        const iconClass = this.value;
        document.getElementById('icon-preview').innerHTML = iconClass
            ? `<i class="${iconClass}"></i> ${iconClass}`
            : '';
    });
</script>


@include('includes.admin.footer')