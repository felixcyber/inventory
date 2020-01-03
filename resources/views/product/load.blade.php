@extends('product.layout')

@section('content')

<br>
<div class="row">
    <div class="col-12">

      <table>
        @foreach($books as $book)
      <tr>
          <td>{{ $book->title }}</td>
      </tr>
        @endforeach
      </table>

    </div>
</div>
@endsection
