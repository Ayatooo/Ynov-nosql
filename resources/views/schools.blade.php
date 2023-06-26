<!-- schools.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Données groupées par école</title>
</head>

<body>
    <h1>Données groupées par école</h1>
    @foreach ($groupedData as $school => $data)
        <h2>{{ $school }}</h2>
        <ul>
            @foreach ($data as $item)
                <li>{{ $item['name'] }}, {{ $item['adress'] }}, {{ $item['tel'] }}, {{ $item['email'] }}</li>
            @endforeach
        </ul>
    @endforeach
</body>

</html>
