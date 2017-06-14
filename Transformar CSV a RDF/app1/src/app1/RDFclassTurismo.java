/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package app1;

import java.io.BufferedReader;
import org.apache.jena.rdf.model.Model;
import org.apache.jena.rdf.model.ModelFactory;
import org.apache.jena.rdf.model.Property;
import org.apache.jena.rdf.model.RDFNode;
import org.apache.jena.rdf.model.Resource;
import org.apache.jena.rdf.model.Statement;
import org.apache.jena.rdf.model.StmtIterator;
import org.apache.jena.vocabulary.RDF;
import org.apache.jena.vocabulary.RDFS;
import org.apache.jena.vocabulary.VCARD;
import org.apache.jena.sparql.vocabulary.FOAF;
//import org.apache.jena.sparq.vocabulary.Turismo;/
import org.apache.jena.rdf.model.RDFWriter;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.IOException;
import java.util.Scanner;
import org.apache.jena.ontology.DatatypeProperty;
import org.apache.jena.ontology.ObjectProperty;
import org.apache.jena.ontology.OntModelSpec;
import static org.apache.jena.riot.system.StreamRDFLib.writer;
import org.apache.jena.vocabulary.DC;

/**
 *
 * @author Turismo - Celly & Guamán
 */
public class RDFclassTurismo {

