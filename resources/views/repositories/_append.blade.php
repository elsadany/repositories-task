@foreach($repositories['items'] as $repository)
    <tr>
        <td>{{$repository['full_name']}}</td>
        <td>{{$repository['stargazers_count']}}</td>
        <td>{{$repository['html_url']}}</td>
        <td><a class="btn btn-sm btn-success" target="_blank" href="{{$repository['html_url']}}"><i class="fa fa-eye"></i> </a> </td>
    </tr>
@endforeach
