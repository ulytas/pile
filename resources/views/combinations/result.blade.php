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
            
            <div id="graph-container" style="width: 100%; height: 400px; border: 1px solid #ddd;"></div>

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

            
            <a href="/" class="generate-btn">Generate </a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cytoscape/3.21.0/cytoscape.min.js"></script>
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
            document.getElementById('graph-container').style.display = 'block'; // Show the graph container for final result
            generateGraph(); // Generate graph only at final iteration
        } else {
            display.textContent = `Iteration ${currentIteration}`;
            document.getElementById('graph-container').style.display = 'none'; // Hide graph for other iterations
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

    // Récupérer les données depuis Laravel
    const nodes = @json($graphNodes);
    const edges = @json($graphEdges);

    // Initialiser Cytoscape.js uniquement à la combinaison finale
  function generateGraph() {
    const cy = cytoscape({
        container: document.getElementById('graph-container'), // Le conteneur du graphe

        elements: [
            ...nodes,
            ...edges
        ],

        style: [
            {
                selector: 'node',
                style: {
                    'background-color': '#0074D9',
                    'label': 'data(label)',
                    'color': '#fff',
                    'text-valign': 'center',
                    'text-halign': 'center',
                    'width': '30px',
                    'height': '30px'
                }
            },
            {
                selector: 'edge',
                style: {
                    'width': 3,
                    'line-color': '#ccc',
                    'target-arrow-color': '#ccc',
                    'target-arrow-shape': 'triangle'
                }
            }
        ],

        layout: {
            name: 'grid', // Choisir un agencement de graphe
            rows: 2
        }
    });

    // Gestion du clic sur un nœud
    cy.on('tap', 'node', function(event) {
        const node = event.target;  // Le nœud cliqué
        const connectedEdges = node.connectedEdges();  // Récupère toutes les arêtes connectées à ce nœud

        // Change la couleur des arêtes connectées
        connectedEdges.style({
            'line-color': '#FF5733',  // Nouvelle couleur pour les arêtes
            'target-arrow-color': '#FF5733',  // Change la couleur de la flèche des arêtes
            'width': 4  // Épaisseur des arêtes
        }).update();

        // Change aussi la couleur du nœud cliqué pour le mettre en évidence
        node.style({
            'background-color': '#FF5733'  // Nouvelle couleur du nœud
        }).update();

        // Réinitialise les styles des autres nœuds et arêtes
        cy.nodes().not(node).style({
            'background-color': '#0074D9'  // Couleur d'origine du nœud
        }).update();

        cy.edges().not(connectedEdges).style({
            'line-color': '#ccc',  // Couleur d'origine des arêtes
            'target-arrow-color': '#ccc',
            'width': 3  // Épaisseur d'origine des arêtes
        }).update();
    });
}


    // Initialize with final result
    updateControls();
</script>

</body>
</html>


