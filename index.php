<?php
require __DIR__ . '/vendor/autoload.php';
// require_once( "sparqllib.php" );

$db = sparql_connect( "http://sparql.data.southampton.ac.uk/" );
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
sparql_ns( "rooms","http://vocab.deri.ie/rooms#" );

$sparql = "SELECT DISTINCT * WHERE { ?room a rooms:Building . ?room rdfs:label ?label } LIMIT 5";
$result = sparql_query( $sparql );
if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

$fields = sparql_field_array( $result );

print "<p>Number of rows: ".sparql_num_rows( $result )." results.</p>";
print "<table class='example_table'>";
print "<tr>";
foreach( $fields as $field )
{
	print "<th>$field</th>";
}
print "</tr>";
while( $row = sparql_fetch_array( $result ) )
{
	print "<tr>";
	foreach( $fields as $field )
	{
		print "<td>$row[$field]</td>";
	}
	print "</tr>";
}
print "</table>";
