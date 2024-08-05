<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pets</title>
</head>
<body>
@if (session()->has('success'))
    <div>
        {{ session('success') }}
    </div>
@endif
@if (session()->has('error'))
    <div>
        {{ session('error') }}
    </div>
@endif
<a class="btn btn-sm btn-success" href={{ route('pet.create') }}>Add Pet</a>
<table>
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($pets as $pet)
            <tr>
                <td>{{ $pet->getName() }}</td>
                <td>
                    <a href="{{ route('pet.edit', $pet->getId()) }}"
                       class="btn btn-primary btn-sm">Edit</a>
                </td>
                <td>
                    <form action="{{ route('pet.destroy', $pet->getId()) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
