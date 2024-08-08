<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Pet</title>
</head>
<body>
    <form method="POST" action="{{ route('pet.store') }}">
        @csrf
        <div>
            <label>ID</label>
            <input type="number" name="id" placeholder="Enter ID" min="1">
        </div>
        <div>
            <label>Name</label>
            <input type="text" name="name" placeholder="Enter name">
        </div>
        <div>
            <label>Category</label>
            <input type="text" name="category" placeholder="Enter category name">
        </div>
        <div>
            <label>Photo Urls separated by commas</label>
            <input type="text" class="form-control" name="photoUrls" placeholder="https://...,https://...,https://">
        </div>
        <div>
            <label>Tags separated by commas</label>
            <input type="text" class="form-control" name="tags" placeholder="tag1,tag2,tag3">
        </div>
        <fieldset>
            <legend>Choose status:</legend>
            @foreach($statuses as $status)
                <div>
                    <input type="radio" id="{{ $status->value }}" name="status" value="{{ $status->value }}"/>
                    <label for="{{ $status->value }}" style="text-transform: capitalize;">{{ $status->value }}</label>
                </div>
            @endforeach
        </fieldset>
        <input type="submit" value="Save" />
    </form>
</body>
</html>
