<div class="card">
    <div class="card-body">
        <form class="filter-form" method="get">
            <div class="row">
                <div class="col-md-3 form-group">
                    <label for="languages">
                        Program Language
                    </label>
                    <select class="form-control select-2" name="language">
                        <option value="">select language</option>
                        @foreach($languages as $language)
                            <option @selected($language==request()->get('language'))>{{$language}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="col-md-3 form-group">
                    <label for="limits">
                        Limit
                    </label>
                    <select class="form-control select-2" name="limit">
                        <option value="">select Limit</option>
                        @foreach($limits as $key => $limit)
                            <option @selected($limit==request()->get('limit',10))>{{$limit}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="col-md-3 form-group">
                    <label for="date_from">Date From</label>
                    <input class="form-control" type="date" value="2019-01-10" name="date_from" required>

                </div>
                <div class="col-md-3 form-group">
                    <input type="submit" class="btn btn-success" value="Search">
                </div>
            </div>
        </form>
    </div>
</div>

