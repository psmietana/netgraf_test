<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Pet</title>
</head>
<body>
    <form method="POST" action="/pet/store">
        @csrf
        <div>
            <label>Name</label>
            <input type="text" name="email" placeholder="Enter name">
        </div>
        <div>
            <label>Category</label>
            <input type="text" name="category" placeholder="Enter category name">
        </div>
        <div>
            <label>Photo Urls</label>
            <input type="text" class="form-control" name="photoUrls" placeholder="Photo Urls">
        </div>
        <div>
            <label>Tags</label>
            <input type="text" class="form-control" name="tags" placeholder="Tags">
        </div>
        <div>
            <label>Status</label>
            <input type="text" class="form-control" name="status">
        </div>
        <fieldset>
            <legend>Select a maintenance drone:</legend>

            <div>
                <input type="radio" id="huey" name="drone" value="huey"/>
                <label for="huey">Huey</label>
            </div>

            <div>
                <input type="radio" id="dewey" name="drone" value="dewey" />
                <label for="dewey">Dewey</label>
            </div>

            <div>
                <input type="radio" id="louie" name="drone" value="louie" />
                <label for="louie">Louie</label>
            </div>
        </fieldset>
    </form>
</body>
</html>
