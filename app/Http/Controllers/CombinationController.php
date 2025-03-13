<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CombinationController extends Controller
{
    public function index()
    {
        return view('combinations.index');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'node_count' => 'required|integer|min:1'
        ]);

        // Start timing
        $startTime = microtime(true);

        $nodeCount = $request->input('node_count');

        // Calculate minimum and maximum total number of connections
        $minConnections = 2 * ($nodeCount - 1);
        $maxConnections = $nodeCount * ($nodeCount - 1);

        // Generate valid random connections
        $validConnections = [];
        while (true) {
            $randomConnections = [];
            for ($i = 0; $i < $nodeCount; $i++) {
                $randomConnections[] = rand(1, 4);
            }

            $totalConnections = array_sum($randomConnections);
            if (($totalConnections % 2 == 0) &&
                ($minConnections <= $totalConnections && $totalConnections <= $maxConnections)) {
                $validConnections = $randomConnections;
                break;
            }
        }

        // Create nodes with their connections
        $nodes = [];
        $nodeLabels = range('A', chr(ord('A') + $nodeCount - 1));

        for ($i = 0; $i < $nodeCount; $i++) {
            $nodes[$nodeLabels[$i]] = [
                'label' => $nodeLabels[$i],
                'connections' => $validConnections[$i],
                'to_choose' => $validConnections[$i],
                'chosen_nodes' => '',
                'final_combination' => $nodeLabels[$i] . ',',
                'priority' => null
            ];
        }

        // Save initial state
        $iterationStates = [
            0 => json_encode($nodes) // Initial state
        ];

        // Process all nodes in order of highest "to_choose" value
        $iteration = 1;
        $processLog = [];

        while (true) {
            // Find node with highest "to_choose" value
            $maxToChoose = 0;
            $nodesWithMax = [];

            foreach ($nodes as $label => $node) {
                if ($node['to_choose'] > $maxToChoose) {
                    $maxToChoose = $node['to_choose'];
                    $nodesWithMax = [$label];
                } elseif ($node['to_choose'] == $maxToChoose && $maxToChoose > 0) {
                    $nodesWithMax[] = $label;
                }
            }

            // If no nodes left to process, break the loop
            if ($maxToChoose == 0 || empty($nodesWithMax)) {
                break;
            }

            // Randomly select one if there are multiple nodes with the same max
            $selectedLabel = $nodesWithMax[array_rand($nodesWithMax)];

            // Set priority and note how it was selected
            if (count($nodesWithMax) == 1) {
                $nodes[$selectedLabel]['priority'] = "$iteration (highest)";
            } else {
                $otherNodes = [];
                foreach ($nodesWithMax as $label) {
                    if ($label != $selectedLabel) {
                        $otherNodes[] = $label;
                    }
                }
                $nodes[$selectedLabel]['priority'] = "$iteration (randomly prioritized over node " . implode(", ", $otherNodes) . ")";
            }

            // Process the selected node
            $connectionsNeeded = $nodes[$selectedLabel]['to_choose'];
            $availableNodes = [];

            // Find available nodes (those with to_choose > 0, excluding the selected node)
            foreach ($nodes as $label => $node) {
                if ($label != $selectedLabel && $node['to_choose'] > 0) {
                    $availableNodes[] = $label;
                }
            }

            // Randomly select nodes to connect with, up to the number of connections needed
            $chosenNodes = [];
            shuffle($availableNodes); // Randomize the order

            // Take only as many nodes as needed or available
            $nodesToConnect = min(count($availableNodes), $connectionsNeeded);
            for ($i = 0; $i < $nodesToConnect; $i++) {
                $chosenNodes[] = $availableNodes[$i];
            }

            // Update the chosen nodes for the selected node
            $nodes[$selectedLabel]['chosen_nodes'] = implode(',', $chosenNodes);

            // Update the final combination for the selected node
            $finalCombination = $nodes[$selectedLabel]['final_combination'];
            foreach ($chosenNodes as $chosenLabel) {
                if (strpos($finalCombination, $chosenLabel . ',') === false) {
                    // Add comma before the node label except for the first one
                    if (strlen($finalCombination) > 0 && substr($finalCombination, -1) != ',') {
                        $finalCombination .= ',';
                    }
                    $finalCombination .= $chosenLabel;
                }
            }
            $nodes[$selectedLabel]['final_combination'] = $finalCombination;

            // Update the final combination and to_choose for the chosen nodes
            foreach ($chosenNodes as $chosenLabel) {
                // Update final combination
                if (strpos($nodes[$chosenLabel]['final_combination'], $selectedLabel . ',') === false) {
                    // Add comma before the node label except for the first one
                    if (strlen($nodes[$chosenLabel]['final_combination']) > 0 &&
                        substr($nodes[$chosenLabel]['final_combination'], -1) != ',') {
                        $nodes[$chosenLabel]['final_combination'] .= ',';
                    }
                    $nodes[$chosenLabel]['final_combination'] .= $selectedLabel;
                }

                // Decrement to_choose
                $nodes[$chosenLabel]['to_choose']--;

                // If to_choose is 0 and chosen_nodes is empty, mark with X
                if ($nodes[$chosenLabel]['to_choose'] == 0 && empty($nodes[$chosenLabel]['chosen_nodes'])) {
                    $nodes[$chosenLabel]['chosen_nodes'] = 'X';
                }
            }

            // Decrement to_choose for the selected node
            $nodes[$selectedLabel]['to_choose'] -= count($chosenNodes);

            // If to_choose is 0 and chosen_nodes doesn't contain actual nodes, mark with X
            if ($nodes[$selectedLabel]['to_choose'] == 0 &&
                (empty($nodes[$selectedLabel]['chosen_nodes']) || $nodes[$selectedLabel]['chosen_nodes'] == '')) {
                $nodes[$selectedLabel]['chosen_nodes'] = 'X';
            }

            // Log this iteration
            $processLog[] = [
                'iteration' => $iteration,
                'selected_node' => $selectedLabel,
                'chosen_nodes' => $chosenNodes
            ];

            // Save the state after this iteration
            $iterationStates[$iteration] = json_encode($nodes);

            // Increment iteration counter
            $iteration++;
        }

            // Calculate processing time
            $endTime = microtime(true);
            $processingTime = round(($endTime - $startTime) * 1000, 2); // Time in milliseconds

            // Create a structured representation for visualization
            $connections = [];
            foreach ($nodes as $node) {
                $label = $node['label'];
                $connectedNodes = explode(',', $node['final_combination']);

                // Remove the node itself from its connections
                $connectedNodes = array_filter($connectedNodes, function($item) use ($label) {
                    return $item !== $label && $item !== '';
                });

                $connections[$label] = array_values($connectedNodes);
            }

            // Convert to JSON for easy parsing in JavaScript
            $connectionsJson = json_encode($connections);


        // Créer les données du graphe
        $graphNodes = [];
        $graphEdges = [];

        foreach ($nodes as $node) {
            $graphNodes[] = [
                'data' => ['id' => $node['label'], 'label' => $node['label']]
            ];

            $chosenNodes = explode(',', rtrim($node['final_combination'], ','));

            foreach ($chosenNodes as $chosenNode) {
                if ($chosenNode != $node['label']) {
                    $graphEdges[] = [
                        'data' => ['source' => $node['label'], 'target' => $chosenNode]
                    ];
                }
            }
        };
        return view('combinations.result', [
            'nodes' => $nodes,
            'nodeCount' => $nodeCount,
            'minConnections' => $minConnections,
            'maxConnections' => $maxConnections,
            'totalConnections' => array_sum($validConnections),
            'processLog' => $processLog,
            'iterations' => $iteration - 1,
            'iterationStates' => $iterationStates,
            'processingTime' => $processingTime,
            'connectionsJson' => $connectionsJson, // debug in console log
            'graphNodes' => $graphNodes, // Passer les nœuds au frontend
            'graphEdges' => $graphEdges  // Passer les bords au frontend
        ]);
    }
}