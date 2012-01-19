<?php
//$context = elgg_get_context();
//elgg_set_context('search');

$limit = get_input('limit', 10);
$offset = get_input('offset');

// Get entities
$options = array("limit"=>$limit,"offset"=>$offset);
$entities = elgg_get_entities($options);
$count = elgg_get_entities(array_merge($options,array('count'=>true)));

$wrapped_entries = array();

foreach ($entities as $e)
{
	$tmp = new ElggObject();
	$tmp->subtype = 'guidtoolwrapper';
	$tmp->entity = $e;
	$wrapped_entries[] = $tmp;
}

$options = array(
		'count' => $count, // the old count parameter
		'offset' => $offset,
		'limit' => (int) $limit,
		'full_view' => false,
);

echo elgg_view_entity_list($wrapped_entries,$options);
