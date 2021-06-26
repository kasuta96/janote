<form action="{{ route($RouteName) }}" method="get">
    <nav class="note-navbar navbar navbar-expand-lg navbar-light bg-light">
        <input type="hidden" name="d" value="{{ $RouteName }}">
        <div class="form-inline">
            <input
                class="form-control"
                type="search"
                placeholder="{{ __('Keywords') }}"
                name="kw" 
                @if(isset($Params['kw']))
                    value="{{ $Params['kw'] }}"
                @endif
            >
        </div>

        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarTogglerSearch"
            aria-controls="navbarTogglerSearch"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerSearch">
            <div class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item my-1 my-lg-0 mx-lg-2">
                    <select class="form-control" name="mark" onchange="javascript:this.form.submit()">
                        <option value="">{{ __('All') }}</option>
                        <option
                            value="1"
                            @if(isset($Params['mark']) && $Params['mark'] == 1)
                                selected
                            @endif
                        >{{ __('Studying') }}
                        </option>
                        <option
                            value="2"
                            @if(isset($Params['mark']) && $Params['mark'] == 2)
                                selected
                            @endif
                        >{{ __('Studied') }}
                        </option>
                    </select>
                </li>

                <li class="nav-item my-1 my-lg-0 mx-lg-2">
                    <select class="form-control" name="c" onchange="javascript:this.form.submit()">
                        <option value="" selected>{{ __('Categories').': '.__('All') }}</option>
                        @foreach( App\Http\Controllers\Category\CategoryController::CategoriesData() as $Category)
                        <option
                            value="{{ $Category->id }}"
                            @if(isset($Data->category) && $Data->category->id==$Category->id)
                                selected 
                            @endif
                        >
                            {{ $Category->title }}
                        </option>
                        @endforeach
                        <option
                            value="other"
                            @if(isset($Data->category) && $Data->category->id=='other')
                                selected 
                            @endif

                        >
                            {{ __('Other') }}
                        </option>

                    </select>
                </li>
                <li class="nav-item my-1 my-lg-0 mx-lg-2">
                    <select class="form-control" name="s" onchange="javascript:this.form.submit()">
                        <option value="desc">{{ __('Newest') }}</option>
                        <option
                            value="asc"
                            @if(isset($Params['s']) && $Params['s'] == 'asc')
                                selected
                            @endif
                        >{{ __('Oldest') }}</option>
                    </select>
                </li>
                <button class="btn btn-outline-primary my-1 my-lg-0 mx-lg-2" type="submit">{{ __('Search') }}</button>
            </div>
        </div>
    </nav>
</form>