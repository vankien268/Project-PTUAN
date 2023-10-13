<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $pageName??config('app.name') }}</h1>
            </div><!-- /.col -->
            @isset($breadcrumbs)
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        @foreach($breadcrumbs as $breadcrumb)
                            <li class="breadcrumb-item {{ $loop->last?'active':'' }}">
                                @if (!$loop->last)
                                    <a href="{{ $breadcrumb['link']??'#' }}">{{ $breadcrumb['text']??$breadcrumb }}</a>
                                @else
                                    {{ $breadcrumb['text']??$breadcrumb }}
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </div>
            @endisset
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
