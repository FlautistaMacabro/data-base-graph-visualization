/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Main.java to edit this template
 */
package main;

import com.brunomnsilva.smartgraph.graph.Graph;
import com.brunomnsilva.smartgraph.graph.GraphEdgeList;
import com.brunomnsilva.smartgraph.graphview.SmartCircularSortedPlacementStrategy;
import com.brunomnsilva.smartgraph.graphview.SmartGraphPanel;
import com.brunomnsilva.smartgraph.graphview.SmartPlacementStrategy;
import javafx.application.Application;
import javafx.scene.Scene;
import javafx.stage.Stage;

/**
 *
 * @author vinip
 */
public class Main extends Application {

  /**
   * @param args the command line arguments
   */
  public static void main(String[] args) {
    launch(args);
  }

  @Override
  public void start(Stage stage) throws Exception {
    //create the graph
    Graph<String, String> g = new GraphEdgeList<>();
    //... see example below

    g.insertVertex("A");
    g.insertVertex("B");
    g.insertVertex("C");
    g.insertVertex("D");
    g.insertVertex("E");
    g.insertVertex("F");
    g.insertVertex("G");

    g.insertEdge("A", "B", "1");
    g.insertEdge("A", "C", "2");
    g.insertEdge("A", "D", "3");
    g.insertEdge("A", "E", "4");
    g.insertEdge("A", "F", "5");
    g.insertEdge("A", "G", "6");

    g.insertVertex("H");
    g.insertVertex("I");
    g.insertVertex("J");
    g.insertVertex("K");
    g.insertVertex("L");
    g.insertVertex("M");
    g.insertVertex("N");

    g.insertEdge("H", "I", "7");
    g.insertEdge("H", "J", "8");
    g.insertEdge("H", "K", "9");
    g.insertEdge("H", "L", "10");
    g.insertEdge("H", "M", "11");
    g.insertEdge("H", "N", "12");

    g.insertEdge("A", "H", "0");

    SmartPlacementStrategy strategy = new SmartCircularSortedPlacementStrategy();
    SmartGraphPanel<String, String> graphView = new SmartGraphPanel<>(g, strategy);
    Scene scene = new Scene(graphView, 480, 480);

    stage.setTitle("JavaFXGraph Visualization");
    stage.setScene(scene);
    stage.show();

    //IMPORTANT - Called after scene is displayed so we can have width and height values
    graphView.init();
  }
  
}