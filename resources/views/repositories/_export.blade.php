<table class="table-striped dataTable">
    <thead>
    <tr>
        <th>Repository Name</th>
        <th>Repository number of stars</th>
        <th>Repository Link</th>
        <th>
            show
        </th>
    </tr>
    </thead>
    <tbody>
      @include('repositories._append',['repositories'=>$repositories])
    </tbody>
</table>
