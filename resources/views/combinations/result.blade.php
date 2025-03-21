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
            margin-bottom: 20px;
        }
        .summary-content {
            background-color: #e7f3fe;
            border-left: 6px solid #2196F3;
            padding: 15px;
        }
        .table-container {
            flex: 2;
            min-width: 400px;
        }
        .log {
            display: flex;
            flex-direction: column;
            height: 100%;
            overflow: hidden;
        }
        .log-title {
            position: sticky;
            top: 0;
            background-color: white;
            margin-top: 0;
            margin-bottom: 20px;
            padding-top: 0; /* Remove the extra padding */
            z-index: 5;
        }
        .log-entries {
            overflow-y: auto;
            overflow-x: hidden;
            max-height: 500px; /* Adjust this value as needed */
            padding-right: 10px; /* Add some padding to account for scrollbar */
        }
        .log-entry {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 4px;
            cursor: pointer;
            word-wrap: break-word;
            overflow-wrap: break-word;
            width: 100%;
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
        /* Change color of selected iteration */
        .log-entry.active {
            border-left-width: 8px;
            font-weight: bold;
            /* background-color: #e0f7fa;
            border-left: 4px solid #00bcd4; */
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
        /* Old style not aligned with Title, top left corner */
        /* .generate-btn {
            display: inline-block;
            margin: 20px 0;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            position: absolute;
            top: 20px;
            left: 20px;
        } */
        /* Aligned with Node Configuration */
        .generate-btn {
            display: inline-block;
            text-decoration: none;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
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
        /* footer style 2025 Network Topology Simulator Github */
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
        .contact-link a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-link a:hover {
            color: #0366d6;
            text-decoration: underline;
        }

        .copyright svg {
            margin-left: 8px;
            vertical-align: middle;
        }

        #clear-history {
            padding: 5px 10px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #clear-history:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <h1>Network Topology and Routing Simulator</h1>

        <div class="container">
        <!-- Summary on the left -->
        <div class="summary">
        <h2>Summary</h2>
            <div class="summary-content">
                <p><strong>Number of nodes:</strong> {{ $nodeCount }}</p>
                <p><strong>Network diameter:</strong> <span id="network-diameter">Calculating...</span></p>
                <p><strong>Minimum connections required:</strong> {{ $minConnections }}</p>
                <p><strong>Maximum possible connections:</strong> {{ $maxConnections }}</p>
                <p><strong>Total connections generated:</strong> {{ $totalConnections }}</p>
                <p><strong>Total iterations completed:</strong> {{ $iterations }}</p>
                <p><strong>Processing time:</strong> {{ $processingTime }} ms</p>
                <p><strong>Regeneration attempts:</strong> {{ $regenerationAttempts }}</p>
            </div>
<p></p>
<h2 style="display: flex; justify-content: space-between; align-items: center;">
  History
  <button id="clear-history" class="btn btn-sm btn-danger">Clear History</button>
</h2>
            <div class="summary-content">
                <p>This simulation was created on {{ date('F j, Y, g:i a') }}</p>
                <p>Previous simulations: <span id="simulation-count">0</span></p>
                <div id="previous-simulations">
                    <!-- This will be populated from localStorage -->
                    <p>No previous simulations found</p>
                </div>
            </div>
        </div>

        <!-- Table in the center -->
        <div class="table-container">
        <h2 style="display: flex; justify-content: space-between; align-items: center;">
            Node Configuration
            <a href="/" class="generate-btn">Generate Another</a>
        </h2>

            <div class="iteration-controls">
                <button id="prev-btn" class="iteration-btn" disabled>&larr; Previous</button>
                <div id="iteration-display" class="iteration-display">Final State</div>
                <button id="next-btn" class="iteration-btn" disabled>Next &rarr;</button>
            </div>

            <div id="graph-container" style="width: 100%; height: 400px; border: 1px solid #ddd;"></div>

            <table id="nodes-table">
                <thead>
                    <tr>
                        <th>Node</th>
                        <th>Connection (random)</th>
                        <th>Nodes available</th>
                        <th>Nodes chosen</th>
                        <th>Final combination</th>
                        <th>Priority</th>
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

            <!-- <a href="/" class="generate-btn">Generate Another</a> -->
        </div>

    <!-- Process log on the right -->
    <div class="log">
        <h2 class="log-title">Process Log</h2>
        <div class="log-entries">
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
                <p><strong>Final State</strong></p>
            </div>
        </div>
    </div>
    </div>
    <footer class="footer">
    <div class="footer-content">
        <div class="copyright">
            © 2025 Network Topology and Routing Simulator
            <div class="contact-link">
                <a href="mailto:contact@ulytas.com">Contact us</a>
            </div>
        </div>
        <div class="github-link">
            <a href="https://github.com/Ulytas/pile" target="_blank" rel="noopener noreferrer">
                <svg height="24" width="24" viewBox="0 0 16 16" version="1.1">
                    <path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"></path>
                </svg>
            </a>
        </div>
    </div>
</footer>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/cytoscape/3.21.0/cytoscape.min.js"></script> -->
Cytoscape.js
<script src="https://unpkg.com/cytoscape/dist/cytoscape.min.js"></script>
<script src="https://unpkg.com/layout-base/layout-base.js"></script>
<script src="https://unpkg.com/cose-base/cose-base.js"></script>
<script src="https://unpkg.com/cytoscape-fcose/cytoscape-fcose.js"></script>
    <script>
        // Calculer le diamètre du réseau et les nœuds les plus éloignés
function calculateNetworkDiameter() {
    let maxDistance = 0;
    let farthestNodes = { source: null, target: null };

    // Pour chaque paire de nœuds
    cy.nodes().forEach(function(source) {
        // Utiliser l'algorithme de Dijkstra pour calculer les plus courts chemins
        const dijkstra = cy.elements().dijkstra({
            root: source,
            weight: function(edge) {
                return 1; // Poids uniforme pour chaque arête
            }
        });

        // Vérifier la distance à tous les autres nœuds
        cy.nodes().forEach(function(target) {
            if (source.id() !== target.id()) {
                const path = dijkstra.pathTo(target);
                // Le nombre de sauts est le nombre d'arêtes dans le chemin
                const hops = path.edges().length;

                if (hops > maxDistance) {
                    maxDistance = hops;
                    farthestNodes = {
                        source: source,
                        target: target
                    };
                }
            }
        });
    });

    return {
        diameter: maxDistance,
        farthestNodes: farthestNodes
    };
}
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

// Récupérer les données depuis Laravel
const nodes = @json($graphNodes);
const edges = @json($graphEdges);
// Variable to track the currently highlighted node
let highlightedNode = null;
// Variables pour suivre les nœuds sélectionnés
let firstNode = null;
let secondNode = null;
let highlightedPath = null;

// Initialiser Cytoscape.js uniquement à la combinaison finale
function generateGraph() {
// Create the control buttons if they don't exist
if (!document.querySelector('.graph-controls')) {
    const controlsContainer = document.createElement('div');
    controlsContainer.className = 'graph-controls';
    controlsContainer.innerHTML = `
        <button id="zoom-in-btn">+</button>
        <button id="zoom-out-btn">-</button>
        <button id="fit-btn">Fit</button>
        <button id="export-btn">Export PNG</button>
    `;

    // Insert after the graph container
    const graphContainer = document.getElementById('graph-container');
    graphContainer.parentNode.insertBefore(controlsContainer, graphContainer.nextSibling);
}

    // Initialize Cytoscape
    window.cy = cytoscape({
        container: document.getElementById('graph-container'),
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
        // layout: {
        //     name: 'grid',
        //     rows: 2,
        //     padding: 30
        // }
//         layout: {
//   name: 'cose',
//   idealEdgeLength: 100,
//   nodeOverlap: 20,
//   refresh: 20,
//   fit: true,
//   padding: 30,
//   randomize: true,
//   componentSpacing: 100,
//   nodeRepulsion: 400000,
//   edgeElasticity: 100,
//   nestingFactor: 5,
//   gravity: 80,
//   numIter: 1000,
//   initialTemp: 200,
//   coolingFactor: 0.95,
//   minTemp: 1.0
// }
layout: {
    name: 'fcose',
    // Quality settings
    quality: "default",
    randomize: true, // Equivalent to "Incremental" being checked
    animate: false,
    fit: true,
    uniformNodeDimensions: false,
    packComponents: true, // "Pack Components to Window"
    tile: true, // "Tile Disconnected"

    // Force parameters
    nodeRepulsion: 4500,
    idealEdgeLength: 50,
    edgeElasticity: 0.45,
    nestingFactor: 0.1,
    gravity: 0.25,
    gravityRange: 3.8,
    gravityCompound: 1.0, // "Compound Gravity"
    gravityRangeCompound: 1.5, // "Compound Gravity Range"

    // Iterations
    numIter: 2500,

    // Tiling parameters
    tilingPaddingVertical: 10,
    tilingPaddingHorizontal: 10,

    // Incremental layout settings
    initialEnergyOnIncremental: 0.3 // "Incremental Cooling Factor"
}
    });

    // Disable default zoom behavior
    cy.userZoomingEnabled(false);

    // Add event listeners for the control buttons
    document.getElementById('zoom-in-btn').addEventListener('click', function() {
        cy.zoom(cy.zoom() * 1.2);
        cy.center();
    });

    document.getElementById('zoom-out-btn').addEventListener('click', function() {
        cy.zoom(cy.zoom() * 0.8);
        cy.center();
    });

    document.getElementById('fit-btn').addEventListener('click', function() {
        cy.fit();
    });

    document.getElementById('export-btn').addEventListener('click', function() {
        const png = cy.png({scale: 2, full: true, output: 'blob'});
        const url = URL.createObjectURL(png);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'network-graph.png';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    });

// Variables pour suivre les nœuds sélectionnés
let firstNode = null;
let secondNode = null;
let highlightedPath = null;

// Remplacer votre gestionnaire d'événements actuel par celui-ci
cy.on('tap', 'node', function(event) {
    const node = event.target;  // Le nœud cliqué

    // Premier cas: aucun nœud n'est sélectionné
    if (firstNode === null) {
        // Réinitialiser les couleurs des arêtes seulement
        cy.edges().style({
            'line-color': '#ccc',
            'target-arrow-color': '#ccc',
            'width': 3
        });

        // Réinitialiser les couleurs des nœuds seulement
        cy.nodes().style({
            'background-color': '#0074D9'
        });

        // Mettre en évidence le premier nœud en orange
        node.style({
            'background-color': '#FF5733'
        });

        // Mettre en évidence les connexions du premier nœud
        const connectedEdges = node.connectedEdges();
        connectedEdges.style({
            'line-color': '#FF5733',
            'target-arrow-color': '#FF5733',
            'width': 4
        });

        firstNode = node;
        secondNode = null;
        highlightedPath = null;
    }
// Dans le cas où un deuxième nœud est sélectionné
else if (firstNode !== null && secondNode === null && node !== firstNode) {
    // Réinitialiser les styles des arêtes
    cy.edges().style({
        'line-color': '#ccc',
        'target-arrow-color': '#ccc',
        'width': 3
    });

    secondNode = node;

    // Utiliser l'algorithme de Dijkstra pour trouver le chemin le plus court
    const dijkstra = cy.elements().dijkstra({
        root: firstNode,
        weight: function(edge) {
            return 1;  // Poids uniforme pour chaque arête
        }
    });

    // Obtenir le chemin le plus court
    const path = dijkstra.pathTo(secondNode);

    // Mettre en évidence TOUTES les arêtes du chemin en vert
    path.edges().style({
        'line-color': '#4CAF50',  // Vert
        'target-arrow-color': '#4CAF50',
        'width': 4
    });

    // Mettre en évidence TOUS les nœuds du chemin en vert
    path.nodes().style({
        'background-color': '#4CAF50'  // Vert
    });

    highlightedPath = path;
}

    // Troisième cas: deux nœuds sont sélectionnés ou on clique sur le même nœud
    else {
        // Réinitialiser les couleurs des arêtes seulement
        cy.edges().style({
            'line-color': '#ccc',
            'target-arrow-color': '#ccc',
            'width': 3
        });

        // Réinitialiser les couleurs des nœuds seulement
        cy.nodes().style({
            'background-color': '#0074D9'
        });

        // Mettre en évidence le nouveau premier nœud en orange
        node.style({
            'background-color': '#FF5733'
        });

        // Mettre en évidence les connexions du nouveau premier nœud
        const connectedEdges = node.connectedEdges();
        connectedEdges.style({
            'line-color': '#FF5733',
            'target-arrow-color': '#FF5733',
            'width': 4
        });

        firstNode = node;
        secondNode = null;
        highlightedPath = null;
    }
});


    // Add some CSS for the controls
    const style = document.createElement('style');
    style.textContent = `
    .graph-controls {
        position: relative;
        display: flex;
        justify-content: center;
        margin: 10px 0;
        z-index: 10;
    }
    .graph-controls button {
        margin: 0 5px;
        padding: 5px 10px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 3px;
        cursor: pointer;
    }
    .graph-controls button:hover {
        background-color: #f0f0f0;
    }
`;
    document.head.appendChild(style);
// Calculer le diamètre du réseau
const networkInfo = calculateNetworkDiameter();

// Mettre en évidence les nœuds les plus éloignés en rouge
if (networkInfo.farthestNodes.source && networkInfo.farthestNodes.target) {
    networkInfo.farthestNodes.source.style({
        'background-color': '#FF0000'  // Rouge
    });
    networkInfo.farthestNodes.target.style({
        'background-color': '#FF0000'  // Rouge
    });
}
// Mettre à jour le summary
const sourceLabel = networkInfo.farthestNodes.source.data('label');
const targetLabel = networkInfo.farthestNodes.target.data('label');
document.getElementById('network-diameter').textContent =
    `${networkInfo.diameter} hops (from node ${sourceLabel} to ${targetLabel})`;
    return cy;
}

function updateControls() {
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const display = document.getElementById('iteration-display');
    const graphContainer = document.getElementById('graph-container');
    const graphControls = document.querySelector('.graph-controls');

    prevBtn.disabled = currentIteration <= 0;
    nextBtn.disabled = currentIteration >= maxIteration;

    // Set button visibility
    if (currentIteration === 0) {
        prevBtn.style.visibility = 'hidden';
        nextBtn.style.visibility = 'visible';
    } else if (currentIteration === maxIteration) {
        prevBtn.style.visibility = 'visible';
        nextBtn.style.visibility = 'hidden';
    } else {
        prevBtn.style.visibility = 'visible';
        nextBtn.style.visibility = 'visible';
    }

    // Show/hide graph controls based on current iteration
    if (graphControls) {
        if (currentIteration === maxIteration) {
            graphControls.style.display = 'flex'; // Show controls in Final State
        } else {
            graphControls.style.display = 'none'; // Hide controls in other iterations
        }
    }

    // Update display text and handle graph
    if (currentIteration === 0) {
        display.textContent = 'Initial State';
        graphContainer.style.display = 'none';
    } else if (currentIteration === maxIteration) {
        display.textContent = 'Final State';

        // Clear the graph container completely
        graphContainer.innerHTML = '';
        graphContainer.style.display = 'block';

        // Generate new graph and force resize
        generateGraph();

        // Force resize after the container is visible
        setTimeout(function() {
            if (window.cy) {
                window.cy.resize();
                window.cy.fit();
            }
        }, 50);
    } else {
        display.textContent = `Iteration ${currentIteration}`;
        graphContainer.style.display = 'none';
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

        // Initialize with final result
        showIteration(currentIteration);

        // Log the connections data to console
        document.addEventListener('DOMContentLoaded', function() {
            const connectionsData = JSON.parse(document.getElementById('connections-data').dataset.connections);
            console.log('Network Connections Data:', connectionsData);
        });


// History management
document.addEventListener('DOMContentLoaded', function() {
    try {
        // Load simulation history from localStorage
        let simulations = [];
        try {
            const stored = localStorage.getItem('simulations');
            if (stored) {
                simulations = JSON.parse(stored);
            }
        } catch (e) {
            console.error("Error loading simulations from localStorage:", e);
            simulations = [];
        }

        // Add current simulation to history
        const currentSimulation = {
            date: '{{ date('F j, Y, g:i a') }}',
            nodeCount: {{ $nodeCount }},
            connections: {{ $totalConnections }}
        };

        // Check if this is a new simulation (avoid duplicates on page refresh)
        let isDuplicate = false;
        if (simulations.length > 0) {
            const latest = simulations[0];
            isDuplicate = latest.date === currentSimulation.date &&
                          latest.nodeCount === currentSimulation.nodeCount &&
                          latest.connections === currentSimulation.connections;
        }

        if (!isDuplicate) {
            // Add to beginning of array
            simulations.unshift(currentSimulation);

            // Keep only last 5 simulations
            if (simulations.length > 5) {
                simulations = simulations.slice(0, 5);
            }

            // Save back to localStorage
            try {
                localStorage.setItem('simulations', JSON.stringify(simulations));
            } catch (e) {
                console.error("Error saving simulations to localStorage:", e);
            }
        }

        // Update the history section
        updateHistoryDisplay(simulations);

        // Add event listener for clear button
        const clearBtn = document.getElementById('clear-history');
        if (clearBtn) {
            clearBtn.addEventListener('click', function() {
                try {
                    localStorage.removeItem('simulations');
                } catch (e) {
                    console.error("Error clearing simulations from localStorage:", e);
                }
                updateHistoryDisplay([]);
            });
        }
    } catch (e) {
        console.error("Error in history management:", e);
    }
});

function updateHistoryDisplay(simulations) {
    try {
        const simulationCount = document.getElementById('simulation-count');
        const previousSimulations = document.getElementById('previous-simulations');

        if (!simulationCount || !previousSimulations) return;

        // Update count (excluding current simulation)
        simulationCount.textContent = Math.max(0, simulations.length - 1);

        if (simulations.length <= 1) {
            previousSimulations.innerHTML = '<p>No previous simulations found</p>';
        } else {
            let historyHTML = '';
            // Skip the first one (current simulation)
            for (let i = 1; i < simulations.length; i++) {
                const sim = simulations[i];
                historyHTML += `<p>${sim.date}: ${sim.nodeCount} nodes, ${sim.connections} connections</p>`;
            }
            previousSimulations.innerHTML = historyHTML;
        }
    } catch (e) {
        console.error("Error updating history display:", e);
    }
}

    </script>
    <div id="connections-data" data-connections="{{ $connectionsJson }}" style="display: none;"></div>
</body>
</html>