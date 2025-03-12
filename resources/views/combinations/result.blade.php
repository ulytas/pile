<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated Nodes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .summary {
            flex: 1;
            min-width: 200px;
            background-color: #e7f3fe;
            border-left: 6px solid #2196F3;
            padding: 15px;
            margin-bottom: 20px;
        }
        .table-container {
            flex: 2;
            min-width: 400px;
        }
        .log {
            flex: 1;
            min-width: 200px;
            max-height: 600px;
            overflow-y: auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        h2 {
            margin-top: 0;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .generate-btn {
            display: block;
            margin: 20px auto;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            max-width: 200px;
        }
        .log-entry {
            padding: 10px;
            margin: 5px 0;
            border-left: 4px solid #ccc;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .log-entry:hover {
            transform: translateX(5px);
        }
        .log-entry.active {
            border-left-width: 8px;
            font-weight: bold;
        }
        .iteration-1 { background-color: #ffffcc; }
        .iteration-2 { background-color: #e6ffe6; }
        .iteration-3 { background-color: #e6f3ff; }
        .iteration-4 { background-color: #ffe6e6; }
        .iteration-5 { background-color: #f2e6ff; }
        .iteration-6 { background-color: #fff2e6; }
        .iteration-7 { background-color: #e6fff2; }
        .iteration-8 { background-color: #ffe6f2; }
        .iteration-9 { background-color: #f2ffe6; }
        .iteration-10 { background-color: #e6e6ff; }
        .iteration-controls {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .iteration-btn {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .iteration-display {
            padding: 5px 10px;
            background-color: #f2f2f2;
            border-radius: 4px;
            font-weight: bold;
        }
        // footer style 2025 Network Topology Simulator Github
        .footer {
            margin-top: 40px;
            padding: 20px 0;
            border-top: 1px solid #eaeaea;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .footer-content {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }
        .github-link a {
            display: flex;
            align-items: center;
            color: #333;
            transition: color 0.3s ease;
        }
        .github-link a:hover {
            color: #0366d6;
        }
        .github-link svg {
            fill: currentColor;
        }
    </style>
</head>
<body>
    <h1>Node Combination Generator</h1>
    
    <div class="container">
        <!-- Summary on the left -->
        <div class="summary">
            <h2>Summary</h2>
            <p><strong>Number of nodes:</strong> {{ $nodeCount }}</p>
            <p><strong>Minimum connections required:</strong> {{ $minConnections }}</p>
            <p><strong>Maximum possible connections:</strong> {{ $maxConnections }}</p>
            <p><strong>Total connections generated:</strong> {{ $totalConnections }} (valid: even and within range)</p>
            <p><strong>Total iterations completed:</strong> {{ $iterations }}</p>
        </div>
        
        <!-- Table in the center -->
        <div class="table-container">
            <h2>Node Configuration</h2>
            
            <div class="iteration-controls">
                <button id="prev-btn" class="iteration-btn" disabled>&larr; Previous</button>
                <div id="iteration-display" class="iteration-display">Final Result</div>
                <button id="next-btn" class="iteration-btn" disabled>Next &rarr;</button>
            </div>
            
            <table id="nodes-table">
                <thead>
                    <tr>
                        <th>Noeud</th>
                        <th>Connexion (random)</th>
                        <th>Noeud à choisir</th>
                        <th>Noeuds choisis</th>
                        <th>Combinaison finale</th>
                        <th>Priorité</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nodes as $node)
                    <tr class="{{ !empty($node['priority']) ? 'iteration-'.substr($node['priority'], 0, 1) : '' }}">
                        <td>{{ $node['label'] }}</td>
                        <td>{{ $node['connections'] }}</td>
                        <td>{{ $node['to_choose'] }}</td>
                        <td>{{ $node['chosen_nodes'] }}</td>
                        <td>{{ $node['final_combination'] }}</td>
                        <td>{{ $node['priority'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <a href="/" class="generate-btn">Generate Another</a>
        </div>
        
        <!-- Process log on the right -->
        <div class="log">
            <h2>Process Log</h2>
            <div class="log-entry" onclick="showIteration(0)">
                <p><strong>Initial State</strong></p>
            </div>
            @foreach($processLog as $log)
            <div class="log-entry iteration-{{ $log['iteration'] }}" onclick="showIteration({{ $log['iteration'] }})">
                <p><strong>Iteration {{ $log['iteration'] }}:</strong> Selected node {{ $log['selected_node'] }} and connected with 
                @if(count($log['chosen_nodes']) > 0)
                    {{ implode(', ', $log['chosen_nodes']) }}
                @else
                    no nodes (all connections already made)
                @endif
                </p>
            </div>
            @endforeach
            <div class="log-entry" onclick="showIteration({{ $iterations + 1 }})">
                <p><strong>Final Result</strong></p>
            </div>
        </div>
    </div>
    <footer class="footer">
    <div class="footer-content">
        <div class="copyright">© 2025 Network Topology Simulator</div>
        <div class="github-link">
            <a href="https://github.com/Ulytas/pile" target="_blank" rel="noopener noreferrer">
                <svg height="24" width="24" viewBox="0 0 16 16" version="1.1">
                    <path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"></path>
                </svg>
            </a>
        </div>
    </div>
</footer>

    <script>
        // Store all iteration states
        const iterationStates = {
            @foreach($iterationStates as $iteration => $state)
                {{ $iteration }}: {!! $state !!},
            @endforeach
            {{ $iterations + 1 }}: {!! json_encode($nodes) !!} // Final state
        };
        
        let currentIteration = {{ $iterations + 1 }}; // Start with final result
        const maxIteration = {{ $iterations + 1 }};
        
        function updateTable(iteration) {
            const tableBody = document.querySelector('#nodes-table tbody');
            tableBody.innerHTML = '';
            
            const state = iterationStates[iteration];
            
            for (const [label, node] of Object.entries(state)) {
                const row = document.createElement('tr');
                
                if (node.priority) {
                    const iterationNum = node.priority.charAt(0);
                    row.classList.add(`iteration-${iterationNum}`);
                }
                
                row.innerHTML = `
                    <td>${node.label}</td>
                    <td>${node.connections}</td>
                    <td>${node.to_choose}</td>
                    <td>${node.chosen_nodes}</td>
                    <td>${node.final_combination}</td>
                    <td>${node.priority || ''}</td>
                `;
                
                tableBody.appendChild(row);
            }
        }
        
        function updateControls() {
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const display = document.getElementById('iteration-display');
            
            prevBtn.disabled = currentIteration <= 0;
            nextBtn.disabled = currentIteration >= maxIteration;
            
            if (currentIteration === 0) {
                display.textContent = 'Initial State';
            } else if (currentIteration === maxIteration) {
                display.textContent = 'Final Result';
            } else {
                display.textContent = `Iteration ${currentIteration}`;
            }
            
            // Update active log entry
            const logEntries = document.querySelectorAll('.log-entry');
            logEntries.forEach(entry => entry.classList.remove('active'));
            
            if (currentIteration === maxIteration) {
                logEntries[logEntries.length - 1].classList.add('active');
            } else {
                logEntries[currentIteration].classList.add('active');
            }
        }
        
        function showIteration(iteration) {
            currentIteration = iteration;
            updateTable(iteration);
            updateControls();
        }
        
        // Set up event listeners
        document.getElementById('prev-btn').addEventListener('click', () => {
            if (currentIteration > 0) {
                showIteration(currentIteration - 1);
            }
        });
        
        document.getElementById('next-btn').addEventListener('click', () => {
            if (currentIteration < maxIteration) {
                showIteration(currentIteration + 1);
            }
        });
        
        // Initialize with final result
        updateControls();
    </script>
</body>
</html>

