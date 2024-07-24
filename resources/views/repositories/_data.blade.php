<div class="card">
    <div class="card-body">
        <div class="row table-responsive" >
            <table class="table table-bordered dataTable">
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
                <tbody id="data-container">

                </tbody>
            </table>

        </div>
        <div class="loader">
            <div class="loader-wheel"></div>
            <div class="loader-text"></div>
        </div>
    </div>
</div>



@push('js')
    <script>
        $(document).ready(function (){
           search();

           $('.filter-form').submit(function (e) {
               e.preventDefault();
               search();
           });
        });



        function search(){
            var form_data=$('.filter-form').serialize();
            $('.loader').show();
            $.ajax({
                url: "{{route('get-data')}}",
                type: 'post',
                dataType: 'json', // added data type
                data: form_data,
                success: function(res) {
                    $('#data-container').html(res);
                    $('.loader').hide();
                }
            });
        }


    </script>
@endpush
