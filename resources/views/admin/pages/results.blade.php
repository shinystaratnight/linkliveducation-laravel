@extends("admin.admin_app")
@section("content")

    <div class="container" style="margin-bottom: 5rem; margin-top: 5rem;">
        <h1 class="text-center">Results</h1>
        @if(count($marks)>0)
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Marks</th>
                    <th scope="col">Quiz</th>
                    <th scope="col">User</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">PAN</th>
                    <th scope="col">Country</th>
                    <th scope="col">States</th>
                </tr>
                </thead>
                <tbody>
                @foreach($marks as $mark)
                    <tr>
                        <td>{{$mark->marks}}</td>
                        <td>{{$mark->quiz->subCategory->name}}</td>
                        <td>{{$mark->user->first_name}} {{$mark->user->last_name}}</td>
                        <td>{{$mark->email}}</td>
                        <td>{{$mark->phone}}</td>
                        <td>{{$mark->pan}}</td>
                        <td>{{$mark->country->name}}</td>
                        <td>{{$mark->states}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h3>No Results Found</h3>
        @endif
    </div>

    @endsection