    public static void main(String[] args) throws FileNotFoundException {
        //create an empty Model
        Model model = ModelFactory.createDefaultModel();
        File f = new File("/Users/leu/Desktop/cantones.rdf"); //Fijar ruta donde se creará el archivo RDF
        FileOutputStream os = new FileOutputStream(f);

        File f2 = new File("/Users/leu/Desktop/lugares.rdf"); //Fijar ruta donde se creará el archivo RDF
        FileOutputStream os2 = new FileOutputStream(f2);

        //Fijar Prefijo para URI base de dos datos a crear 
        String dataPrefix = "http://turismoloja.sbc/data/";
        model.setNsPrefix("myData", dataPrefix);

        String foaf = "http://xmlns.com/foaf/0.1/";
        model.setNsPrefix("foaf", foaf);

     

        String schema = "http://schema.org/";
        model.setNsPrefix("schema", schema);
        // en el caso de vocabularios externos (no incorporados en Jena) se debe crear un modelo
        //DBO
        String dbo = "http://dbpedia.org/ontology/";
        model.setNsPrefix("dbo", dbo);
        Model dboModel = ModelFactory.createDefaultModel();  // modelo para la ontología
        dboModel.read(dbo);
       
        //Cruzar
        String cruzar = "http://idi.fundacionctic.org/cruzar/turismo#";
        model.setNsPrefix("cruzar", cruzar);     
        Model cruzarModel = ModelFactory.createDefaultModel();
        cruzarModel.read(cruzar);

        //Geo
        String geo = "http://www.w3.org/2003/01/geo/wgs84_pos#";
        model.setNsPrefix("geo", geo);     
        Model geoModel = ModelFactory.createDefaultModel();
        geoModel.read(geo);
        
        
        
        Model schemaModel = ModelFactory.createDefaultModel();  // modelo para la ontología
        dboModel.read(schema);
        
        Resource sbc = model.createResource(dboModel + "Canton")
                .addProperty(RDF.type, "http://dbpedia.org/ontology/Canton");

        BufferedReader br = null;
        BufferedReader cn = null;
        try {
              br = new BufferedReader(new FileReader("/Users/leu/Downloads/cantones.csv"));
            String line;
              br.readLine();
            while ((line = br.readLine()) != null) {
                String[] data = line.split(",");
                String uriname = data[0].replaceAll("\\s+", "").replaceAll("\"", "");
                Resource canton01
                        = model.createResource(dbo + uriname)
                                .addProperty(RDF.type, dboModel.getProperty(dbo + "Canton"))
                                .addProperty(schemaModel.getProperty(schema + "name"), data[0].replaceAll("\"", ""))
                                .addProperty(dboModel.getProperty(dbo + "province"), data[1].replaceAll("\"", ""));
                 model.add(canton01, dboModel.getProperty(dbo+"province"), sbc);
            }
            /**/
            cn = new BufferedReader(new FileReader("/Users/leu/Downloads/lugares.csv"));
            String line2;
            cn.readLine();
            while ((line2 = cn.readLine()) != null) {
                String[] data2 = line2.split(",");
                String uriname = data2[0].replaceAll("\\s+", "").replaceAll("\"", "");
                
                String tipo = data2[5].replaceAll("\"", "");
                System.out.println(tipo);
                switch (tipo) {
                    case "Museo":
                       // System.out.println("-------------------");
                        Resource museo
                                = model.createResource(cruzar + uriname)
                                        .addProperty(RDF.type, cruzarModel.getProperty(cruzar + "Museo"))
                                        .addProperty(schemaModel.getProperty(schema + "name"), data2[0].replaceAll("\"", ""))
                                        .addProperty(geoModel.getProperty(geo + "lat"), data2[3])
                                        .addProperty(geoModel.getProperty(geo + "long"), data2[4]);


                        break;
                    case "Edificio Religioso":
                       // System.out.println("+++++++++++++++++++++");
                        Resource EdificioReligioso
                                = model.createResource(cruzar + uriname)
                                        .addProperty(RDF.type, cruzarModel.getProperty(cruzar + "Edificio-religioso"))
                                        .addProperty(schemaModel.getProperty(schema + "name"), data2[0].replaceAll("\"", ""))
                                        .addProperty(geoModel.getProperty(geo + "lat"), data2[3])
                                        .addProperty(geoModel.getProperty(geo + "long"), data2[4]);

                        break;
                    case "Edificio Historico":
                       // System.out.println("=====================");
                        Resource EdificioHistorico
                                = model.createResource(cruzar + uriname)
                                        .addProperty(RDF.type, cruzarModel.getProperty(cruzar + "Edificio-historico"))
                                        .addProperty(schemaModel.getProperty(schema + "name"), data2[0].replaceAll("\"", ""))
                                        .addProperty(geoModel.getProperty(geo + "lat"), data2[3])
                                        .addProperty(geoModel.getProperty(geo + "long"), data2[4]);

                        break;
                    case "Entorno Natural":
                       // System.out.println("-o-o-o--o-o-o-o--o-o-o-o-");
                        Resource EntornoNatural
                                = model.createResource(cruzar + uriname)
                                        .addProperty(RDF.type, cruzarModel.getProperty(cruzar + "Entorno-natural"))
                                        .addProperty(schemaModel.getProperty(schema + "name"), data2[0].replaceAll("\"", ""))
                                        .addProperty(geoModel.getProperty(geo + "lat"), data2[3])
                                        .addProperty(geoModel.getProperty(geo + "long"), data2[4]);
                        break;

                }

            }
        } catch (IOException e) {
            e.printStackTrace();
        } finally {
            try {
                if (br != null) {
                    br.close();
                }
            } catch (IOException ex) {
                ex.printStackTrace();
            }
        }

        // list the statements in the Model
        StmtIterator iter = model.listStatements();
        // print out the predicate, subject and object of each statement
        while (iter.hasNext()) {
            Statement stmt = iter.nextStatement();  // get next statement
            Resource subject = stmt.getSubject();     // get the subject
            Property predicate = stmt.getPredicate();   // get the predicate
            RDFNode object = stmt.getObject();      // get the object

            System.out.print(subject.toString());
            System.out.print(" " + predicate.toString() + " ");
            if (object instanceof Resource) {
                System.out.print(object.toString());
            } else {
                // object is a literal
                System.out.print(" \"" + object.toString() + "\"");
            }

            System.out.println(" .");
        }

        //CANTONES
        // now write the model in XML form to a file
        //System.out.println("MODELO RDF------");
        model.write(System.out, "N-TRIPLE");
        // Save to a file
        // RDFWriter writer = model.getWriter("N-TRIPLE"); //RDF/XML
        //writer.write(model, os, "");
        //TURISMO
        // now write the model in XML form to a file
        System.out.println("MODELO RDF------");
        model.write(System.out, "N-TRIPLE");
        // Save to a file
        RDFWriter writer2 = model.getWriter("N-TRIPLE"); //RDF/XML
        writer2.write(model, os2, "");

        //Cerrar modelos
        dboModel.close();
        schemaModel.close();
        cruzarModel.close();
        geoModel.close();
                
        model.close();
    }
}
