<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Pet</title>
</head>
<body>
    <form method="POST" action="/pet/store/{{$contact->id}}">
        @csrf
        <div class="form-group mb-2">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{$contact->email}}">
        </div>
        <div class="form-group mb-2">
            <label for="exampleInputPassword1">Phone Number</label>
            <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{$contact->phone}}">
        </div>
        <div class="form-group mb-2">
            <label for="exampleInputPassword1">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Name" value="{{$contact->name}}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</body>
</html>
