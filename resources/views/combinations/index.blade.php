<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Node Combination Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        label, input, button {
            margin: 10px 0;
            display: block;
        }
        button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Node Combination Generator</h1>
    
    <form action="{{ route('generate.combination') }}" method="POST">
        @csrf
        <div>
            <label for="node_count">Enter number of nodes:</label>
            <input type="number" id="node_count" name="node_count" min="1" required>
        </div>
        <button type="submit">Generate</button>
    </form>
</body>
</html>

