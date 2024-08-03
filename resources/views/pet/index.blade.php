<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pets</title>
</head>
<body>
<a class="btn btn-sm btn-success" href={{ route('pet.create') }}>Add Pet</a>
<table>
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Phone</th>
        <th scope="col">Email</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($pets as $pet)
            <tr>
                <td>{{ $pet->name }}</td>
                <td>
                    <a href="{{ route('pet.edit', $pet->id) }}"
                       class="btn btn-primary btn-sm">Edit</a>
                </td>
                <td>
                    <form action="{{ route('pet.destroy', $pet->id) }}" method="post">
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
