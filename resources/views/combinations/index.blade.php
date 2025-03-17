<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pile</title>
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
        label, button {
            margin: 10px 0;
            display: block;
        }
        input[type="number"] {
            margin: 10px 0;
            padding: 8px;
            width: 80px;
        }
        button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .slider-container {
            width: 100%;
            margin: 20px 0;
        }
        .slider {
            -webkit-appearance: none;
            width: 100%;
            height: 15px;
            border-radius: 5px;
            background: #d3d3d3;
            outline: none;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
            margin-bottom: 10px;
        }
        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #4CAF50;
            cursor: pointer;
        }
        .slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #4CAF50;
            cursor: pointer;
        }
        .input-group {
            display: flex;
            align-items: center;
        }
        .input-group input[type="number"] {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <h1>Network Topology and Routing Simulator</h1>

    <form action="{{ route('generate.combination') }}" method="POST">
        @csrf
        <div>
            <label for="node_count">Enter number of nodes (3-20):</label>
            <div class="slider-container">
                <input type="range" min="3" max="20" value="10" class="slider" id="node_range">
                <div class="input-group">
                    <span>Value:</span>
                    <input type="number" id="node_count" name="node_count" min="3" max="20" value="10" required>
                </div>
            </div>
        </div>
        <button type="submit">Generate</button>
    </form>

    <script>
        // JavaScript to synchronize the slider and number input
        const rangeSlider = document.getElementById("node_range");
        const numberInput = document.getElementById("node_count");

        // Update number input when slider changes
        rangeSlider.oninput = function() {
            numberInput.value = this.value;
        }

        // Update slider when number input changes
        numberInput.oninput = function() {
            // Ensure value is within range
            if (this.value > 20) this.value = 20;
            if (this.value < 1) this.value = 1;

            rangeSlider.value = this.value;
        }
    </script>
</body>
</html>