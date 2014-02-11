@layout('templates.rms')

@section('title')
    @parent - Users
@endsection

@section('content')
{{ Form::open('rms/users/search', 'GET', array('class'=>'form-search')) }}
  <h2>Search Members</h2>
  <p>Search for members by name, email or phone number</p>
  {{ Form::text('q', $query, array('class'=>'search-query')) }}
  {{ Form::select('y', $years, Year::where_year($year)->first()->id) }}
  {{ Form::submit('Search',array('class'=>'btn btn-primary')) }}

{{ Form::close() }}

<legend>Results <a style='font-size:13px' href='search.csv?q={{ $query }}'>(Download as CSV)</a></legend>
<table class="table table-striped table-bordered">
  <tr>
    <th>Full Name</th>
    <th>Display Name</th>
    <th>Email</th>
    <th>Phone</th>
  </tr>
  @forelse ($results as $result)
    @unless ($result->privacy)
      <tr>
        <td><a href="/rms/users/show/{{$result->user_id}}">{{ $result->full_name }}</a></td>
        <td>{{ $result->display_name }}</td>
        <td>{{ $result->email }}</td>
        <td>{{ $result->phone }}</td>
      </tr>
    @endunless
  @empty
    <tr><td colspan='4' style='text-align:center;'>No Results Found.</td></tr>
  @endforelse
</table>
@endsection